<?php

namespace php\classes\controllers;

use php\classes\models\User;
use php\core\Controller;

class AppController extends Controller {

  public function __construct($route) {
    parent::__construct($route);
    $this->createUser();
  }

  public function createUser() {
    if(isset($_SESSION['ukr']) && isset($_SESSION['psw'])) {
      new User($_SESSION['ukr'], $_SESSION['psw']);
    }
  }

}