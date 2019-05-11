<?php

namespace php\classes\controllers;

use php\classes\models\AneeModel;
use php\classes\models\Db;
use php\classes\models\SupModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
    $sheet->setTitle('Feuil1');

    /* Установка автофильтра */
    $sheet->setAutoFilter('A2:AO2');

    /* Установка цвета заголовка таблицы */
    $sheet->getStyle('A1:AO2')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('E8E8E8');

    /* Перенос строк заголовка */
    $sheet->getStyle('A1:AO1')->getAlignment()->setWrapText(true);

    /* Высота первой и второй строки */
    $sheet->getRowDimension('1')->setRowHeight(30);
    $sheet->getRowDimension('2')->setRowHeight(30);

    /* Заголовок таблицы */
    /* Первая строка */
    $sheet->setCellValue('O1', 'PETR_001 PETROVKA');
    $sheet->setCellValue('P1', 'ELEC_003 KILTSEVA');
    $sheet->setCellValue('Q1', 'BERK_007 BELICHI');
    $sheet->setCellValue('R1', 'LVIV_009 LVIV');
    $sheet->setCellValue('S1', 'KOK_010 RADUJNIY');
    $sheet->setCellValue('T1', 'ZOK_011 ZAPOROGIE');
    $sheet->setCellValue('U1', 'KROG_012 KRIVOY ROG');
    $sheet->setCellValue('V1', 'KIDE_014 RIVE GAUCHE');
    $sheet->setCellValue('W1', 'LIBI_015 LIBIDSKA');
    $sheet->setCellValue('X1', 'FONT_016 FONTANKA');
    $sheet->setCellValue('Y1', 'MAGN_018 TCHERNIGIVS');
    $sheet->setCellValue('Z1', 'LPI_020 PIVDENNYI');
    $sheet->setCellValue('AA1', 'LAVА_022');
    $sheet->setCellValue('AB1', 'KMAG_023 Hluckova');
    $sheet->setCellValue('AC1', 'KSOS_024 Sosninykh');
    $sheet->setCellValue('AD1', 'KLUG_025 LUGOVA');
    $sheet->setCellValue('AE1', 'KHTR_026 Kharkiv - Heroyiv Pratsi');
    $sheet->setCellValue('AF1', 'KHMA_028 Kharkiv - Kil\'tseva');
    $sheet->setCellValue('AG1', 'DKAR_029 DNIPRO');
    $sheet->setCellValue('AH1', 'ZKAR_030 Zhytomyr');
    $sheet->setCellValue('AI1', 'CHKA_031 Chernivtsi');
    $sheet->setCellValue('AJ1', '32');
    $sheet->setCellValue('AK1', '33');
    $sheet->setCellValue('AL1', '34');
    $sheet->setCellValue('AM1', '35');
    $sheet->setCellValue('AN1', 'KHTA_027  Kharkiv - Tarasivs\'ka');
    $sheet->setCellValue('AO1', 'DAFI_037 Зоряный');

    /* Вторая строка */
    $sheet->setCellValue('A2', 'отдел');
    $sheet->setCellValue('B2', 'закупщик');
    $sheet->setCellValue('C2', 'Negotiation group');
    $sheet->setCellValue('D2', 'supplier code');
    $sheet->setCellValue('E2', 'supplier name');
    $sheet->setCellValue('F2', 'oracle number');
    $sheet->setCellValue('G2', 'promo term');
    $sheet->setCellValue('H2', 'article');
    $sheet->setCellValue('I2', 'Comment');
    $sheet->setCellValue('J2', 'date of invoice');
    $sheet->setCellValue('K2', 'buyer');
    $sheet->setCellValue('L2', 'amount no vat');
    $sheet->setCellValue('M2', 'option service code');
    $sheet->setCellValue('N2', 'service code');
    $sheet->setCellValue('O2', 'PETR');
    $sheet->setCellValue('P2', 'ELEC');
    $sheet->setCellValue('Q2', 'BERK');
    $sheet->setCellValue('R2', 'LVIV');
    $sheet->setCellValue('S2', 'KOK ');
    $sheet->setCellValue('T2', 'ZOK ');
    $sheet->setCellValue('U2', 'KROG');
    $sheet->setCellValue('V2', 'KIDE');
    $sheet->setCellValue('W2', 'LIBI');
    $sheet->setCellValue('X2', 'FONT');
    $sheet->setCellValue('Y2', 'MAGN');
    $sheet->setCellValue('Z2', 'LPI');
    $sheet->setCellValue('AA2', 'LAVA');
    $sheet->setCellValue('AB2', 'KMAG');
    $sheet->setCellValue('AC2', 'KSOS');
    $sheet->setCellValue('AD2', 'KLUG');
    $sheet->setCellValue('AE2', 'KHTR');
    $sheet->setCellValue('AF2', 'KHMA');
    $sheet->setCellValue('AG2', 'DKAR');
    $sheet->setCellValue('AH2', 'ZKAR');
    $sheet->setCellValue('AI2', 'CHKA');
    $sheet->setCellValue('AJ2', 'mag_032');
    $sheet->setCellValue('AK2', 'mag_033');
    $sheet->setCellValue('AL2', 'mag_034');
    $sheet->setCellValue('AM2', 'mag_035');
    $sheet->setCellValue('AN2', 'KHTA');
    $sheet->setCellValue('AO2', 'DAFI');

    /* Заполнение ячеек */
    $row = 3;
    foreach ($data as $k => $v) {
      $sheet->setCellValue('A' . $row, $v['short_condition']);
      $sheet->setCellValue('B' . $row, $v['buyer']);
      $sheet->setCellValue('C' . $row, $v['segment']);
      $sheet->setCellValue('D' . $row, $v['frs']);
      $sheet->setCellValue('E' . $row, AneeModel::getSupplierName($v['frs']));
      $sheet->setCellValue('F' . $row, $v['billing_cost_per_service']);
      $sheet->setCellValue('G' . $row, $v['comments']);
      $sheet->setCellValue('H' . $row, $v['article']);
      $sheet->setCellValue('I' . $row, date("d.m.Y", strtotime($v['start_date'])) . ' - ' . date("d.m.Y", strtotime($v['end_date'])));
      $sheet->setCellValue('J' . $row, date('d.m.Y'));
      $sheet->setCellValue('K' . $row, '');
      $sheet->setCellValue('L' . $row, $v['cost_total']);
      $sheet->setCellValue('M' . $row, '');
      $sheet->setCellValue('N' . $row, $v['type_promo']);
      $sheet->setCellValue('O' . $row, $v['mag_001_confirmed'] >= '0'? $v['mag_001_confirmed']: $v['mag_001']);
      $sheet->setCellValue('P' . $row, $v['mag_003_confirmed'] >= '0'? $v['mag_003_confirmed']: $v['mag_003']);
      $sheet->setCellValue('Q' . $row, $v['mag_007_confirmed'] >= '0'? $v['mag_007_confirmed']: $v['mag_007']);
      $sheet->setCellValue('R' . $row, $v['mag_009_confirmed'] >= '0'? $v['mag_009_confirmed']: $v['mag_009']);
      $sheet->setCellValue('S' . $row, $v['mag_010_confirmed'] >= '0'? $v['mag_010_confirmed']: $v['mag_010']);
      $sheet->setCellValue('T' . $row, $v['mag_011_confirmed'] >= '0'? $v['mag_011_confirmed']: $v['mag_011']);
      $sheet->setCellValue('U' . $row, $v['mag_012_confirmed'] >= '0'? $v['mag_012_confirmed']: $v['mag_012']);
      $sheet->setCellValue('V' . $row, $v['mag_014_confirmed'] >= '0'? $v['mag_014_confirmed']: $v['mag_014']);
      $sheet->setCellValue('W' . $row, $v['mag_015_confirmed'] >= '0'? $v['mag_015_confirmed']: $v['mag_015']);
      $sheet->setCellValue('X' . $row, $v['mag_016_confirmed'] >= '0'? $v['mag_016_confirmed']: $v['mag_016']);
      $sheet->setCellValue('Y' . $row, $v['mag_018_confirmed'] >= '0'? $v['mag_018_confirmed']: $v['mag_018']);
      $sheet->setCellValue('Z' . $row, $v['mag_020_confirmed'] >= '0'? $v['mag_020_confirmed']: $v['mag_020']);
      $sheet->setCellValue('AA' . $row, $v['mag_022_confirmed'] >= '0'? $v['mag_022_confirmed']: $v['mag_022']);
      $sheet->setCellValue('AB' . $row, $v['mag_023_confirmed'] >= '0'? $v['mag_023_confirmed']: $v['mag_023']);
      $sheet->setCellValue('AC' . $row, $v['mag_024_confirmed'] >= '0'? $v['mag_024_confirmed']: $v['mag_024']);
      $sheet->setCellValue('AD' . $row, $v['mag_025_confirmed'] >= '0'? $v['mag_025_confirmed']: $v['mag_025']);
      $sheet->setCellValue('AE' . $row, $v['mag_026_confirmed'] >= '0'? $v['mag_026_confirmed']: $v['mag_026']);
      $sheet->setCellValue('AF' . $row, $v['mag_028_confirmed'] >= '0'? $v['mag_028_confirmed']: $v['mag_028']);
      $sheet->setCellValue('AG' . $row, $v['mag_029_confirmed'] >= '0'? $v['mag_029_confirmed']: $v['mag_029']);
      $sheet->setCellValue('AH' . $row, $v['mag_030_confirmed'] >= '0'? $v['mag_030_confirmed']: $v['mag_030']);
      $sheet->setCellValue('AI' . $row, $v['mag_031_confirmed'] >= '0'? $v['mag_031_confirmed']: $v['mag_031']);
      $sheet->setCellValue('AJ' . $row, $v['mag_032_confirmed'] >= '0'? $v['mag_032_confirmed']: $v['mag_032']);
      $sheet->setCellValue('AK' . $row, $v['mag_033_confirmed'] >= '0'? $v['mag_033_confirmed']: $v['mag_033']);
      $sheet->setCellValue('AL' . $row, $v['mag_034_confirmed'] >= '0'? $v['mag_034_confirmed']: $v['mag_034']);
      $sheet->setCellValue('AM' . $row, $v['mag_035_confirmed'] >= '0'? $v['mag_035_confirmed']: $v['mag_035']);
      $sheet->setCellValue('AN' . $row, $v['mag_027_confirmed'] >= '0'? $v['mag_027_confirmed']: $v['mag_027']);
      $sheet->setCellValue('AO' . $row, $v['mag_037_confirmed'] >= '0'? $v['mag_037_confirmed']: $v['mag_037']);

      /* ЗЗамена нулей на пустую строку */
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
      if($sheet->getCell('AM' . $row)->getValue() == '0') {$sheet->setCellValue('AM' . $row, '');}
      if($sheet->getCell('AN' . $row)->getValue() == '0') {$sheet->setCellValue('AN' . $row, '');}
      if($sheet->getCell('AO' . $row)->getValue() == '0') {$sheet->setCellValue('AO' . $row, '');}

      /* Заливка ячеек с измененным тарифом */
      if($v['mag_001_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('O' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
        }
      if($v['mag_003_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('P' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_007_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('Q' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_009_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('R' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_010_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('S' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_011_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_012_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('U' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_014_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('V' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_015_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('W' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_016_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('X' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_018_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('Y' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_020_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('Z' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_022_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AA' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_023_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AB' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_024_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AC' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_025_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AD' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_026_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AE' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_027_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AF' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_028_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AG' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_029_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AH' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_030_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AI' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_031_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AJ' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_032_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AK' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_033_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AL' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_034_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AM' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_035_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AN' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }
      if($v['mag_037_confirmed'] >= '0') {
        $spreadsheet->getActiveSheet()->getStyle('AO' . $row)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEFFCF');
      }

      $row++;
    }

    /* Ширина столбцов */
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $sheet->getColumnDimension('K')->setAutoSize(true);
    $sheet->getColumnDimension('L')->setAutoSize(true);
    $sheet->getColumnDimension('M')->setAutoSize(true);
    $sheet->getColumnDimension('N')->setAutoSize(true);

    /* Set Headers */
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="myfile.xlsx"');
    header('Cache-Control: max-age=0');

    /* Експорт в Ексель */
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
  }

  /* Выход из системы */
  public function logoutAction() {
    session_destroy();
  }

  /**
   * Метод устанавливает год агримента в базе данных
   * @void
   */
  public function agreementUpdateAction() {
    $sup = new SupModel();
    $sup->setAgreementYear($_POST['agrYear']);
  }

  /**
   * Обновление таблицы ССА в базе данных
   * @void
   */
  public function ccaUpdateAction() {
    $anee = new AneeModel();
    $sup = new SupModel();
    $data = $anee->getCcaList($_POST['agrYear']);
    $sup->insertToCcaTable($data, $_POST['agrYear']);
  }

  /**
   * Обновление тарифов промо в базе данных
   * @void
   */
  public function serviceUpdateAction() {
    $anee = new AneeModel();
    $sup = new SupModel();
    $data = $anee->getServiceList($_POST['agrYear']);
    $sup->insertServiceToTable($data);
  }

  /**
   * Метод загружает данные из СУП в таблицу источник и финальную таблицу
   * @void
   */
  public function supLoadAction() {
    $from = date("d.m.Y", strtotime($_POST['date-from']));
    $to = date("d.m.Y", strtotime($_POST['date-to']));
    $sup = new SupModel();
    $sup->setStartDate($from);
    $sup->setEndDate($to);
    $sourceData = $sup->loadSourceData();
    $sup->insertSourceData($sourceData);
    $data = $sup->getDataFromSourceTable($from, $to);
    $sup->insertToFinalTable($data);
  }

  /**
   * Метод удаляет пользователя из таблицы cdg_users
   * @void
   */
  public function deleteUserAction() {
    $id = $_POST['user'];
    $query = /** @lang MySQL */
        "delete from cdg_users where id = {$id}";
    Db::set(Db::connectSql(), $query);
  }

  /**
   * Метод добавляет пользователя в таблицу cdg_users
   * @void
   */
  public function addUserAction() {
    $array = json_decode($_POST['data'], true);
    $count = count($array);
    $mainUser = $array[0]['value'];
    $mainUserName = AneeModel::getFullnameByUkr($array[0]['value']);
    $accessLvl = $array[1]['value'];

    if($count > 2) {
      for ($i = 2; $i < count($array); $i++) {
        $userLink = AneeModel::getFullnameByUkr($array[$i]['value']);
        $query = /** @lang MySQL */
            "insert into cdg_users (ukr, full_name, user_access, user_link) values ('$mainUser', '$mainUserName', '$accessLvl', '$userLink')";
        Db::insert(Db::connectSql(), $query);
      }
    } else {
      $query = /** @lang MySQL */
          "insert into cdg_users (ukr, full_name, user_access) values ('$mainUser', '$mainUserName', '$accessLvl')";
      Db::insert(Db::connectSql(), $query);
    }
  }

  public function workPeriodAction() {
    $query = /** @lang MySQL */
        "select * from cdg_work_period";
    $array = Db::select(Db::connectSql(), $query);
    $result = json_encode($array);
    echo $result;
  }

}