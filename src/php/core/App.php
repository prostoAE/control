<?php

namespace php\core;

class App {

  public static $app;

  public function __construct() {
    session_start();
    echo $query = trim(substr($_SERVER['REQUEST_URI'], 13), '/');
    Router::dispatch($query);
  }

}