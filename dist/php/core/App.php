<?php

namespace php\core;

class App {

  public static $app;

  public function __construct() {
    session_start();
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true && isset($_SESSION['ukr'])) {
      $query = trim(substr($_SERVER['REQUEST_URI'], 13), '/'); /*XAMPP = 13, oc = 5*/
    } else {
      $query = 'login';
    }
    Router::dispatch($query);
  }

}