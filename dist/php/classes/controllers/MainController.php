<?php

namespace php\classes\controllers;

use php\classes\models\SupModel;

class MainController extends AppController {

  public function indexAction() {
    require dirname(ROOT) . '/vendor/autoload.php';
    $this->setMeta('Главная страница', 'Система управления промо', 'Promo, sup, тарифы');
    $this->setData();
  }

  public function setData() {
    $sup = new SupModel();
    $period = $sup->getWorkPeriod();
    $from = $period[0]['date_from'];
    $to = $period[0]['date_to'];
    $statistic = $sup->getStatisticData($from, $to);
    $summSource = array_sum(array_column($statistic, "sup_source"));
    $summConfirm = array_sum(array_column($statistic, "sup_confirm"));
    $summTotal = array_sum(array_column($statistic, "sup_total"));
    $this->set(compact('statistic', 'summSource', 'summConfirm', 'summTotal'));
  }

}