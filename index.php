<?php
// Kickstart the framework
$f3 = require 'lib/base.php';
//require_once '/config.php';
require_once '/config.php';
$f3->set('DEBUG', 1);
if ((float) PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}

// Load configuration
$f3->config('config.ini');

$f3->route('GET|HEAD /', 'controllers\Main->home');
$f3->route('GET|HEAD /login', 'controllers\Account->loginOrRegister');
$f3->route('POST /register', 'controllers\Account->register');
$f3->route('GET|HEAD /images/@imageName', 'controllers\Products->getStaticImage');
$f3->route('GET|HEAD /phpinfo', function () {
    die(print_r(phpinfo(), 1));
});

$f3->set('ONERROR', function ($f3) {
    $error = $f3->get('ERROR');
    die(print_r($error, 1));
});

$f3->run();
