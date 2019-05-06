<?php

namespace php\classes\models;

class User {

  private static $ukr;
  private static $password;
  private static $ldap;

  public function __construct($login, $pass) {
    self::$ukr = $login;
    self::$password = $pass;
  }

  public static function getUserName() {
    $query = /** @lang MySQL */
        "select full_name from cdg_users where ukr = ? group by full_name";
    $array = Db::select(Db::connectSql(), $query, [self::$ukr]);
    $result = '';
    foreach ($array as $value) {
      $result = $value['full_name'];
    }
    return $result;
  }

  public static function getUserAccess() {
    $query = /** @lang MySQL */
        "select user_access from cdg_users where ukr = ? group by user_access";
    $array = Db::select(Db::connectSql(), $query, [self::$ukr]);
    $result = 0;
    foreach ($array as $value) {
      $result = $value['user_access'];
    }
    return $result;
  }

  public static function getUserLink() {
    $query = /** @lang MySQL */
        "select user_link from cdg_users where ukr = ? group by user_link";
    $result = Db::select(Db::connectSql(), $query, [self::$ukr]);
    return $result;
  }

}