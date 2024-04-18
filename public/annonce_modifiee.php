<?php
require '../vendor/autoload.php';
use App\Helper;
use App\Vehicule;

Helper::startSession();
ob_start();
require 'elements/header.php';

try {
    $idA = (int) $_GET['id'];
    $permiss = Helper::checkUserAndOwnership($idA);

    if ($permiss) {
        $carM = Vehicule::getSingleCarObjById($idA);
        if (!$carM) {
            throw new Exception("Aucune voiture trouvée avec l'ID spécifié.");
        }
        $title = "Recapitulatif de l'annonce modifiée";
        require "../templates/recap_template.php";
    } else {
        throw new Exception("Problème de permission pour accéder recap annonce.");
    }
} catch (Exception $e) {
    Helper::logMessage($e->getMessage());
    header("Location: /index.php?info=recap_problem");
    exit();
}

