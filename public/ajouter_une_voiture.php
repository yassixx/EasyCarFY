<?php
require '../vendor/autoload.php';
use App\BD;
use App\Helper;
use App\Vehicule;

Helper::startSession();
ob_start();

require_once "elements/header.php";


if ($_SESSION['connection'] == 'true') {
  $nomC = $_SESSION['nom'];
  $idProprietaire = (int) $_SESSION['idProprietaire'];
  try {
    $dbconnection = BD::getDBConnection();
  } catch (exception $e) {
    $e->getMessage();
    echo "probleme recuperation informations proprietaire";
  };

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
    } catch (Exception $e) {
      echo "Une erreur est survenue lors de l'ajout du véhicule : " . $e->getMessage();
    }
  }
} else {
  header('Location: /login_page.php');
  exit();
}
ob_end_flush();
?>
<div class="container">
  <?php require '../templates/add_annonce_template.php'; ?>
</div>