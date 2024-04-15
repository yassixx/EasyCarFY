<?php
ob_start();
require '../vendor/autoload.php';
require_once "elements/header.php";
use App\BD;
use App\User;


try {
    $dbconnection = BD::getDBConnection();
} catch (exception $e) {
    $e->getMessage();
}

$problem_password = '';

if (!empty($_POST)) {
    $passwordCreation = $_POST['passwordCreation'];
    $passwordConfirmation = $_POST['passwordConfirmation'];
    if ($passwordCreation !== $passwordConfirmation) {
        $problem_password = "<div class='alert alert-warning' role='alert'> 
        Les mots de passe entrés ne correspondent pas</div>";
    } else {
        $nomCreation = htmlentities($_POST['nameCreation']);
        $emailCreation = htmlentities($_POST['emailCreation']);

        $status = User::createUser($nomCreation, $emailCreation, $passwordCreation);
        if ($status === 'true') {
            Header("Location: /login_page.php");
            exit;
        } else {
            $problem_password = '<div class="alert alert-warning" role="alert">' . $status . '</div>';
        }
    }
    ob_end_flush();
}

require "../templates/register_form_user_template.php";
require "elements/footer.php";

