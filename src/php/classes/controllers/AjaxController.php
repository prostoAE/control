<?php

namespace php\classes\controllers;

use php\classes\models\Db;
use php\classes\models\SupModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
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

    $sup = new SupModel();
    $data = $sup->getDataFromFinal($_SESSION['supQuery']);
    debug($data);

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    $row = 2;
    foreach ($data as $k => $v) {
      $sheet->setCellValue('A' . $row, $v['id']);
      $sheet->setCellValue('B' . $row, $v['start_date']);
      $sheet->setCellValue('C' . $row, $v['end_date']);
      $sheet->setCellValue('D' . $row, $v['buyer']);
      $sheet->setCellValue('E' . $row, $v['short_condition']);
      $sheet->setCellValue('F' . $row, $v['n_agreement']);
      $sheet->setCellValue('G' . $row, $v['segment']);
      $sheet->setCellValue('H' . $row, $v['frs']);
      $sheet->setCellValue('I' . $row, $v['article']);
      $sheet->setCellValue('J' . $row, $v['type_promo']);
      $row++;
    }


    $writer = new Xlsx($spreadsheet);
    $writer->save(ROOT . '/hello world.xlsx');

//    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//    header('Content-Disposition: attachment;filename="myfile.xlsx"');
//    header('Cache-Control: max-age=0');
//
//
//    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//    $writer->save('php://output');
  }

}