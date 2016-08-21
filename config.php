<?php

define('ROOT_DIR', __DIR__);

// Kickstart the framework
/*
 * @var Base
 */

$f3 = \Base::instance();

$f3->set('UI', ROOT_DIR . '/ui/html/');

$f3->set('DEBUG', false);

$f3->set('AUTOLOAD', ROOT_DIR . '/classes/');

define('DOMAIN', 'http://');
define('MAIN_URL', 'coffee-dragon.ro');
define('STATIC_IMAGES_DIR', '/images/');
define('PRODUCTS_IMAGES_DIR', '/images/products/');
define('CURRENCY', 'RON');

define('JACKET_NORMAL_WIDTH', 400);
define('JACKET_NORMAL_HEIGHT', 250);
define('JACKET_EXTRA_WIDTH', 400);
define('JACKET_EXTRA_HEIGHT', 600);

define('NOTIFICATION_SMTP_HOST', 'smtp.gmail.com');
define('NOTIFICATION_SMTP_USER', 'coffee.dragon.cafe@gmail.com');
define('NOTIFICATION_SMTP_PASSWORD', 'CoffeeDragon2016');
define('NOTIFICATION_SMTP_SECURITY', 'ssl');
define('NOTIFICATION_SMTP_PORT', 465);

define('IMAGE_404', '/images/404-image.jpg');

$mongo = new \MongoClient();

$f3->set('MONGO', $mongo);
$f3->set('LANGUAGE', 'ro-RO');

$logger = new \Log('debug.log');
function debug($message)
{
    global $logger;
    $logger->write($message);
}
