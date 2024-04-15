<?php
require "../vendor/autoload.php";
use App\Helper;
use App\Mail;
use App\User;

require "elements/header.php";
$message='';
if(!empty($_POST['email'])){
    $email = htmlentities($_POST['email']);
    $newPassword = Helper::randomPassword();
    $status = User::updatePasswordByEmail($email, $newPassword);
    if($status===true){
        $sent = Mail::sendPasswordResetEmail($email, $newPassword);
        $message = '<div class="alert alert-success" role="alert">
        Un nouveau mot de passe a été envoyé à votre adresse e-mail. Veuillez vérifier votre boîte de réception.
        </div>';
    }
    if($status!== true || $sent === false){
        $message = '<div class="alert alert-warning" role="alert">
        Une erreur est survenu lors de l\'envoie ou aucun compte associé a été trouvé
        </div>';
    }
}
require "../templates/pwd_recovery_template.php";



