<?php

namespace php\classes\controllers;

class MainController extends AppController {

  public function indexAction() {
    $this->setMeta('Главная страница', 'Система управления промо', 'Promo, sup, тарифы');
//    $name = 'Тузик';
//    $rang = ['caption', 'general'];
//    $this->set(compact('name', 'rang'));
  }

}