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
    self::$ldap = new ldap();
    $name = self::$ldap->getUserName(self::$ukr, self::$password);
    return $name;
  }

  public static function getUserAccess() {
    $query = /** @lang MySQL */
        "select user_access from cdg_users where ukr = ? group by user_access";
    $result = Db::select(Db::connectSql(), $query, [self::$ukr]);
    return $result;
  }

  public static function getUserLink() {
    $query = /** @lang MySQL */
        "select user_link from cdg_users where ukr = ? group by user_link";
    $result = Db::select(Db::connectSql(), $query, [self::$ukr]);
    return $result;
  }

}