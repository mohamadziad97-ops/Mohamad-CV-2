<?php

/**
 * Minimal SMTP client (no Composer needed, PHP 5.5+).
 * Supports SSL (port 465) and STARTTLS (port 587) with AUTH LOGIN.
 * Used by the IIS version of the CV site; the Laravel version uses Laravel's mailer.
 */
class SimpleSmtp
{
    private $cfg;
    private $sock;
    public  $log = array();

    public function __construct(array $cfg)
    {
        $this->cfg = $cfg;
    }

    /**
     * @return true|string  true on success, otherwise an error message
     */
    public function send($to, $subject, $html, $text, $replyToEmail = null, $replyToName = null)
    {
        $c = $this->cfg;
        if (empty($c['password']) || strpos($c['password'], 'PASTE-') === 0) {
            return 'SMTP password is not set in config/smtp.php';
        }

        $timeout = isset($c['timeout']) ? (int) $c['timeout'] : 15;
        $enc     = strtolower(isset($c['encryption']) ? $c['encryption'] : '');
        $remote  = ($enc === 'ssl' ? 'ssl://' : 'tcp://') . $c['host'] . ':' . (int) $c['port'];
        $ctx     = stream_context_create(array('ssl' => array(
            'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true,
        )));

        $this->sock = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $ctx);
        if (!$this->sock) {
            return "Could not connect to $remote ($errno $errstr)";
        }
        stream_set_timeout($this->sock, $timeout);

        try {
            $this->expect(220);
            $host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
            $this->cmd('EHLO ' . $host, 250);

            if ($enc === 'tls') {
                $this->cmd('STARTTLS', 220);
                $method = defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')
                    ? STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT | STREAM_CRYPTO_METHOD_TLS_CLIENT
                    : STREAM_CRYPTO_METHOD_TLS_CLIENT;
                if (!@stream_socket_enable_crypto($this->sock, true, $method)) {
                    throw new Exception('STARTTLS negotiation failed');
                }
                $this->cmd('EHLO ' . $host, 250);
            }

            $this->cmd('AUTH LOGIN', 334);
            $this->cmd(base64_encode($c['username']), 334, 'AUTH user');
            $this->cmd(base64_encode(str_replace(' ', '', $c['password'])), 235, 'AUTH password');

            $this->cmd('MAIL FROM:<' . $c['from_email'] . '>', 250);
            $this->cmd('RCPT TO:<' . $to . '>', array(250, 251));
            $this->cmd('DATA', 354);

            $msg = $this->build($to, $subject, $html, $text, $replyToEmail, $replyToName);
            // dot-stuffing
            $msg = preg_replace('/^\./m', '..', $msg);
            fwrite($this->sock, $msg . "\r\n.\r\n");
            $this->expect(250);

            $this->cmd('QUIT', 221);
        } catch (Exception $e) {
            @fclose($this->sock);
            return $e->getMessage();
        }
        @fclose($this->sock);
        return true;
    }

    private function build($to, $subject, $html, $text, $replyEmail, $replyName)
    {
        $c  = $this->cfg;
        $b  = '=_cv_' . md5(uniqid('', true));
        $h  = array();
        $h[] = 'Date: ' . date('r');
        $h[] = 'From: ' . $this->addr($c['from_email'], isset($c['from_name']) ? $c['from_name'] : '');
        $h[] = 'To: <' . $to . '>';
        if ($replyEmail) {
            $h[] = 'Reply-To: ' . $this->addr($replyEmail, $replyName);
        }
        $h[] = 'Subject: ' . $this->enc($subject);
        $h[] = 'Message-ID: <' . md5(uniqid('', true)) . '@' . substr(strrchr($c['from_email'], '@'), 1) . '>';
        $h[] = 'MIME-Version: 1.0';
        $h[] = 'Content-Type: multipart/alternative; boundary="' . $b . '"';

        $body  = "--$b\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($text));
        $body .= "--$b\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($html));
        $body .= "--$b--";

        return implode("\r\n", $h) . "\r\n\r\n" . $body;
    }

    private function addr($email, $name)
    {
        $email = str_replace(array("\r", "\n", '<', '>'), '', $email);
        return $name !== '' && $name !== null ? $this->enc($name) . ' <' . $email . '>' : '<' . $email . '>';
    }

    private function enc($s)
    {
        $s = str_replace(array("\r", "\n"), ' ', $s);
        return preg_match('/[^\x20-\x7E]/', $s) ? '=?UTF-8?B?' . base64_encode($s) . '?=' : $s;
    }

    private function cmd($line, $expect, $label = null)
    {
        $this->log[] = '> ' . ($label ? $label : $line);
        fwrite($this->sock, $line . "\r\n");
        return $this->expect($expect);
    }

    private function expect($codes)
    {
        $codes = (array) $codes;
        $resp  = '';
        while (($line = fgets($this->sock, 515)) !== false) {
            $resp .= $line;
            if (isset($line[3]) && $line[3] === ' ') break;
        }
        $this->log[] = '< ' . trim($resp);
        $code = (int) substr($resp, 0, 3);
        if (!in_array($code, $codes)) {
            $hint = '';
            if ($code === 535) $hint = ' (wrong username or App Password)';
            throw new Exception('SMTP error: ' . trim($resp) . $hint);
        }
        return $resp;
    }
}
