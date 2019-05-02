<?php

namespace php\classes\controllers;

class MainController extends AppController {

  public function indexAction() {
    require dirname(ROOT) . '/vendor/autoload.php';
    $this->setMeta('Главная страница', 'Система управления промо', 'Promo, sup, тарифы');
//    $name = 'Тузик';
//    $rang = ['caption', 'general'];
//    $this->set(compact('name', 'rang'));
  }

}