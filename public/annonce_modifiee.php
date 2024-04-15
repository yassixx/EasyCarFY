<?php
require '../vendor/autoload.php';
use App\Helper;
use App\Vehicule;

Helper::startSession();
ob_start();
require 'elements/header.php';

$idM = (int) $_GET['id'];
$permiss = Helper::checkUserAndOwnership($idM);
if($permiss){
    $carM = Vehicule::getSingleCarObjById($idM);
    $title = "Recapitulatif de l'annonce modifiée";
    require "../templates/recap_template.php";
}
else{
    header("Location: /index.php");
    exit();
}

