<?php

namespace php\classes\controllers;

use php\classes\models\AneeModel;
use php\classes\models\Db;
use php\classes\models\User;

class SettingController extends AppController {

  public function indexAction() {
    $this->layout = 'supLayout';
    $this->setMeta('Система СУП', 'Настройки портала SUP', 'Promo, settings, sup, тарифы, настройки');
    $this->setData();
  }

  public function setData() {
    $users = $this->getSupUserList();
    $aneeUsers = $this->getAneeUserList();
//    debug($aneeUsers);
    $this->set(compact('users', 'aneeUsers', 'buyers'));
  }

  public function getSupUserList() {
    return User::getAllUsers();
  }

  public function getAneeUserList() {
    $anee = new AneeModel();
    return $anee->getAllUsers();
  }

  public function getAgrYear() {
    $query = /** @lang MySQL */
        "select agr_year from cdg_agr_year";
    return Db::selectOne(Db::connectSql(), $query);
  }


}