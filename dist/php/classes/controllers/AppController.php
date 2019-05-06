<?php

namespace php\classes\controllers;

use php\classes\models\User;
use php\core\Controller;

class AppController extends Controller {

  public function __construct($route) {
    parent::__construct($route);
    $this->userInit();
  }

  public function userInit() {
    if(isset($_SESSION['ukr']) && isset($_SESSION['psw'])) {
      new User($_SESSION['ukr'], $_SESSION['psw']);
    }
  }

}