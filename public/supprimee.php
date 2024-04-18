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

  try {
    $car = Vehicule::getSingleCarObjById($id);

    if ((int) $car->proprietaire_id === $idProprietaire) {
      $r = Vehicule::deleteCar($id);
      if ($r) {
        header('Location: /dashboard.php?status=supprimee');
      } else {
      header('Location: /dashboard.php?status=errorsuppression');
      }
    } else {
      header('Location: /dashboard.php?status=errorsuppression');

      exit();
    }
  } catch (PDOException $e) {
    Helper::logMessage("Erreur lors de la suppression de la voiture $id: " . $e->getMessage());
  }
} else {
  header('Location: /dashboard.php?status=errorsuppression');
  exit();
}
ob_end_flush();
?>