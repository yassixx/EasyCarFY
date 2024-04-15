<?php
require '../vendor/autoload.php';
use App\BD;
use App\Helper;
use App\Vehicule;
ob_start();
Helper::startSession();

require_once "elements/header.php";

if(isset($_SESSION['connection']) && $_SESSION['connection']=='true'){
    $nomC = $_SESSION['nom'];
    $idProprietaire = (int)$_SESSION['idProprietaire'];
    $dbconnection = BD::getDBConnection();
    $cars = $dbconnection->query("SELECT * FROM voitures WHERE proprietaire_id = $idProprietaire")->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container mt-5">
    <h1>Bienvenue <?=$nomC?> dans votre dashboard</h1>
    <a href="/logout.php" class="btn btn-dark my-1">Se deconnecter</a>
    <a href="/ajouter_une_voiture.php" class="btn btn-dark my-2">Publier votre annonce</a>

    <div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($cars as $car) : ?>
            <?php $voitureObj = new Vehicule($car->id, $car->marque, $car->modele, $car->description, $car->transmission, $car->ville, $car->annee, $car->carburant, $car->km, $car->prix, $car->photo, $car->proprietaire_id);?>
            <?=$voitureObj->vehiculeToHtml();?>
            <?php endforeach ?>
        </div>
    </div>
    </div>
</div>

<?php 
} 
else{
    header('Location: /login_page.php');
}
ob_end_flush();

?>
<?php require_once "elements/footer.php" ?>
