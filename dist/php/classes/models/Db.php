<?php
namespace php\classes\models;

use Exception;
use PDO;

class Db {

  private static $_instanceMysql = null;
  private static $_instanceAnee = null;
  private static $_instanceSup = null;
  private static $sth = null;
  private static $query = '';

  protected static function setMysqlConnection() {
    try {
      self::$_instanceMysql = new PDO('mysql:host='.SQL_HOST.';dbname='.SQL_DBNAME, SQL_USER, SQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
    }
    catch (Exception $e) {
      echo($e->getMessage());
    }
  }

  protected static function setAneeConnection() {
    try {
      self::$_instanceAnee = new PDO('oci:dbname='. ANEE_DBNAME, ANEE_USER, ANEE_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
    }
    catch (Exception $e) {
      echo($e->getMessage());
    }
  }

  protected static function setSupConnection() {
    try {
      self::$_instanceSup = new PDO('oci:dbname='. SUP_DBNAME, SUP_USER, SUP_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
    }
    catch (Exception $e) {
      echo($e->getMessage());
    }
  }

  public static function connectSql() {
    if(self::$_instanceMysql != null) {
      return self::$_instanceMysql;
    } else {
      self::setMysqlConnection();
      return self::$_instanceMysql;
    }
  }

  public static function connectAnee() {
    if(self::$_instanceAnee != null) {
      return self::$_instanceAnee;
    } else {
      self::setAneeConnection();
      return self::$_instanceAnee;
    }
  }

  public static function connectSup() {
    if(self::$_instanceSup != null) {
      return self::$_instanceSup;
    } else {
      self::setSupConnection();
      return self::$_instanceSup;
    }
  }

  public static function select($connection, $query, $param = array()) {
    self::$sth = $connection->prepare($query);
    self::$sth->execute((array) $param);
    return self::$sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function selectOne($connection, $query, $param = array()) {
    self::$sth = $connection->prepare($query);
    self::$sth->execute((array) $param);
    return self::$sth->fetchColumn();
  }

  public static function insert($connection, $query, $param = array()) {
    self::$sth = $connection->prepare($query);
    self::$sth->execute((array) $param);
  }

  public static function set($connection, $query) {
    self::$sth = $connection->prepare($query);
    self::$sth->execute();
  }

}

