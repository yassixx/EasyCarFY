<?php

namespace App;

use PDO;
use PDOException;

class BD {

    private static $dbConnection;

    public static function getDBConnection () {
        try{
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
        }catch(PDOException $e){
            Helper::logMessage("Erreur de connexion à la base de données : " . $e->getMessage());
            return null;
        }
        
    }
}
