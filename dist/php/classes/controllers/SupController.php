<?php

namespace php\classes\controllers;

use php\classes\models\SupModel;
use php\classes\models\User;

class SupController extends AppController {

  public $sup;
  private static $anee;

  public function indexAction() {
    $this->layout = 'supLayout';
    $this->setMeta('Система СУП', 'Система управления промо', 'Promo, sup, тарифы');
    $this->sup = new SupModel();
    self::$anee = new AneeController();
    $this->setData();
  }

  public function setData() {
    $table = $this->sup->getDataFromFinal($this->formHandler());
    $buyers = $this->getAccessFilter()['buyers'];
    $groups = $this->getAccessFilter()['groups'];
    $this->set(compact('table', 'buyers', 'groups'));
  }

  public function getAccessFilter() {
    $access = User::getUserAccess();
    $userList = $this->arrToStr(User::getUserLink());
    $result = [];

    switch ($access[0]['user_access']) {
      case 1:
      case 2:
        $result['buyers'] = self::$anee->getBuyers(2019);
        $result['groups'] = self::$anee->getGroups(2019);
        break;
      case 3:
        $result['buyers'] = self::$anee->getBuyersWithFilter(2019, $userList);
        $result['groups'] = self::$anee->getGroupsWithFilter(2019, $userList);
        break;
    }
    return $result;
  }

  public function arrToStr($array) {
    $newArr = [];
    foreach ($array as $item) {
      foreach ($item as $val) {
        $newArr[] = $val;
      }
    }

    $result = array_map(function($value) {
      return "'" . $value . "'";
    }, $newArr);

    $result = implode(",", $result);
    return $result;
  }

  public function getSource($startDate, $endDate) {
    $this->sup->setStartDate($startDate);
    $this->sup->setEndDate($endDate);
    $sourceData = $this->sup->loadSourceData();
    $this->sup->insertSourceData($sourceData);
  }

  public function loadToFinalTable($dateStart, $dateEnd) {
    $data = $this->sup->getDataFromSourceTable($dateStart, $dateEnd);
    $this->sup->insertToFinalTable($data);
  }

  public function formHandler() {
    if(isset($_POST) && isset($_POST['submit'])) {
      $filters = [];
      $filters['date-from'] = $_POST['date-from'];
      $filters['date-to'] = $_POST['date-to'];
      $filters['buyer'] = $_POST['buyer'];
      $filters['group'] = $_POST['group'];
      $filters['supplier'] = $_POST['supplier'];
      $filters['article'] = $_POST['article'];

      $query = $this->sup->filter($filters);

//      $this->ccaUpdate('2019');
//      $this->serviceUpdate('2019');
//      $this->getSource('27.03.2019', '23.04.2019');
//      $this->loadToFinalTable('27.03.2019', '23.04.2019');

      $_SESSION['supQuery'] = $query;
      return $query;
    }
  }

  public function ccaUpdate($year) {
    $data = self::$anee->getCcaList($year);
    $this->sup->insertToCcaTable($data, $year);
  }

  public function serviceUpdate($year) {
    $data = self::$anee->getServiceList($year);
    $this->sup->insertServiceToTable($data);
  }

}