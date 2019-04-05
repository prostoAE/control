<?php

function debug($array) {
  echo '<pre>' . print_r($array, true) . '</pre>';
}


/*function getName($frs_number) {
  $this->setName($frs_number);
  $result = iconv('windows-1251', 'utf-8', $this->name);
  return $result;
}


function setName($frs_num) {
  $this->number = $frs_num;
  $sth = Db_anee::conect()->prepare("select name from dboanee.supplier where cod_utl_supplier = ?");
  $sth->execute(array($this->number));
  $result = $sth->fetch(\PDO::FETCH_OBJ);
  $this->name = $result->NAME;
}*/
