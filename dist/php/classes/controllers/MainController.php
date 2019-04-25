<?php

namespace php\classes\controllers;

use php\classes\models\ldap;

class MainController extends AppController {

  public function indexAction() {
    require dirname(ROOT) . '/vendor/autoload.php';
    $this->setMeta('Главная страница', 'Система управления промо', 'Promo, sup, тарифы');
//    $name = 'Тузик';
//    $rang = ['caption', 'general'];
//    $this->set(compact('name', 'rang'));
    $ldap = new ldap();
    if ($ldap->bind('ukr0000096', 'Auchan+04')) {
      echo 'Done!';
    } else {
      echo 'error...';
    }

  }

}