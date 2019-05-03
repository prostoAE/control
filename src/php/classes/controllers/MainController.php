<?php

namespace php\classes\controllers;

use php\classes\models\User;

class MainController extends AppController {

  public function indexAction() {
    require dirname(ROOT) . '/vendor/autoload.php';
    $this->setMeta('Главная страница', 'Система управления промо', 'Promo, sup, тарифы');
//    debug(User::getUserAccess());
//    debug(User::getUserLink());
  }

}