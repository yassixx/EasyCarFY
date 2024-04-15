<?php
namespace App;

use App\BD;
use PDOException;

class Client {
    public $name;
    public $email;
    private $tel;
    private $address;
    private $postcode;
    private $country;
    public $id;

    public function __construct($name, $email, $tel, $address, $postcode, $country){
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
        $this->address = $address;
        $this->postcode = $postcode;
        $this->country = $country;
    }

    public function addToDB(){
        try{
        $dbconnection = BD::getDBConnection();
        $statement = $dbconnection->prepare("INSERT INTO clients (name, email, tel, address, postcode, country) VALUES (:name, :email, :tel, :address, :postcode, :country)");
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':tel', $this->tel);
        $statement->bindParam(':address', $this->address);
        $statement->bindParam(':postcode', $this->postcode);
        $statement->bindParam(':country', $this->country);
        $statement->execute();
        $this->id = $dbconnection->lastInsertId();
        return $dbconnection->lastInsertId();
    } catch(PDOException $e) {
        echo "Erreur d'insertion dans la base de données: " . $e->getMessage();
        return false;
    }
    }
}