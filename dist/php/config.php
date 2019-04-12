<?php

return [
  /* PATHS */
  define('ROOT', dirname(__DIR__)),
  define('PHP', ROOT . DIRECTORY_SEPARATOR . 'php'),
  define("CLASSES", PHP . DIRECTORY_SEPARATOR . 'classes'),
  define("VENDOR", ROOT . DIRECTORY_SEPARATOR . 'vendor'),
  define("MODEL", CLASSES . DIRECTORY_SEPARATOR . 'models'),
  define("CONTR", CLASSES . DIRECTORY_SEPARATOR . 'controllers'),
  define("VIEW", CLASSES . DIRECTORY_SEPARATOR . 'views'),
  define("CPRE", PHP . DIRECTORY_SEPARATOR . 'core'),
  define("LAYOUT", 'default'),

  /* SQL conection */
  define("SQL_HOST", 'localhost'),
  define("SQL_DBNAME", 'control_db'),
  define("SQL_USER", 'root'),
  define("SQL_PASS", ''),

  /* ANEE conection */
  define("ANEE_DBNAME", 'ANEE'),
  define("ANEE_USER", 'anee'),
  define("ANEE_PASS", 'ANEE'),

  /* SUP conection */
  define("SUP_DBNAME", 'SUP'),
  define("SUP_USER", 'PROMO6'),
  define("SUP_PASS", 'PROMO6')
];


