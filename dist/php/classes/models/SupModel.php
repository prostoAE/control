<?php

namespace php\classes\models;

set_time_limit(15000);

class SupModel {


  private $startDate;
  private $endDate;

  /**
   * @param mixed $start
   * метод устанавливает дату начала промо периода
   */
  public function setStartDate($start) {
    $this->startDate = $start;
  }

  /**
   * @param mixed $end
   * метод устанавливает дату конца промо периода
   */
  public function setEndDate($end) {
    $this->endDate = $end;
  }

  /**
   * метод получает данные из СУП за указаный период и загружает в таблицу источник
   */
  public function loadSourceData() {
    $query = "SELECT DISTINCT
  --	mnt.id AS mount_id,
  --	pr.ID AS promoaction_id,
    TRUNC(per.START_DATE) AS START_DATE,
    TRUNC(per.END_DATE) AS END_DATE,
    segm.AID AS segment,
    TO_NUMBER(spl.CODE) AS frs,
    art.AUCHAN_CODE AS article,
    (case typ.CODE when 'Ponton' then 'PPSC' when 'TG' then 'TGSC' else 'PISC' end) as type_promo,
    mnt.COMMENTS,
  --	mnt.BUDGET,
  --	mag.CODE AS num_mag,
    sum(CASE mag.CODE WHEN '001' then mnt.BUDGET ELSE 0 end) AS \"001\",
    sum(CASE mag.CODE WHEN '003' then mnt.BUDGET ELSE 0 end) AS \"003\",
    sum(CASE mag.CODE WHEN '007' then mnt.BUDGET ELSE 0 end) AS \"007\",
    sum(CASE mag.CODE WHEN '009' then mnt.BUDGET ELSE 0 end) AS \"009\",
    sum(CASE mag.CODE WHEN '010' then mnt.BUDGET ELSE 0 end) AS \"010\",
    sum(CASE mag.CODE WHEN '011' then mnt.BUDGET ELSE 0 end) AS \"011\",
    sum(CASE mag.CODE WHEN '012' then mnt.BUDGET ELSE 0 end) AS \"012\",
    sum(CASE mag.CODE WHEN '014' then mnt.BUDGET ELSE 0 end) AS \"014\",
    sum(CASE mag.CODE WHEN '015' then mnt.BUDGET ELSE 0 end) AS \"015\",
    sum(CASE mag.CODE WHEN '016' then mnt.BUDGET ELSE 0 end) AS \"016\",
    sum(CASE mag.CODE WHEN '018' then mnt.BUDGET ELSE 0 end) AS \"018\",
    sum(CASE mag.CODE WHEN '020' then mnt.BUDGET ELSE 0 end) AS \"020\",
    sum(CASE mag.CODE WHEN '022' then mnt.BUDGET ELSE 0 end) AS \"022\",
    sum(CASE mag.CODE WHEN '023' then mnt.BUDGET ELSE 0 end) AS \"023\",
    sum(CASE mag.CODE WHEN '024' then mnt.BUDGET ELSE 0 end) AS \"024\",
    sum(CASE mag.CODE WHEN '025' then mnt.BUDGET ELSE 0 end) AS \"025\",
    sum(CASE mag.CODE WHEN '026' then mnt.BUDGET ELSE 0 end) AS \"026\",
    sum(CASE mag.CODE WHEN '027' then mnt.BUDGET ELSE 0 end) AS \"027\",
    sum(CASE mag.CODE WHEN '028' then mnt.BUDGET ELSE 0 end) AS \"028\",
    sum(CASE mag.CODE WHEN '029' then mnt.BUDGET ELSE 0 end) AS \"029\",
    sum(CASE mag.CODE WHEN '030' then mnt.BUDGET ELSE 0 end) AS \"030\",
    sum(CASE mag.CODE WHEN '031' then mnt.BUDGET ELSE 0 end) AS \"031\",
    sum(CASE mag.CODE WHEN '032' then mnt.BUDGET ELSE 0 end) AS \"032\",
    sum(CASE mag.CODE WHEN '033' then mnt.BUDGET ELSE 0 end) AS \"033\",
    sum(CASE mag.CODE WHEN '034' then mnt.BUDGET ELSE 0 end) AS \"034\",
    sum(CASE mag.CODE WHEN '035' then mnt.BUDGET ELSE 0 end) AS \"035\",
    sum(CASE mag.CODE WHEN '037' then mnt.BUDGET ELSE 0 end) AS \"037\"
    FROM
      PROMO6.PROMOACTION pr
    LEFT JOIN
      PROMO6.PERIOD_CALENDAR per
      ON pr.PERIOD_CALENDAR_ID = per.ID
    LEFT JOIN
      PROMO6.SEGMENT segm
      ON segm.ID = pr.SEGMENT_ID
    LEFT JOIN
      PROMO6.MOUNT mnt
      ON mnt.PROMOACTION_ID = pr.ID
    LEFT JOIN
      PROMO6.STORE mag
      ON mnt.STORE_ID = mag.ID
    LEFT JOIN
      PROMO6.SUPPLIER spl
      ON mnt.SUPPLIER_ID = spl.ID
    --LEFT JOIN
    --	PROMO6.PROMOACTION_GOODS pag
    --	ON pag.PROMOACTION_ID = pr.ID
    LEFT JOIN
      PROMO6.MOUNT_GOODS art
      ON mnt.ID = art.MOUNT_ID
    LEFT JOIN
      PROMO6.PA_TYPE typ
      ON pr.PA_TYPE_ID = typ.ID
    WHERE
      per.START_DATE >= TO_DATE(?)
      AND per.END_DATE <= TO_DATE(?)
      AND pr.IS_BROKEN = '0'
      AND mnt.PROMOACTION_ID IS NOT NULL
    -- AND art.AUCHAN_CODE = '338192'
    -- AND spl.CODE = '535'
    --	AND mag.CODE = 24
    GROUP BY
    --	mnt.id,
    --	pr.ID,
      TRUNC(per.START_DATE),
      TRUNC(per.END_DATE),
      segm.AID,
      TO_NUMBER(spl.CODE),
      spl.NAME,
      art.AUCHAN_CODE,
      typ.CODE,
      mnt.COMMENTS";

    $result = Db::select(Db::connectSup(), $query, [$this->startDate, $this->endDate]);

    return $result;
  }

  /**
   * Метод загружает исходные данные в таблицу sup_source
   * @param $array
   */
  public function insertSourceData($array) {
    foreach ($array as $k => $v) {
      $query = "INSERT INTO sup_source (start_date,end_date,segment,frs,article,type_promo,comments,mag_001,mag_003,mag_007,mag_009,mag_010,mag_011,mag_012,mag_014,mag_015,mag_016,mag_018,mag_020,mag_022,mag_023,mag_024,mag_025,mag_026,mag_027,mag_028,mag_029,mag_030,mag_031,mag_032,mag_033,mag_034,mag_035,mag_037)
    VALUES (STR_TO_DATE('{$v['START_DATE']}', '%d.%m.%Y'), STR_TO_DATE('{$v['END_DATE']}', '%d.%m.%Y'),'{$v['SEGMENT']}','{$v['FRS']}','{$v['ARTICLE']}','{$v['TYPE_PROMO']}','{$v['COMMENTS']}', '{$v['001']}', '{$v['003']}', '{$v['007']}', '{$v['009']}', '{$v['010']}', '{$v['011']}', '{$v['012']}', '{$v['014']}', '{$v['015']}', '{$v['016']}', '{$v['018']}', '{$v['020']}', '{$v['022']}', '{$v['023']}', '{$v['024']}', '{$v['025']}', '{$v['026']}', '{$v['027']}', '{$v['028']}', '{$v['029']}', '{$v['030']}', '{$v['031']}', '{$v['032']}', '{$v['033']}', '{$v['034']}', '{$v['035']}', '{$v['037']}')";
      Db::insert(Db::connectSql(), $query);
    }
  }

  /**
   * Метод получает данные из таблицы источника
   * @return mixed
   */
  public function getDataFromSourceTable($startDate, $endDate) {
    $query = "select
    src.start_date,
    src.end_date,
    cca.buyer,
    cca.short_condition,
    cca.n_agreement,
    src.segment,
    src.frs,
    max(src.article) as article,
    src.type_promo,
    src.comments,
    an.billing_cost_per_service,
    src.mag_001,
    src.mag_003,
    src.mag_007,
    src.mag_009,
    src.mag_010,
    src.mag_011,
    src.mag_012,
    src.mag_014,
    src.mag_015,
    src.mag_016,
    src.mag_018,
    src.mag_020,
    src.mag_022,
    src.mag_023,
    src.mag_024,
    src.mag_025,
    src.mag_026,
    src.mag_027,
    src.mag_028,
    src.mag_029,
    src.mag_030,
    src.mag_031,
    src.mag_032,
    src.mag_033,
    src.mag_034,
    src.mag_035,
    src.mag_037
  from
    sup_source src
  left join
    anee_service an
    on an.cod_utl_supplier = src.frs
    and an.id_negotiation_group = src.segment
    and an.id_service_type = src.type_promo
  left join
    cca_2019 cca
    on src.frs = cca.supplier
    and src.segment = cca.id_negotiation_group
  where src.start_date >= str_to_date(?, '%Y.%m.%d')
    and src.end_date <= str_to_date(?, '%Y.%m.%d')
  group by
    src.start_date,
    src.end_date,
    cca.buyer,
    cca.short_condition,
    cca.n_agreement,
    src.segment,
    src.frs,
    src.type_promo,
    src.comments,
    an.billing_cost_per_service";

    $result = Db::select(Db::connectSql(), $query, [$startDate, $endDate]);

    return $result;
  }

  /**
   * Метод загружает окончательный вариант данных в таблицу sup_final
   * @param $array
   */
  public function insertToFinalTable($array) {
    foreach ($array as $item) {
      $query = "insert into sup_final (start_date, end_date, buyer, short_condition, n_agreement, segment, frs, article, type_promo, comments, billing_cost_per_service, mag_001, mag_003, mag_007, mag_009, mag_010, mag_011, mag_012, mag_014, mag_015, mag_016, mag_018, mag_020, mag_022, mag_023, mag_024, mag_025, mag_026, mag_027, mag_028, mag_029, mag_030, mag_031, mag_032, mag_033, mag_034, mag_035, mag_037)
      values ('{$item['start_date']}', '{$item['end_date']}', '{$item['buyer']}', '{$item['short_condition']}', '{$item['n_agreement']}', '{$item['segment']}', '{$item['frs']}', '{$item['article']}', '{$item['type_promo']}', '{$item['comments']}', '{$item['billing_cost_per_service']}', '{$item['mag_001']}', '{$item['mag_003']}', '{$item['mag_007']}', '{$item['mag_009']}', '{$item['mag_010']}', '{$item['mag_011']}', '{$item['mag_012']}', '{$item['mag_014']}', '{$item['mag_015']}', '{$item['mag_016']}', '{$item['mag_018']}', '{$item['mag_020']}', '{$item['mag_022']}', '{$item['mag_023']}', '{$item['mag_024']}', '{$item['mag_025']}', '{$item['mag_026']}', '{$item['mag_027']}', '{$item['mag_028']}', '{$item['mag_029']}', '{$item['mag_030']}', '{$item['mag_031']}', '{$item['mag_032']}', '{$item['mag_033']}', '{$item['mag_034']}', '{$item['mag_035']}', '{$item['mag_037']}')";

      Db::insert(Db::connectSql(),$query);
    }
  }

  public function getDataFromFinal($query) {
    $result = Db::select(Db::connectSql(), $query);
    return $result;
  }

  /**
   * Метод формирует запрос по данным из фильтра
   * @param $array
   * @return string
   */
  public function filter($array) {
    $dateFrom = ' and start_date >= '. "'" .$array['date-from'] . "'";
    $dateTo = ' and end_date <= '. "'" . $array['date-to'] . "'";
    if($array['buyer'] != '' && $array['buyer'] != 'BUYER') {
      $buyer = ' and buyer = ' . "'" . $array['buyer'] . "'";
    }
    if($array['group'] != '' && $array['group'] != 'GROUP') {
      $group = ' and short_condition = ' . "'" . $array['group'] . "'";
    }
    if($array['supplier'] != '' && $array['supplier'] != 'supplier') {
      $supplier = ' and frs = ' . $array['supplier'];
    }
    if($array['article'] != '' && $array['article'] != 'article') {
      $article = ' and article = ' . $array['article'];
    }

    $arr = [];
    $dateFrom ? array_push($arr, $dateFrom) : false;
    $dateTo ? array_push($arr, $dateTo) : false;
    isset($buyer) ? array_push($arr, $buyer) : false;
    isset($group) ? array_push($arr, $group) : false;
    isset($supplier) ? array_push($arr, $supplier) : false;
    isset($article) ? array_push($arr, $article) : false;

    $cond = '';
    foreach ($arr as $item) {
      $cond .= $item;
    }
    $cond = substr($cond, 4);
    $query = "select * from sup_final where {$cond}";

    return $query;
  }

  /**
   * Метод загружает мыссив данных (уникальная связка) в таблицу ссф_"ГОД"
   * @param $array
   */
  public function insertToCcaTable($array, $year) {
    Db::set(Db::connectSql(), "TRUNCATE TABLE cca_{$year}");

    foreach ($array as $item) {
      $agr = $item['N_AGREEMENT'];
      $segm = $item['ID_NEGOTIATION_GROUP'];
      $type = $item['ID_AGR_TYPE'];
      $buyer = $item['NAME'];
      $group = $item['SHORT_CONDITION'];
      $supplier = $item['COD_UTL_SUPPLIER'];

      $query = "INSERT INTO cca_{$year} (n_Agreement, id_negotiation_group, ID_AGR_TYPE, buyer, SHORT_CONDITION, Supplier) VALUES ('$agr', '$segm', '$type', '$buyer', '$group', '$supplier')";

      Db::insert(Db::connectSql(), $query);
    }
  }

  /**
   * Метод загружает массив данных (тарифы промо) в таблицу anee_service
   * @param $array
   * @param $year
   */
  public function insertServiceToTable($array) {
    Db::set(Db::connectSql(), "TRUNCATE TABLE anee_service");

    foreach ($array as $v) {
      $query = "INSERT INTO anee_service (n_agreement, cod_utl_supplier, id_negotiation_group, nb_fiscal, id_service_type, billing_cost_per_service, qty_per_store, total_qty, total_amount)
      VALUES ('{$v['N_AGREEMENT']}', '{$v['COD_UTL_SUPPLIER']}', '{$v['ID_NEGOTIATION_GROUP']}', '{$v['NB_FISCAL']}', '{$v['ID_SERVICE_TYPE']}', '{$v['BILLING_COST_PER_SERVICE']}', '{$v['QTY_PER_STORE']}', '{$v['TOTAL_QTY']}', '{$v['TOTAL_AMOUNT']}')";

      Db::insert(Db::connectSql(), $query);
    }
  }

}