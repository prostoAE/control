<?php

namespace php\classes\controllers;

use php\classes\models\SupModel;
use php\classes\models\User;

class SupController extends AppController {

  public $sup;
  private static $anee;
  public $userList;

  public function indexAction() {
    $this->layout = 'supLayout';
    $this->setMeta('Система СУП', 'Система управления промо', 'Promo, sup, тарифы');
    $this->sup = new SupModel();
    self::$anee = new AneeController();
    $this->getAccessFilter();
    $this->setData();
  }

  public function setData() {
    $table = $this->sup->getDataFromFinal($this->formHandler($this->userList));
    $buyers = $this->getAccessFilter()['buyers'];
    $groups = $this->getAccessFilter()['groups'];
    $this->set(compact('table', 'buyers', 'groups'));
  }

  public function getAccessFilter() {
    $sup = new SupModel();
    $year = $sup->getAgreementYear();
    $access = User::getUserAccess();
    $userList = $this->arrToStr(User::getUserLink());
    $this->userList = $userList;
    $result = [];

    switch ($access) {
      case 1:
      case 2:
        $result['buyers'] = self::$anee->getBuyers($year);
        $result['groups'] = self::$anee->getGroups($year);
        break;
      case 3:
        $result['buyers'] = self::$anee->getBuyersWithFilter($year, User::getUserName());
        $result['groups'] = self::$anee->getGroupsWithFilter($year, User::getUserName());
        break;
      case 4:
      case 5:
        $result['buyers'] = self::$anee->getBuyersWithFilter($year, $userList);
        $result['groups'] = self::$anee->getGroupsWithFilter($year, $userList);
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

  public function formHandler($userList) {
    if(isset($_POST) && isset($_POST['submit'])) {
      $filters = [];
      $filters['date-from'] = $_POST['date-from'];
      $filters['date-to'] = $_POST['date-to'];
      $filters['buyer'] = $_POST['buyer'];
      $filters['group'] = $_POST['group'];
      $filters['supplier'] = $_POST['supplier'];
      $filters['article'] = $_POST['article'];
      $query = $this->sup->filter($filters, $userList);

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