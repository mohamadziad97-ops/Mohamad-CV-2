<?php
/*
|--------------------------------------------------------------------------
| Standalone runner — no Composer / Laravel install needed (works on PHP 5.5+)
|--------------------------------------------------------------------------
| Renders the same Blade views and config/cv.php with plain PHP, so the
| site works on IIS right away: http://localhost/mohammad-cv/public/
| The contact form sends email using the settings in config/smtp.php.
| Once a full Laravel install is in place, Laravel's own index.php is used
| instead and this file can be deleted.
*/

$BASE = dirname(__DIR__);
$cv   = require $BASE . '/config/cv.php';

$__status = null; $__mailError = null; $__errors = array(); $__old = array();

// ---- Laravel helper stand-ins used by the views ----
function e($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }
function asset($p) { return ltrim($p, '/'); }
function route($n) { return basename(__FILE__) . '#contact'; }
function session($k) { global $__status, $__mailError; return $k === 'status' ? $__status : ($k === 'mail_error' ? $__mailError : null); }
function old($k) { global $__old; return isset($__old[$k]) ? $__old[$k] : ''; }

class CvErrors {
    private $e; function __construct($e) { $this->e = $e; }
    function any() { return (bool) $this->e; }
    function has($k) { return isset($this->e[$k]); }
    function first($k) { return isset($this->e[$k]) ? $this->e[$k] : ''; }
}
$errors = new CvErrors($__errors);

// ---- Tiny Blade compiler (supports what these views use) ----
function cv_compile($s) {
    $p = '(\((?:[^()]++|(?1))*\))';
    $s = preg_replace('/\{\{\s*(.+?)\s*\}\}/s', '<?php echo e($1); ?>', $s);
    $s = preg_replace('/\{!!\s*(.+?)\s*!!\}/s', '<?php echo $1; ?>', $s);
    $s = preg_replace("/@foreach\s*$p/", '<?php foreach$1: ?>', $s);
    $s = preg_replace("/@elseif\s*$p/", '<?php elseif$1: ?>', $s);
    $s = preg_replace("/@if\s*$p/", '<?php if$1: ?>', $s);
    $s = preg_replace("/@include\s*\('([^']+)'\)/", '<?php echo cv_render(\'$1\', get_defined_vars()); ?>', $s);
    return str_replace(
        ['@endforeach', '@endif', '@else', '@csrf'],
        ['<?php endforeach; ?>', '<?php endif; ?>', '<?php else: ?>', ''],
        $s
    );
}
function cv_render($__view, $__vars) {
    global $BASE;
    $__code = cv_compile(file_get_contents($BASE . '/resources/views/' . str_replace('.', '/', $__view) . '.blade.php'));
    unset($__vars['__view'], $__vars['__vars'], $__vars['__code']);
    extract($__vars, EXTR_SKIP);
    ob_start();
    eval('?>' . $__code);
    return ob_get_clean();
}

// ---- Contact form → email via SMTP (config/smtp.php) ----
if (isset($_GET['sent'])) {
    $__status = 'Thanks! Your message has been sent — I\'ll get back to you soon.';
}
if ((isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET') === 'POST') {
    $__old = array(
        'name'    => trim(isset($_POST['name']) ? $_POST['name'] : ''),
        'email'   => trim(isset($_POST['email']) ? $_POST['email'] : ''),
        'message' => trim(isset($_POST['message']) ? $_POST['message'] : ''),
    );
    if (!empty($_POST['website'])) {                     // honeypot: pretend success for bots
        header('Location: ' . basename($_SERVER['SCRIPT_NAME']) . '?sent=1#contact'); exit;
    }
    if ($__old['name'] === '' || strlen($__old['name']) > 120)      $__errors['name']    = 'Please enter your name.';
    if (!filter_var($__old['email'], FILTER_VALIDATE_EMAIL))         $__errors['email']   = 'Please enter a valid email address.';
    if (strlen($__old['message']) < 10)                              $__errors['message'] = 'Your message should be at least 10 characters.';
    if (strlen($__old['message']) > 3000)                            $__errors['message'] = 'Please keep your message under 3000 characters.';

    // simple rate limit: 5 messages per 10 minutes per visitor IP
    $__store = $BASE . '/storage';
    if (!is_dir($__store)) @mkdir($__store, 0775, true);
    $__ip    = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0';
    $__rl    = $__store . '/ratelimit.json';
    $__hits  = @json_decode(@file_get_contents($__rl), true); if (!is_array($__hits)) $__hits = array();
    foreach ($__hits as $k => $list) { $__hits[$k] = array_values(array_filter($list, function ($t) { return $t > time() - 600; })); if (!$__hits[$k]) unset($__hits[$k]); }
    if (!$__errors && isset($__hits[$__ip]) && count($__hits[$__ip]) >= 5) {
        $__mailError = 'Too many messages in a short time — please try again in a few minutes.';
    }

    if (!$__errors && !$__mailError) {
        require_once $BASE . '/app/SimpleSmtp.php';
        $smtp = require $BASE . '/config/smtp.php';
        $html = cv_render('emails.contact', array(
            'sender_name'  => $__old['name'],
            'sender_email' => $__old['email'],
            'body_text'    => $__old['message'],
            'sent_at'      => date('D, d M Y H:i'),
        ));
        $text = "New message from your CV website\n\nName:  {$__old['name']}\nEmail: {$__old['email']}\n\n{$__old['message']}\n";
        $mailer = new SimpleSmtp($smtp);
        $result = $mailer->send($smtp['to'], 'CV website: message from ' . $__old['name'], $html, $text, $__old['email'], $__old['name']);

        // keep a private copy of every message (file is PHP so it can't be downloaded)
        $__logFile = $__store . '/messages.php';
        if (!file_exists($__logFile)) @file_put_contents($__logFile, "<?php exit; ?>\n");
        @file_put_contents($__logFile, json_encode(array(
            'at' => date('c'), 'ip' => $__ip, 'name' => $__old['name'], 'email' => $__old['email'],
            'message' => $__old['message'], 'mail' => $result === true ? 'sent' : $result,
        )) . "\n", FILE_APPEND);

        if ($result === true) {
            $__hits[$__ip][] = time(); @file_put_contents($__rl, json_encode($__hits));
            header('Location: ' . basename($_SERVER['SCRIPT_NAME']) . '?sent=1#contact');
            exit;
        }
        $__mailError = 'Sorry, your message could not be sent right now. Please email me directly at ' . $cv['contact']['email'] . '.';
    }
}

echo cv_render('cv.index', ['cv' => $cv, 'errors' => $errors]);
