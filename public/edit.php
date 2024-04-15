<?php
require '../vendor/autoload.php';
use App\Helper;
use App\Vehicule;

Helper::startSession();
ob_start();
require_once "elements/header.php";


if (!empty($_GET) && isset($_SESSION['connection']) && $_SESSION['connection'] == 'true') {
  $id = (int) $_GET['id'];
  $nomC = $_SESSION['nom'];
  $idProprietaire = (int) $_SESSION['idProprietaire'];

  $car = Vehicule::getCarObjToEdit($id, $idProprietaire);
  if ($car === 'true') {
    header('Location: /dashboard.php');
    exit();
  }
  if (!empty($_POST)) {
    $carTab = [
      'marque_mod' => $_POST['marque_mod'],
      'modele_mod' => $_POST['modele_mod'],
      'description_mod' => $_POST['description_mod'],
      'transmission_mod' => $_POST['transmission_mod'],
      'ville_mod' => $_POST['ville_mod'],
      'annee_mod' => $_POST['annee_mod'],
      'carburant_mod' => $_POST['carburant_mod'],
      'km_mod' => $_POST['km_mod'],
      'prix_mod' => $_POST['prix_mod'],
      'photo_mod' => $_POST['photo_mod'],
      'id' => $id
    ];

    try {
      $status = Vehicule::CarEditUpdate($carTab);
      header("Location: /annonce_modifiee.php?status=true&id=$id");
      exit();
    } catch (Exception $e) {
      echo "Une erreur est survenue lors de la modification du véhicule : " . $e->getMessage();
    }
  }
  ob_end_flush();
} else {
  header('Location: /login_page.php');
  exit();
}
?>

<div class="container">
  <?php require '../templates/edit_annonce_template.php'; ?>
</div>