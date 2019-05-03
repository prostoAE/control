<?php

namespace php\classes\controllers;

use php\classes\models\ldap;

class LoginController extends AppController {

  public function indexAction () {
    $this->layout = 'authorise';
    $this->setMeta("Войти", "Страница авторизации на портале СУП", "login, authorise");
    $this->authorization();
  }

  public function authorization() {
    if(isset($_POST) && isset($_POST['submit'])) {
      $user = $_POST['username'];
      $pass = $_POST['password'];
      $errors = [];

      if(!isset($user) || $user == '') {
        $errors[] = 'Не указано имя пользователя!';
      }
      if(!isset($pass) || $pass == '') {
        $errors[] = 'Не указан пароль!';
      }

      $ldap = new ldap();

      if($ldap->bind($user, $pass)) {
        $_SESSION['auth'] = true;
        $_SESSION['ukr'] = $user;
        $_SESSION['psw'] = $pass;
        header('location: main');
      } else {
        $_SESSION['auth'] = true;
        $errors[] = 'Не верный логин или пароль!';
        $this->set(compact('errors'));
      }
    }

  }

}