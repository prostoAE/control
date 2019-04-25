<?php

namespace php\classes\controllers;

class LoginController extends AppController {

  public function indexAction () {
    $this->layout = 'authorise';
    $this->setMeta("Войти", "Страница авторизации на портале СУП", "login, authorise");
  }

}