<?php

namespace App;
use PDOException;

class Transaction {
    
    public static function addTransaction($client_id, $car_id, $owner_id) {
        try {
            $dbconnection = BD::getDBConnection();
            $statement = $dbconnection->prepare("INSERT INTO transactions (client_id, vehicle_id, owner_id) VALUES (?, ?, ?)");

            $statement->bindParam(1, $client_id);
            $statement->bindParam(2, $car_id);
            $statement->bindParam(3, $owner_id);
            
            $statement->execute();

            return $dbconnection->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur d'insertion dans la base de données: " . $e->getMessage();
            return false;
        }
    }
}
