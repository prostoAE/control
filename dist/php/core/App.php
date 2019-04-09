<?php

namespace php\core;

class App {

  public static $app;

  public function __construct() {
    session_start();
    $query = trim(substr($_SERVER['REQUEST_URI'], 5), '/');
    Router::dispatch($query);
  }

}