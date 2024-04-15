<?php
require '../vendor/autoload.php';
use App\BD;
use App\User;
use App\Helper;
Helper::startSession();
ob_start();

require_once "elements/header.php";

$error_login='';

if(isset($_SESSION['connection']) && $_SESSION['connection']=='true'){
    header('Location: /dashboard.php');
    exit();
}

if(!empty($_POST)){
    if(isset($_POST['email']) && isset($_POST['password'])){
      $emailIn = htmlentities($_POST['email']);
      $passwordIn = htmlentities($_POST['password']);
        $user = User::authenticate($emailIn, $passwordIn);
        if($user !== null){
            $_SESSION['connection']= true;
            $_SESSION['idProprietaire']= $user['id'];
            $_SESSION['nom']= $user['nom'];
            header("Location: /dashboard.php");
            exit();
        }
        else{
          $error_login = '<div class="alert alert-danger" role="alert">
          Identifient ou mot de passe incorrect. Reesseyez
          </div>';
        }
      }
    }
    ob_end_flush();

require_once "../templates/login_page_template.php";
require_once "elements/footer.php";
