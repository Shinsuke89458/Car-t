<?php

ini_set('display_errors', 1);

// DB
define('DSN', 'mysql:dbhost=localhost;dbname=cartdb');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'shin0622');

// SITE
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

// PATH
define('ADMMEDIA', 'http://' . $_SERVER['HTTP_HOST'] . '/admin/media.php');
define('ADMITEMLIST', 'http://' . $_SERVER['HTTP_HOST'] . '/admin/itemlist.php');
define('ADMITEM', 'http://' . $_SERVER['HTTP_HOST'] . '/admin/item.php');

// IMG
define('MAX_FILE_SIZE', 1 * 1024 * 1024);
define('THUMBNAIL_WIDTH', 250);
define('IMAGES_DIR', DOCUMENT_ROOT.'/src/images');
define('THUMBNAILS_DIR', DOCUMENT_ROOT.'/src/thumbs');

if (!function_exists('imagecreatetruecolor')) {
  echo 'GD not installed';
  exit;
}

// require
require_once(__DIR__.'/../app/functions.php');
require_once(__DIR__.'/autoload.php');

// session
session_start();
