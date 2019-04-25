<?php
namespace php\classes\models;

/**
 * Класс для авторизации через OpenLDAP 
 * 
 * @author Vladimir
 * @copyright 2013
 */

// /*
// * LDAP connection
// */
define('LDAP_HOST', 'ldaps://148.239.32.244');
define('PORT', '636');
define('DN', 'ou=users,ou=Dossier,ou=localapps,dc=auchan,dc=corp'); /* ou=ANNE - для АНЕЕ */

class ldap {

    private $attribute = array('displayname','iirtjobcode','iirnldisplayname', 'uid', 'givenname', 'pwdAccountLockedTime', 'pwdChangedTime', 'l', 'title', 'cn', 'sn', 'memberOf', 'employeenumber');

    /**
     * Инициализация соединения с LDAP-сервером
     * {@source}
     * @return type
     */
    public function connect() {
        $connect = ldap_connect(self::pingServer(LDAP_HOST), PORT);
        return $connect;
    }

    /**
     * Строим bind соединения с LDAP-сервером
     * {@source}
     * @return type
     */
    public function bind($login, $pass) {
        $dn = 'uid=' . trim(strip_tags($login)) . ',' . DN;
        $bind = ldap_bind(self::connect(), $dn, $pass);
        return $bind;
    }
    /**
     * Метод проверяет атрибут группы доступа пользователя
     * {@source}
     * @return type
     */
    public function getAttrGroupForUser($login) {
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $search = ldap_search($connect, DN, 'uid=' . $login, $this->attribute);
            $entry = ldap_first_entry($connect, $search);
            $userGroup = ldap_get_attributes($connect, $entry);
            for ($i = 0; $i < $userGroup["count"]; $i++) {
                $identGroup[] = $userGroup[$i];
            }
            //print_r($identGroup);
            foreach ($identGroup as $key => $val) {
                if ($identGroup[$key] == 'memberOf') {
                    $iGroup = 1;
                   // echo $identGroup[$key];
                    break;
                } 
                
            }
            return $iGroup;
        }
    }
    
    /**
     * Метод возвращает данные пользователя:
     * Фамилия, Имя, Сайт
     * {@source}
     * @param type $login
     * @return array
     * @todo дуже сильно необхідно дописати що і в якому вигляді повертає даний метод 
     * для того щоб вставляти і обновляти записи в нашої БД  
     */
    public function getUserData($login) {
        $userData = array();
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $search = ldap_search($connect, DN, 'uid='.$login, $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $lastName = $array_attr[$i]["sn"][0];
                $firstName = $array_attr[$i]["givenname"][0];
                $site = $array_attr[$i]["l"][0];
                $jobTitle = $array_attr[$i]["title"][0];
                $uid = $array_attr[$i]["uid"][0];
            }
             array_push($userData, $lastName);
             array_push($userData, $firstName);
             array_push($userData, $site);
             array_push($userData, $jobTitle);
        }
        return $userData;
    }
    /**
     * Метод проверяет правильность пароля пользователя:
     * Фамилия, Имя, Сайт
     * {@source}
     * @param type $login
     * @param type $password
     * @return array
     * @todo дуже сильно необхідно дописати що і в якому вигляді повертає даний метод 
     * для того щоб вставляти і обновляти записи в нашої БД  
     */
    public function getUserPassword($login, $password) {
        $userData = array();
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $checkPassword = ldap_compare($connect, 'uid=' . $login .','.DN, 'userpassword', $password);
            return $checkPassword;   
        }
    }

    /**
     * Метод проверяет не заблокирован ли пользователь
     * {@source}
     * @return boolean
     */
    public function AccountLocked($login) {
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $search = ldap_search($connect, DN, 'uid=' . $login, $this->attribute);
            $entry = ldap_first_entry($connect, $search);
            $pwdAccountLockedTime = ldap_get_attributes($connect, $entry);
            for ($i = 0; $i < $pwdAccountLockedTime["count"]; $i++) {
                $AccountLockedTime[] = $pwdAccountLockedTime[$i];
            }
            for ($j = 0; $j < count($AccountLockedTime); $j++) {
                if ($AccountLockedTime[$j] == "pwdAccountLockedTime") {
                    $lock = true;
                } else {
                    $lock = false;
                }
            }
            return $lock;
        }
    }
    
    /**
     * Получаем группу доступа пользователя
     * {@source}
     * @return type
     */
    public function getUserGroup($login, $pass) {
        $groupAccess = array();
        $dn = 'uid=' . trim(strip_tags($login)) . ',' . DN;
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, $dn, $pass);
        if ($bind) {
            $search = ldap_search($connect, $dn, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $memberOf = $array_attr[$i]["memberof"];
                $memberOfString = implode(",",$memberOf);
                $array_group = explode("cn=", $memberOfString); 
                unset($array_group[0]);
                foreach ($array_group as $key => $val){
                    $userGroup = strtok($val, ",");
                    array_push($groupAccess, $userGroup);
                }   
            }
            return $groupAccess;
        }
    }

    /**
     * Получаем полное имя пользователя
     * {@source}
     * @return type
     */
    public function getUserFullName($login, $pass) {
        $dn = 'uid=' . trim(strip_tags($login)) . ',' . DN;
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, $dn, $pass);
        if ($bind) {
            $search = ldap_search($connect, $dn, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $fullName = $array_attr[$i]["iirnldisplayname"][0];
            }
            return $fullName;
        }
    }

    /**
     * Получаем матрикуль пользователя
     * {@source}
     * @return type
     */
    public function getUserName($login, $pass) {
        $dn = 'uid=' . trim(strip_tags($login)) . ',' . DN;
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, $dn, $pass);
        if ($bind) {
            $search = ldap_search($connect, $dn, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $userName = $array_attr[$i]["cn"][0];
            }
            return $userName;
        }
    }
     /**
     * Метод проверки наличия табельного номера пользователя
     * {@source}
     * @return type
     */
    public function getUserUkr($login) {
        $userName = array();
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $search = ldap_search($connect, DN, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $userName[] = $array_attr[$i]["uid"][0];
            }
            if (in_array($login, $userName)) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Метод получает информацию о сотруднике по табельному номеру
     * @param type $login
     * @return array
     */
    public function getNameByUkr($login) {
        $userName = array();
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $search = ldap_search($connect, DN, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $ukr = $array_attr[$i]["uid"][0];
                if ($ukr == $login) {
                    $surname = $array_attr[$i]["sn"][0];
                    $name = $array_attr[$i]["givenname"][0];
                    $site = $array_attr[$i]["l"][0];
                }
            }
        }
        if ($surname <> '') {
            $result = array();
            array_push($result, $surname);
            array_push($result, $name);
            array_push($result, $site);
        }
        return $result;
    }
    /**
     * Метод проверяет время жизни пароля у сотрудника
     * @param type $login
     * @return type
     */
    public function getPwdChangedTime($login) {
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, BASEDN, ADMPASS);
        if ($bind) {
            $search = ldap_search($connect, DN, 'uid=' . $login, $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);
            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $result = substr($array_attr[$i]["pwdchangedtime"][0], 0, -3);
            }
            return $result;
        }
     
    }
       
    /**
     * Получаем метоположение (магазин, офис) пользователя
     * {@source}
     * @return type
     */
    public function getUserSite($login, $pass) {
        $dn = 'uid=' . trim(strip_tags($login)) . ',' . DN;
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, $dn, $pass);
        if ($bind) {
            $search = ldap_search($connect, $dn, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $userSite = $array_attr[$i]["iirtjobcode"][0];
                //$site = implode("", emplode("|", $userSite));
                $usr_site = substr($userSite, -3);
                //$userSite = $userSite[0] == 0 ? substr($userSite, 1): $userSite;
            }

            return $usr_site;
        }
    }

    /**
     * Получаем код должности пользователя
     * {@source}
     * @return type
     */
    public function getUserJobCode($login, $pass) {
        $dn = 'uid=' . trim(strip_tags($login)) . ',' . DN;
        $connect = self::connect();
        ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
        $bind = ldap_bind($connect, $dn, $pass);
        if ($bind) {
            $search = ldap_search($connect, $dn, 'uid=*', $this->attribute);
            $array_attr = ldap_get_entries($connect, $search);

            for ($i = 0; $i < $array_attr["count"]; $i++) {
                $jobCode = $array_attr[$i]["title"][0];
            }
            return $jobCode;
        }
    }

    /**
     * Метод проверки на доступность серверов OpenLDAP
     * {@source}
     * @param type $arg
     * @return string
     */
    public function pingServer($arg) {
        error_reporting(0);
        if (fsockopen($arg, 636, $errno, $errstr, 1))
            $ip = $arg;
        else
            $ip = "ldaps://148.239.32.45";
        return $ip;
    }

    //-------------------------------------------------------

    /**
     * Получаем полное имя пользователя
     * {@source}
     * @return type
     */
    public function ExistUKR($ukr) {
        if (db::getInstance()->ExsistUKR($ukr)) {
            return true;
        } else {
            return false;
        }
    }

}

?>