<?php

namespace php\classes\controllers;

class SettingController extends AppController {

  public function indexAction() {
    $this->layout = 'supLayout';
    $this->setMeta('Система СУП', 'Настройки портала SUP', 'Promo, settings, sup, тарифы, настройки');
  }

  public function getSupUserList() {

  }

}