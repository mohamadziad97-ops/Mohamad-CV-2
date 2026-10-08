<?php
/*
|--------------------------------------------------------------------------
| Static build for GitHub Pages
|--------------------------------------------------------------------------
| GitHub Pages can't run PHP, so this renders the site once into docs/
| as plain HTML + assets. Run it again after editing config/cv.php or the views:
|
|     php build-static.php
|
| The contact form on the static site opens the visitor's email app
| (mailto) instead of sending through SMTP.
*/

$BASE = __DIR__;
$OUT  = $BASE . '/docs';

// Render public/index.php as a plain GET request
unset($_SERVER['REQUEST_METHOD']);
$_GET = array();
ob_start();
include $BASE . '/public/index.php';
$html = ob_get_clean();

// Point the form at the static mailto handler in js/cv.js
$html = str_replace('action="index.php#contact"', 'action="#contact" data-mailto="' . e($cv['contact']['email']) . '"', $html);

// Copy assets
function cv_copy_dir($src, $dst) {
    if (!is_dir($dst)) mkdir($dst, 0775, true);
    foreach (scandir($src) as $f) {
        if ($f === '.' || $f === '..') continue;
        is_dir("$src/$f") ? cv_copy_dir("$src/$f", "$dst/$f") : copy("$src/$f", "$dst/$f");
    }
}
if (!is_dir($OUT)) mkdir($OUT, 0775, true);
foreach (array('css', 'js', 'images', 'files') as $d) cv_copy_dir("$BASE/public/$d", "$OUT/$d");

file_put_contents("$OUT/index.html", $html);
file_put_contents("$OUT/.nojekyll", '');

echo "Built docs/index.html (" . strlen($html) . " bytes)\n";
