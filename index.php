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

$f3->route(['GET|HEAD /', 'GET|HEAD /home'], 'controllers\Main->home');

//USER
$f3->route('GET|HEAD /login', 'controllers\Account->loginOrRegister');
$f3->route('POST /doLogin', 'controllers\Account->login');
$f3->route('POST /register', 'controllers\Account->register');
$f3->route('GET|HEAD /logout', 'controllers\Account->logOut');

$f3->route('GET|HEAD /images/@imageName', 'controllers\Products->getStaticImage');

$f3->route('GET|HEAD /initialize', 'controllers\Products->setIds');
$f3->route('POST /create-product', 'controllers\Products->createNewProduct');

$f3->route('GET|HEAD /produse', 'controllers\Products->productList');
$f3->route('GET|HEAD /produs/@name/@id', 'controllers\Products->viewProduct');
$f3->route('GET|HEAD /produs/@id', 'controllers\Products->redirectToProduct');
$f3->route('GET|HEAD /imagini/produse/@id', 'controllers\Products->getImage');
$f3->set('ONERROR', function ($f3) {
    $error = $f3->get('ERROR');
    die(print_r($error, 1));
});

$f3->run();
