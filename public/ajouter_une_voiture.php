<?php
require '../vendor/autoload.php';
use App\BD;
use App\Helper;
use App\Vehicule;

Helper::startSession();
ob_start();

require_once "elements/header.php";
$message = '';

if ($_SESSION['connection'] == 'true' && !empty($_SESSION['idProprietaire'])) {
  $nomC = $_SESSION['nom'];
  $idProprietaire = (int) $_SESSION['idProprietaire'];

  $dbconnection = BD::getDBConnection();
  if (!$dbconnection) {
    $message = '<div class="alert alert-danger" role="alert">
    Nous rencontrons des problèmes pour connecter à la base de données. Veuillez réessayer plus tard.
    </div>';
  }

  if (!empty($_POST)) {
    $carTab = [
      'marque_add' => htmlentities($_POST['marque_add']),
      'modele_add' => htmlentities($_POST['modele_add']),
      'description_add' => htmlentities($_POST['description_add']),
      'transmission_add' => htmlentities($_POST['transmission_add']),
      'ville_add' => htmlentities($_POST['ville_add']),
      'annee_add' => (int) $_POST['annee_add'],
      'carburant_add' => htmlentities($_POST['carburant_add']),
      'km_add' => (int) $_POST['km_add'],
      'prix_add' => (int) $_POST['prix_add'],
      'photo_add' => htmlentities($_POST['photo_add']),
      'proprietaire_id' => (int) $idProprietaire
    ];

    try {
      $idNouvelleVoiture = Vehicule::addCar($carTab);
      header("Location: /annonce_ajoutee.php?status=true&id=$idNouvelleVoiture");
      exit();
    } catch (PDOException $e) {
      Helper::logMessage("Erreur lors de l'ajout d'un véhicule : " . $e->getMessage());
      $message = '<div class="alert alert-danger" role="alert">
      Erreur lors de l\'ajout d\'un véhicule. Veuillez réessayer plus tard.
      </div>';
    }
  }
} else {
  header('Location: /login_page.php?info=connection_needed');
  exit();
}
ob_end_flush();

require '../templates/add_annonce_template.php';
