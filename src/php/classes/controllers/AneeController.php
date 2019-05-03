<?php

namespace php\classes\controllers;

use php\classes\models\AneeModel;

class AneeController extends AneeModel {

  public function getBuyers($year) {
    return $this->getBuyersList($year);
  }

  public function getBuyersWithFilter($year, $buyers) {
    return $this->getBuyersListFiltered($year, $buyers);
  }

  public function getGroups($year) {
    return $this->getGroupList($year);
  }

  public function getGroupsWithFilter($year, $buyers) {
    return $this->getGroupListFiltered($year, $buyers);
  }

  public function getCca($year) {
    return $this->getCcaList($year);
  }

}