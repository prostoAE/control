<?php

namespace php\classes\controllers;

use php\classes\models\Db;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AjaxController extends AppController {

  public function tarifConfirmAction() {

    $id = $_POST['id'];
    $store = $_POST['store'];
    $tarif = $_POST['tarif'];

    $query = "UPDATE sup_final SET mag_{$store}_confirmed = {$tarif} WHERE id = {$id}";

    Db::set(Db::connectSql(),$query);

  }

  public function exportExcelAction() {

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');
    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world.xlsx');

  }

}