<?php
require "../vendor/autoload.php";

use App\Mail;

require "elements/header.php";
$etat = false;

if (!empty($_POST['email'])) {
    $nom = htmlentities($_POST['nom']);
    $email = htmlentities($_POST['email']);
    $message = htmlentities($_POST['message']);

    $etat = Mail::contactMessage($nom, $email, $message);
    $etat === true ? $etat = 'Envoyé' : $etat = 'Problème - Réessayer, si le problème persiste contact@fakiryassine.fr';

}

require_once "../templates/contact_form_template.php";
