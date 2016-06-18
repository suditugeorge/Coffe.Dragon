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

define('MAIN_URL', 'coffee-dragon.ro');
define('IMAGES_DIR', '/images/');

define('JACKET_LARGE_WIDTH', 300);
define('JACKET_LARGE_HEIGHT', 300);
define('JACKET_THUMB_WIDTH', 225);
define('JACKET_THUMB_HEIGHT', 225);
define('JACKET_SMALL_WIDTH', 120);
define('JACKET_SMALL_HEIGHT', 120);
define('JACKET_XSMALL_WIDTH', 55);
define('JACKET_XSMALL_HEIGHT', 55);

define('JACKET_BANNER_WIDTH', 86);
define('JACKET_BANNER_HEIGHT', 86);

define('JACKET_EXTRA_WIDTH', 300);
define('JACKET_EXTRA_HEIGHT', 500);

//$mongo = new MongoClient();

//$f3->set('MONGO', $mongo);
$f3->set('LANGUAGE', 'ro-RO');

$logger = new \Log('debug.log');
function debug($message)
{
    global $logger;
    $logger->write($message);
}
