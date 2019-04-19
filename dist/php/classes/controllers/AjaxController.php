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

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    /* Заголовок таблицы */
    $sheet->setCellValue('A1', 'id');
    $sheet->setCellValue('B1', 'start_date');
    $sheet->setCellValue('C1', 'end_date');
    $sheet->setCellValue('D1', 'buyer');
    $sheet->setCellValue('E1', 'short_condition');
    $sheet->setCellValue('F1', 'n_agreement');
    $sheet->setCellValue('G1', 'segment');
    $sheet->setCellValue('H1', 'frs');
    $sheet->setCellValue('I1', 'article');
    $sheet->setCellValue('J1', 'type_promo');
    $sheet->setCellValue('K1', 'billing_cost_per_service');
    $sheet->setCellValue('L1', 'mag_001');
    $sheet->setCellValue('M1', 'mag_003');
    $sheet->setCellValue('N1', 'mag_007');
    $sheet->setCellValue('O1', 'mag_009');
    $sheet->setCellValue('P1', 'mag_010');
    $sheet->setCellValue('Q1', 'mag_011');
    $sheet->setCellValue('R1', 'mag_012');
    $sheet->setCellValue('S1', 'mag_014');
    $sheet->setCellValue('T1', 'mag_015');
    $sheet->setCellValue('U1', 'mag_016');
    $sheet->setCellValue('V1', 'mag_018');
    $sheet->setCellValue('W1', 'mag_020');
    $sheet->setCellValue('X1', 'mag_022');
    $sheet->setCellValue('Y1', 'mag_023');
    $sheet->setCellValue('Z1', 'mag_024');
    $sheet->setCellValue('AA1', 'mag_025');
    $sheet->setCellValue('AB1', 'mag_026');
    $sheet->setCellValue('AC1', 'mag_027');
    $sheet->setCellValue('AD1', 'mag_028');
    $sheet->setCellValue('AE1', 'mag_029');
    $sheet->setCellValue('AF1', 'mag_030');
    $sheet->setCellValue('AG1', 'mag_031');
    $sheet->setCellValue('AH1', 'mag_032');
    $sheet->setCellValue('AI1', 'mag_033');
    $sheet->setCellValue('AJ1', 'mag_034');
    $sheet->setCellValue('AK1', 'mag_035');
    $sheet->setCellValue('AL1', 'mag_037');

    /* Заполнение ячеек */
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
      $sheet->setCellValue('K' . $row, $v['billing_cost_per_service']);
      $sheet->setCellValue('L' . $row, $v['mag_001_confirmed'] >= '0'? $v['mag_001_confirmed']: $v['mag_001']);
      $sheet->setCellValue('M' . $row, $v['mag_003_confirmed'] >= '0'? $v['mag_003_confirmed']: $v['mag_003']);
      $sheet->setCellValue('N' . $row, $v['mag_007_confirmed'] >= '0'? $v['mag_007_confirmed']: $v['mag_007']);
      $sheet->setCellValue('O' . $row, $v['mag_009_confirmed'] >= '0'? $v['mag_009_confirmed']: $v['mag_009']);
      $sheet->setCellValue('P' . $row, $v['mag_010_confirmed'] >= '0'? $v['mag_010_confirmed']: $v['mag_010']);
      $sheet->setCellValue('Q' . $row, $v['mag_011_confirmed'] >= '0'? $v['mag_011_confirmed']: $v['mag_011']);
      $sheet->setCellValue('R' . $row, $v['mag_012_confirmed'] >= '0'? $v['mag_012_confirmed']: $v['mag_012']);
      $sheet->setCellValue('S' . $row, $v['mag_014_confirmed'] >= '0'? $v['mag_014_confirmed']: $v['mag_014']);
      $sheet->setCellValue('T' . $row, $v['mag_015_confirmed'] >= '0'? $v['mag_015_confirmed']: $v['mag_015']);
      $sheet->setCellValue('U' . $row, $v['mag_016_confirmed'] >= '0'? $v['mag_016_confirmed']: $v['mag_016']);
      $sheet->setCellValue('V' . $row, $v['mag_018_confirmed'] >= '0'? $v['mag_018_confirmed']: $v['mag_018']);
      $sheet->setCellValue('W' . $row, $v['mag_020_confirmed'] >= '0'? $v['mag_020_confirmed']: $v['mag_020']);
      $sheet->setCellValue('X' . $row, $v['mag_022_confirmed'] >= '0'? $v['mag_022_confirmed']: $v['mag_022']);
      $sheet->setCellValue('Y' . $row, $v['mag_023_confirmed'] >= '0'? $v['mag_023_confirmed']: $v['mag_023']);
      $sheet->setCellValue('Z' . $row, $v['mag_024_confirmed'] >= '0'? $v['mag_024_confirmed']: $v['mag_024']);
      $sheet->setCellValue('AA' . $row, $v['mag_025_confirmed'] >= '0'? $v['mag_025_confirmed']: $v['mag_025']);
      $sheet->setCellValue('AB' . $row, $v['mag_026_confirmed'] >= '0'? $v['mag_026_confirmed']: $v['mag_026']);
      $sheet->setCellValue('AC' . $row, $v['mag_027_confirmed'] >= '0'? $v['mag_027_confirmed']: $v['mag_027']);
      $sheet->setCellValue('AD' . $row, $v['mag_028_confirmed'] >= '0'? $v['mag_028_confirmed']: $v['mag_028']);
      $sheet->setCellValue('AE' . $row, $v['mag_029_confirmed'] >= '0'? $v['mag_029_confirmed']: $v['mag_029']);
      $sheet->setCellValue('AF' . $row, $v['mag_030_confirmed'] >= '0'? $v['mag_030_confirmed']: $v['mag_030']);
      $sheet->setCellValue('AG' . $row, $v['mag_031_confirmed'] >= '0'? $v['mag_031_confirmed']: $v['mag_031']);
      $sheet->setCellValue('AH' . $row, $v['mag_032_confirmed'] >= '0'? $v['mag_032_confirmed']: $v['mag_032']);
      $sheet->setCellValue('AI' . $row, $v['mag_033_confirmed'] >= '0'? $v['mag_033_confirmed']: $v['mag_033']);
      $sheet->setCellValue('AJ' . $row, $v['mag_034_confirmed'] >= '0'? $v['mag_034_confirmed']: $v['mag_034']);
      $sheet->setCellValue('AK' . $row, $v['mag_035_confirmed'] >= '0'? $v['mag_035_confirmed']: $v['mag_035']);
      $sheet->setCellValue('AL' . $row, $v['mag_037_confirmed'] >= '0'? $v['mag_037_confirmed']: $v['mag_037']);

      /* ЗЗамена нулей на пустую строку */
      if($sheet->getCell('L' . $row)->getValue() == '0') {$sheet->setCellValue('L' . $row, '');}
      if($sheet->getCell('M' . $row)->getValue() == '0') {$sheet->setCellValue('M' . $row, '');}
      if($sheet->getCell('N' . $row)->getValue() == '0') {$sheet->setCellValue('N' . $row, '');}
      if($sheet->getCell('O' . $row)->getValue() == '0') {$sheet->setCellValue('O' . $row, '');}
      if($sheet->getCell('P' . $row)->getValue() == '0') {$sheet->setCellValue('P' . $row, '');}
      if($sheet->getCell('Q' . $row)->getValue() == '0') {$sheet->setCellValue('Q' . $row, '');}
      if($sheet->getCell('R' . $row)->getValue() == '0') {$sheet->setCellValue('R' . $row, '');}
      if($sheet->getCell('S' . $row)->getValue() == '0') {$sheet->setCellValue('S' . $row, '');}
      if($sheet->getCell('T' . $row)->getValue() == '0') {$sheet->setCellValue('T' . $row, '');}
      if($sheet->getCell('U' . $row)->getValue() == '0') {$sheet->setCellValue('U' . $row, '');}
      if($sheet->getCell('V' . $row)->getValue() == '0') {$sheet->setCellValue('V' . $row, '');}
      if($sheet->getCell('W' . $row)->getValue() == '0') {$sheet->setCellValue('W' . $row, '');}
      if($sheet->getCell('X' . $row)->getValue() == '0') {$sheet->setCellValue('X' . $row, '');}
      if($sheet->getCell('Y' . $row)->getValue() == '0') {$sheet->setCellValue('Y' . $row, '');}
      if($sheet->getCell('Z' . $row)->getValue() == '0') {$sheet->setCellValue('Z' . $row, '');}
      if($sheet->getCell('AA' . $row)->getValue() == '0') {$sheet->setCellValue('AA' . $row, '');}
      if($sheet->getCell('AB' . $row)->getValue() == '0') {$sheet->setCellValue('AB' . $row, '');}
      if($sheet->getCell('AC' . $row)->getValue() == '0') {$sheet->setCellValue('AC' . $row, '');}
      if($sheet->getCell('AD' . $row)->getValue() == '0') {$sheet->setCellValue('AD' . $row, '');}
      if($sheet->getCell('AE' . $row)->getValue() == '0') {$sheet->setCellValue('AE' . $row, '');}
      if($sheet->getCell('AF' . $row)->getValue() == '0') {$sheet->setCellValue('AF' . $row, '');}
      if($sheet->getCell('AG' . $row)->getValue() == '0') {$sheet->setCellValue('AG' . $row, '');}
      if($sheet->getCell('AH' . $row)->getValue() == '0') {$sheet->setCellValue('AH' . $row, '');}
      if($sheet->getCell('AI' . $row)->getValue() == '0') {$sheet->setCellValue('AI' . $row, '');}
      if($sheet->getCell('AJ' . $row)->getValue() == '0') {$sheet->setCellValue('AJ' . $row, '');}
      if($sheet->getCell('AK' . $row)->getValue() == '0') {$sheet->setCellValue('AK' . $row, '');}
      if($sheet->getCell('AL' . $row)->getValue() == '0') {$sheet->setCellValue('AL' . $row, '');}

      /* Заливка ячеек с измененным тарифом */
      if($v['mag_001_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('L' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
        }
      if($v['mag_003_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('M' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_007_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('N' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_009_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('O' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_010_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('P' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_011_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('Q' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_012_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('R' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_014_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('S' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_015_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_016_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('U' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_018_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('V' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_020_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('W' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_022_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('X' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_023_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('Y' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_024_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('Z' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_025_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AA' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_026_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AB' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_027_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AC' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_028_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AD' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_029_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AE' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_030_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AF' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_031_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AG' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_032_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AH' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_033_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AI' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_034_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AJ' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_035_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AK' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_037_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AL' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }

      $row++;
    }

    /* Ширина столбцов */
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

    /* Set Headers */
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="myfile.xlsx"');
    header('Cache-Control: max-age=0');

    /* Експорт в Ексель */
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
  }

}