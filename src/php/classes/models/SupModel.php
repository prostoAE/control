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
    $query = /** @lang Oracle */
        "SELECT DISTINCT
    --	mnt.id AS mount_id,
    pr.ID AS promoaction_id,
    TRUNC(per.START_DATE) AS START_DATE,
    TRUNC(per.END_DATE) AS END_DATE,
    segm.AID AS segment,
    TO_NUMBER(spl.CODE) AS frs,
    art.AUCHAN_CODE AS article,
    (case mnt.COMMENTS when 'TP' then (case typ.CODE when 'Ponton' then 'TGSC' when 'TG' then 'PPSC' else 'PISC' end) else (case typ.CODE when 'Ponton' then 'PPSC' when 'TG' then 'TGSC' else 'PISC' end) end) as type_promo,
    mnt.COMMENTS,
    null as super_ind,
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
    null AS \"027\",
    sum(CASE mag.CODE WHEN '028' then mnt.BUDGET ELSE 0 end) AS \"028\",
    sum(CASE mag.CODE WHEN '029' then mnt.BUDGET ELSE 0 end) AS \"029\",
    sum(CASE mag.CODE WHEN '030' then mnt.BUDGET ELSE 0 end) AS \"030\",
    sum(CASE mag.CODE WHEN '031' then mnt.BUDGET ELSE 0 end) AS \"031\",
    sum(CASE mag.CODE WHEN '032' then mnt.BUDGET ELSE 0 end) AS \"032\",
    sum(CASE mag.CODE WHEN '033' then mnt.BUDGET ELSE 0 end) AS \"033\",
    sum(CASE mag.CODE WHEN '034' then mnt.BUDGET ELSE 0 end) AS \"034\",
    sum(CASE mag.CODE WHEN '035' then mnt.BUDGET ELSE 0 end) AS \"035\",
    null AS \"037\"
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
    pr.ID,
    TRUNC(per.START_DATE),
    TRUNC(per.END_DATE),
    segm.AID,
    TO_NUMBER(spl.CODE),
    spl.NAME,
    art.AUCHAN_CODE,
    typ.CODE,
    mnt.COMMENTS
  UNION ALL
    SELECT DISTINCT
  --	mnt.id AS mount_id,
  pr.ID AS promoaction_id,
  TRUNC(per.START_DATE) AS START_DATE,
  TRUNC(per.END_DATE) AS END_DATE,
  segm.AID AS segment,
  TO_NUMBER(spl.CODE) AS frs,
  art.AUCHAN_CODE AS article,
  (case mnt.COMMENTS when 'TP' then (case typ.CODE when 'Ponton' then 'TGMF' when 'TG' then 'PPMF' else 'PIMF' end) else (case typ.CODE when 'Ponton' then 'PPMF' when 'TG' then 'TGMF' else 'PIMF' end) end) as type_promo,
  mnt.COMMENTS,
  '1' as super_ind,
  --	mnt.BUDGET,
  --	mag.CODE AS num_mag,
  null AS \"001\",
  null AS \"003\",
  null AS \"007\",
  null AS \"009\",
  null AS \"010\",
  null AS \"011\",
  null AS \"012\",
  null AS \"014\",
  null AS \"015\",
  null AS \"016\",
  null AS \"018\",
  null AS \"020\",
  null AS \"022\",
  null AS \"023\",
  null AS \"024\",
  null AS \"025\",
  null AS \"026\",
  sum(CASE mag.CODE WHEN '027' then mnt.BUDGET ELSE 0 end) AS \"027\",
  null AS \"028\",
  null AS \"029\",
  null AS \"030\",
  null AS \"031\",
  null AS \"032\",
  null AS \"033\",
  null AS \"034\",
  null AS \"035\",
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
  pr.ID,
  TRUNC(per.START_DATE),
  TRUNC(per.END_DATE),
  segm.AID,
  TO_NUMBER(spl.CODE),
  spl.NAME,
  art.AUCHAN_CODE,
  typ.CODE,
  mnt.COMMENTS";

    $result = Db::select(Db::connectSup(), $query, [$this->startDate, $this->endDate, $this->startDate, $this->endDate]);

    return $result;
  }

  /**
   * Метод загружает исходные данные в таблицу sup_source
   * @param $array
   */
  public function insertSourceData($array) {
    foreach ($array as $k => $v) {
      $query = "INSERT INTO sup_source (promoaction_id,start_date,end_date,segment,frs,article,type_promo,comments,super_ind,mag_001,mag_003,mag_007,mag_009,mag_010,mag_011,mag_012,mag_014,mag_015,mag_016,mag_018,mag_020,mag_022,mag_023,mag_024,mag_025,mag_026,mag_027,mag_028,mag_029,mag_030,mag_031,mag_032,mag_033,mag_034,mag_035,mag_037)
    VALUES ('{$v['PROMOACTION_ID']}', STR_TO_DATE('{$v['START_DATE']}', '%d.%m.%Y'), STR_TO_DATE('{$v['END_DATE']}', '%d.%m.%Y'),'{$v['SEGMENT']}','{$v['FRS']}','{$v['ARTICLE']}','{$v['TYPE_PROMO']}','{$v['COMMENTS']}','{$v['SUPER_IND']}','{$v['001']}', '{$v['003']}', '{$v['007']}', '{$v['009']}', '{$v['010']}', '{$v['011']}', '{$v['012']}', '{$v['014']}', '{$v['015']}', '{$v['016']}', '{$v['018']}', '{$v['020']}', '{$v['022']}', '{$v['023']}', '{$v['024']}', '{$v['025']}', '{$v['026']}', '{$v['027']}', '{$v['028']}', '{$v['029']}', '{$v['030']}', '{$v['031']}', '{$v['032']}', '{$v['033']}', '{$v['034']}', '{$v['035']}', '{$v['037']}')";
      Db::insert(Db::connectSql(), $query);
    }
  }

  /**
   * Метод получает данные из таблицы источника
   * @return mixed
   */
  public function getDataFromSourceTable($startDate, $endDate) {
    $query = /** @lang MySQL */
        "select
    src.promoaction_id,
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
    src.super_ind,
    an.billing_cost_per_service,
    max(src.mag_001) as mag_001,
    max(src.mag_003) as mag_003,
    max(src.mag_007) as mag_007,
    max(src.mag_009) as mag_009,
    max(src.mag_010) as mag_010,
    max(src.mag_011) as mag_011,
    max(src.mag_012) as mag_012,
    max(src.mag_014) as mag_014,
    max(src.mag_015) as mag_015,
    max(src.mag_016) as mag_016,
    max(src.mag_018) as mag_018,
    max(src.mag_020) as mag_020,
    max(src.mag_022) as mag_022,
    max(src.mag_023) as mag_023,
    max(src.mag_024) as mag_024,
    max(src.mag_025) as mag_025,
    max(src.mag_026) as mag_026,
    max(src.mag_027) as mag_027,
    max(src.mag_028) as mag_028,
    max(src.mag_029) as mag_029,
    max(src.mag_030) as mag_030,
    max(src.mag_031) as mag_031,
    max(src.mag_032) as mag_032,
    max(src.mag_033) as mag_033,
    max(src.mag_034) as mag_034,
    max(src.mag_035) as mag_035,
    max(src.mag_037) as mag_037
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
  where src.start_date >= str_to_date(?, '%d.%m.%Y')
    and src.end_date <= str_to_date(?, '%d.%m.%Y')
  group by
    src.promoaction_id,
    src.start_date,
    src.end_date,
    cca.buyer,
    cca.short_condition,
    cca.n_agreement,
    src.segment,
    src.frs,
    src.type_promo,
    src.comments,
    src.super_ind,
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
      $query = "insert into sup_final (promoaction_id,start_date, end_date, buyer, short_condition, n_agreement, segment, frs, article, type_promo, comments, billing_cost_per_service,super_ind, mag_001, mag_003, mag_007, mag_009, mag_010, mag_011, mag_012, mag_014, mag_015, mag_016, mag_018, mag_020, mag_022, mag_023, mag_024, mag_025, mag_026, mag_027, mag_028, mag_029, mag_030, mag_031, mag_032, mag_033, mag_034, mag_035, mag_037)
      values ('{$item['promoaction_id']}', '{$item['start_date']}', '{$item['end_date']}', '{$item['buyer']}', '{$item['short_condition']}', '{$item['n_agreement']}', '{$item['segment']}', '{$item['frs']}', '{$item['article']}', '{$item['type_promo']}', '{$item['comments']}', '{$item['billing_cost_per_service']}', '{$item['super_ind']}', '{$item['mag_001']}', '{$item['mag_003']}', '{$item['mag_007']}', '{$item['mag_009']}', '{$item['mag_010']}', '{$item['mag_011']}', '{$item['mag_012']}', '{$item['mag_014']}', '{$item['mag_015']}', '{$item['mag_016']}', '{$item['mag_018']}', '{$item['mag_020']}', '{$item['mag_022']}', '{$item['mag_023']}', '{$item['mag_024']}', '{$item['mag_025']}', '{$item['mag_026']}', '{$item['mag_027']}', '{$item['mag_028']}', '{$item['mag_029']}', '{$item['mag_030']}', '{$item['mag_031']}', '{$item['mag_032']}', '{$item['mag_033']}', '{$item['mag_034']}', '{$item['mag_035']}', '{$item['mag_037']}')";

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
   * @param $users
   * @return string
   */
  public function filter($array, $users) {
    $dateFrom = ' and start_date >= '. "'" .$array['date-from'] . "'";
    $dateTo = ' and end_date <= '. "'" . $array['date-to'] . "'";
    if($array['buyer'] != '' && $array['buyer'] != 'BUYER') {
      $buyer = ' and buyer = ' . "'" . $array['buyer'] . "'";
    } elseif($array['buyer'] == 'BUYER' && User::getUserAccess() > 2) {
      $buyer = ' and buyer in('.$users.') ';
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
    $query = /** @lang MySQL */
        "select *,
       (if(mag_001_confirmed is null, mag_001, mag_001_confirmed) +
       if(mag_003_confirmed is null, mag_003, mag_003_confirmed) +
       if(mag_007_confirmed is null, mag_007, mag_007_confirmed) +
       if(mag_009_confirmed is null, mag_009, mag_009_confirmed) +
       if(mag_010_confirmed is null, mag_010, mag_010_confirmed) +
       if(mag_011_confirmed is null, mag_011, mag_011_confirmed) +
       if(mag_012_confirmed is null, mag_012, mag_012_confirmed) +
       if(mag_014_confirmed is null, mag_014, mag_014_confirmed) +
       if(mag_015_confirmed is null, mag_015, mag_015_confirmed) +
       if(mag_016_confirmed is null, mag_016, mag_016_confirmed) +
       if(mag_018_confirmed is null, mag_018, mag_018_confirmed) +
       if(mag_020_confirmed is null, mag_020, mag_020_confirmed) +
       if(mag_022_confirmed is null, mag_022, mag_022_confirmed) +
       if(mag_023_confirmed is null, mag_023, mag_023_confirmed) +
       if(mag_024_confirmed is null, mag_024, mag_024_confirmed) +
       if(mag_025_confirmed is null, mag_025, mag_025_confirmed) +
       if(mag_026_confirmed is null, mag_026, mag_026_confirmed) +
       if(mag_028_confirmed is null, mag_028, mag_028_confirmed) +
       if(mag_029_confirmed is null, mag_029, mag_029_confirmed) +
       if(mag_030_confirmed is null, mag_030, mag_030_confirmed) +
       if(mag_031_confirmed is null, mag_031, mag_031_confirmed) +
       if(mag_032_confirmed is null, mag_032, mag_032_confirmed) +
       if(mag_033_confirmed is null, mag_033, mag_033_confirmed) +
       if(mag_034_confirmed is null, mag_034, mag_034_confirmed) +
       if(mag_035_confirmed is null, mag_035, mag_035_confirmed) +
       if(mag_027_confirmed is null, mag_027, mag_027_confirmed) +
       if(mag_037_confirmed is null, mag_037, mag_037_confirmed)) as cost_total
      from sup_final where {$cond}";

//    echo $query;
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