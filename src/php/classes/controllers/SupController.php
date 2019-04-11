<?php

namespace php\classes\controllers;

use php\classes\models\SupModel;

class SupController extends AppController {

  public $sup;
  private static $anee;

  public function supAction() {
    $this->setMeta('Система СУП', 'Система управления промо', 'Promo, sup, тарифы');
    $this->sup = new SupModel();
    self::$anee = new AneeController();
    $this->setData();
  }

  public function setData() {
    $table = $this->sup->getDataFromFinal($this->formHandler());
    $buyers = self::$anee->getBuyers(2019);
    $groups = self::$anee->getGroups(2019);
    $this->set(compact('table', 'buyers', 'groups'));
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
//      $this->getSource('13.03.2019', '26.03.2019');
//      $this->loadToFinalTable('13.03.2019', '26.03.2019');

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