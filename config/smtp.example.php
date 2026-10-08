<?php

/*
|--------------------------------------------------------------------------
| SMTP settings for the contact form
|--------------------------------------------------------------------------
| Copy this file to config/smtp.php and fill in your App Password.
| (config/smtp.php is git-ignored so your password never reaches GitHub.)
|
| Used by both the IIS version (public/index.php) and the Laravel version
| (CvController). Messages from the contact form are sent to 'to'.
|
| GMAIL: 'password' must be a 16-character Google *App Password*, not your
| normal Gmail password:
|   1. Turn on 2-Step Verification: https://myaccount.google.com/security
|   2. Create an App Password:      https://myaccount.google.com/apppasswords
|   3. Paste it below (spaces are fine) and save this file.
|
| This is a .php file on purpose: the web server runs it instead of showing
| it, so the password is never visible in a browser. Don't rename it.
*/

return [

    'host'       => 'smtp.gmail.com',
    'port'       => 465,          // 465 = SSL, 587 = STARTTLS
    'encryption' => 'ssl',        // 'ssl' for 465, 'tls' for 587

    'username'   => 'mohamad.ziad97@gmail.com',
    'password'   => 'PASTE-YOUR-GMAIL-APP-PASSWORD-HERE',

    'from_email' => 'mohamad.ziad97@gmail.com',   // Gmail requires this to match the username
    'from_name'  => 'CV Website',

    'to'         => 'mohamad.ziad97@gmail.com',   // where contact messages are delivered

    'timeout'    => 15,

];
