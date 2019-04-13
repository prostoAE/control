<?php

namespace php\core;

class App {

  public static $app;

  public function __construct() {
    session_start();
    $query = trim(substr($_SERVER['REQUEST_URI'], 5), '/'); /*на работе 13*/
    Router::dispatch($query);
  }

}