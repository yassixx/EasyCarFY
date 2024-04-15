<?php
require '../vendor/autoload.php';
use App\Helper;
use App\Vehicule;

Helper::startSession();
require_once "elements/header.php";

if (!empty($_GET) && isset($_SESSION['connection']) && $_SESSION['connection'] == 'true') {
  $id = (int) $_GET['id'];
  $nomC = $_SESSION['nom'];
  $idProprietaire = (int) $_SESSION['idProprietaire'];

  try {
    $car = Vehicule::getSingleCarObjById($id);

    if ((int)$car->proprietaire_id === $idProprietaire) {
      $r = Vehicule::deleteCar($id);
      if ($r) {
        echo "Le véhicule a été supprimé avec succès.";
      } else {
        echo "Une erreur s'est produite lors de la suppression du véhicule.";
      }
    } else {
      header('Location: /dashboard.php?error=not_owner');
      exit();
    }
  } catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
  }
} else {
  header('Location: /dashboard.php?error=not_logged_in');
  exit();
}
?>
