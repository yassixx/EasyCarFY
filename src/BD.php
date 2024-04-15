<?php

namespace App;

use PDO;

class BD {

    private static $dbConnection;

    public static function getDBConnection () {
        if (isset(self::$dbConnection)) {
            return self::$dbConnection;
        } else{
            $authDBInfo = Helper::getDBConnectInfo();
            $host = $authDBInfo['host'];
            $dbname = $authDBInfo['dbname'];
            $username = $authDBInfo['username'];
            $password = $authDBInfo['password'];
            self::$dbConnection = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
            return self::$dbConnection;
        }
    }
}
