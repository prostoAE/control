<?php

namespace php\classes\controllers;

use php\classes\models\Db;

class AjaxController extends AppController {

  public function tarifConfirmAction() {

    $id = $_POST['id'];
    $store = $_POST['store'];
    $tarif = $_POST['tarif'];

    $query = "UPDATE sup_final SET mag_{$store}_confirmed = {$tarif} WHERE id = {$id}";

    Db::set(Db::connectSql(),$query);

  }

}