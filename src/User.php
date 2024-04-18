<?php
namespace App;

use PDO;
use App\BD;
use Exception;
use PDOException;

class User
{

    public $id;

    public $nom;

    public $email;

    public $password;
    public $date_inscription;

    public function __construct($id, $nom, $email, $password, $date_inscription)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->date_inscription = $date_inscription;
    }

    public static function updatePasswordByEmail($email, $newPassword)
    {

        try {
            $dbconnection = BD::getDBConnection();
            $query_check_email = "SELECT COUNT(*) FROM utilisateurs WHERE email = :email";
            $stmt_check_email = $dbconnection->prepare($query_check_email);
            $stmt_check_email->bindParam(':email', $email);
            $stmt_check_email->execute();
            $count = $stmt_check_email->fetchColumn();

            if ($count == 0) {
                // L'e-mail n'existe pas dans la bdd retourne -1 pour indiquer cela
                return -1;
            }

            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $query_update_password = "UPDATE utilisateurs SET password = :password WHERE email = :email";
            $stmt_update_password = $dbconnection->prepare($query_update_password);
            $stmt_update_password->bindParam(':password', $hashedNewPassword);
            $stmt_update_password->bindParam(':email', $email);

            if ($stmt_update_password->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la réinitialisation du mot de passe" . $e->getMessage());
        }
    }



    public static function createUser($name, $email, $password): string
    {
        if (!self::validatePassword($password)) {
            return "Min 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial";
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $db = BD::getDBConnection();
            $sql = "INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$name, $email, $passwordHash]);
            return 'true';
        } catch (PDOException $e) {
            Helper::logMessage("Erreur lors de la création de l'utilisateur" . $e->getMessage());
        }
    }

    public static function validatePassword($password): bool
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        return $uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8;
    }

    public static function getUserObjById($idProp)
    {
        try{
        $dbconnection = BD::getDBConnection();
        $userStd = $dbconnection->query("SELECT * FROM `utilisateurs` WHERE `id` = $idProp")->fetch();
        return new User(
            $userStd['id'],
            $userStd['nom'],
            $userStd['email'],
            $userStd['password'],
            $userStd['date_inscription']
        );
    }catch(Exception $e){
        Helper::logMessage("Erreur lors de la création de l'obj User de l'utilisateur : $idProp". $e->getMessage());
    }
    }

    public static function authenticate($email, $password): ?array
    {
        try{
        $dbconnection = BD::getDBConnection();
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $dbconnection->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user !== false && password_verify($password, $user->password)) {
            return (array) $user;
        } else {
            return null;
        }
    }catch(Exception $e){
        Helper::logMessage("Erreur lors de l'authentification". $e->getMessage());
    }
    }
}