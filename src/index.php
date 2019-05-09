<?php
error_reporting(-1);
spl_autoload_register(function ($class) {
  $file = ROOT . '/' . str_replace('\\', '/', strtolower($class)) . '.php';
  if(file_exists($file)) {
    require_once $file;
  }
});

require_once 'php/config.php';
require_once PHP . '/functions.php';
require_once PHP . '/routes.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use php\core\App;

new App();
echo 'test';
