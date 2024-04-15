<?php
require '../vendor/autoload.php';
use App\Helper;
use App\Vehicule;

Helper::startSession();
ob_start();
require 'elements/header.php';

$idA = (int) $_GET['id'];
$permiss = Helper::checkUserAndOwnership($idA);
if($permiss){
    $carM = Vehicule::getSingleCarObjById($idA);
    $title = "Recapitulatif de l'annonce ajoutée";
    require "../templates/recap_template.php";
}
else{
    header("Location: /index.php");
    exit();
}

