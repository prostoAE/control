<?php

namespace php\classes\controllers;

use php\classes\models\AneeModel;

class AneeController extends AneeModel {

  public function getBuyers($year) {
    return $this->getBuyersList($year);
  }

  public function getGroups($year) {
    return $this->getGroupList($year);
  }

  public function getCca($year) {
    return $this->getCcaList($year);
  }

}