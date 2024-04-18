<?php
require '../vendor/autoload.php';
require_once "elements/header.php";
use App\Helper;
use App\Vehicule;

try {
    $idRec = isset($_GET['voiture']) ? (int)$_GET['voiture'] : null;
    $carHtml = Vehicule::singleCarToHtml($idRec);
} catch (Exception $e) {
    Helper::logMessage("Erreur lors de l'affichage de la voiture $idRec: " . $e->getMessage());
}
?>

<div class="container-fluid" style="height: 100vh;">
    <?php if (empty($carHtml)) : ?>
        <div class="alert alert-warning" role="alert">
        Une erreur inattendue s'est produite. Veuillez réessayer plus tard. - 
            Aucune voiture correspondante n'a été trouvée.
        </div>
    <?php else : ?>
        <?= $carHtml ?>
    <?php endif; ?>
</div>

<?php require_once "elements/footer.php"; ?>
