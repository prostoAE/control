<?php

namespace php\classes\models;

class AneeModel {


  /**
   * Метод получает из АНЕЕ перечень закупщиков за указаный год
   * @param int $year
   * @return mixed
   */
  public function getBuyersList($year = 2019) {
    $query = "SELECT usr.name AS buyer FROM agreement agr LEFT JOIN USER_ACCOUNT usr ON agr.ID_KEY_BUYER = usr.ID_USER_ACCOUNT WHERE agr.YEAR = ? AND usr.name IS not null GROUP BY usr.name ORDER BY usr.name";
// TODO   $buyers = Db::select(Db::connectAnee(), $query, [$year]);
    return $buyers;
  }

  /**
   * Метод получает из АНЕЕ перечень групп за указаный год
   * @param int $year
   * @return mixed
   */
  public function getGroupList($year = 2019) {
    $query = "select short_condition as groupe from agreement where id_agr_status in ('SGN', 'CAN', 'WFS') and year = ? group by short_condition order by short_condition";
// TODO   $groups = Db::select(Db::connectAnee(), $query, [$year]);
    return $groups;
  }

  /**
   * Метод получает из АНЕЕ связку поставщик-сегмент-агримент-закупщик
   * @param int $year
   * @return mixed
   */
  public function getCcaList($year = 2019) {
    $query = "SELECT agr.n_agreement,
       agr_condition.id_negotiation_group,
       agr.id_agr_type,
       user_account.name,
       agr.short_condition,
       supplier.cod_utl_supplier
  from dboanee.agreement agr,
       dboanee.agr_condition,
       dboanee.user_account,
       dboanee.supplier
 where agr_condition.id_agreement = agr.id_agreement
       and user_account.id_user_account = agr.id_key_buyer
       and agr.year = ?
       and agr.id_agr_status in ('SGN', 'CAN', 'WFS', 'INK')
       and agr.version = 
	       (select max(agr_vers.version) as m_vers
			from DBOANEE.AGREEMENT agr_vers
		    where agr_vers.year = agr.year
		    and agr_vers.id_agr_status in ('SGN', 'CAN', 'WFS', 'INK')
		    and agr_vers.n_agreement = agr.n_agreement)
       and supplier.id_supplier = agr_condition.id_supplier";
//  TODO  $result = Db::select(Db::connectAnee(), $query, [$year]);
    return $result;
  }

  /**
   * Мктод получает промо бюджеты из АНЕЕ
   * @param $year
   * @return mixed
   */
  public function getServiceList($year) {
    $query = "SELECT
    agr.N_AGREEMENT,
    spl.COD_UTL_SUPPLIER,
    sgm.ID_NEGOTIATION_GROUP,
    agr.NB_FISCAL,
    serv.ID_SERVICE_TYPE,
    serv.BILLING_COST_PER_SERVICE,
    serv.QTY_PER_STORE,
    serv.TOTAL_QTY,
    serv.TOTAL_AMOUNT
  FROM
    DBOANEE.AGREEMENT agr
      LEFT JOIN
    DBOANEE.SUPPLIER spl
    ON agr.ID_SUPPLIER = spl.ID_SUPPLIER
      LEFT JOIN
    DBOANEE.AGR_CONDITION sgm
    ON agr.ID_AGREEMENT = sgm.ID_AGREEMENT
      LEFT JOIN
    DBOANEE.AGR_SERVICE serv
    ON agr.ID_AGREEMENT = serv.ID_AGREEMENT
  WHERE
    agr.YEAR = ?	
    AND agr.ID_AGR_STATUS IN ('SGN', 'CAN', 'WFS', 'INK')
    AND serv.IND_ACTIVE = '1'
    AND agr.VERSION =
      (SELECT
         max(vers.VERSION) AS VERSION
       FROM
         DBOANEE.AGREEMENT vers
       WHERE
           vers.YEAR = agr.YEAR
         AND vers.ID_AGR_STATUS IN ('SGN', 'CAN', 'WFS', 'INK')
         AND agr.N_AGREEMENT = vers.N_AGREEMENT
      )
    AND serv.ID_SERVICE_TYPE IN ('TGSC', 'PPSC', 'PISC')
    /*   AND spl.COD_UTL_SUPPLIER = '141'*/
  GROUP BY
    agr.N_AGREEMENT,
    spl.COD_UTL_SUPPLIER,
    sgm.ID_NEGOTIATION_GROUP,
    agr.NB_FISCAL,
    serv.ID_SERVICE_TYPE,
    serv.BILLING_COST_PER_SERVICE,
    serv.QTY_PER_STORE,
    serv.TOTAL_QTY,
    serv.TOTAL_AMOUNT";

//  TODO  $result = Db::select(Db::connectAnee(), $query, [$year]);
    return $result;
  }

}