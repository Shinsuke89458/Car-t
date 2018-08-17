<?php

/*
MyApp
index.php controller
MyApp\Controller\Index
-> app/Controller/Index.php
*/

spl_autoload_register(function($class) {
  $prefix = 'MyApp\\';
  if (strpos($class, $prefix) === 0) {
    $className = substr($class, strlen($prefix));
    $classFilePath = __DIR__.'/../app/'.str_replace('\\', '/', $className).'.php';
    if (file_exists($classFilePath)) {
      require $classFilePath;
    }
  }
});
