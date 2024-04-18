<?php
use App\Vehicule;

require '../vendor/autoload.php';
$marqueListArrayObj = Vehicule::getMarqueList();
$message = '';

if (!empty($_GET['info']) && $_GET['info'] === 'recap_problem') {
  $message = '<div class="container mt-3">
<div class="alert alert-info" role="alert">
    Problème lors de la récuperation de la voiture. Vérifier si disponible dans votre espace.
</div>
</div>
';
}

if (!empty($_GET['sort'])) {
  if (!empty($_GET['sort']) && !empty($_GET['order'])) {
    $sort = htmlentities($_GET['sort']);
    $order = htmlentities($_GET['order']);
    $carsSortedArray = Vehicule::sortCars($sort, $order);
    $carsSortedString = Vehicule::allCarsSortedToHtml($carsSortedArray);
  }
  if (!empty($_GET['filter_marque'])) {
    $qMarque = htmlentities($_GET['filter_marque']);
    $carsFilterBrandArray = Vehicule::searchCarByBrand($qMarque);
    $carsSortedString = Vehicule::allCarsSortedToHtml($carsFilterBrandArray);
  }
  if (!empty($_GET['q'])) {
    $searchTerm = '%' . htmlentities($_GET['q']) . '%';
    $carsFilterTermArray = Vehicule::searchCarByTerm($searchTerm);
    $carsSortedString = Vehicule::allCarsSortedToHtml($carsFilterTermArray);
  }


  require_once "elements/header.php"; ?>
  <?= $message ? $message : ''; ?>
  <?php
  require 'elements/landingSection.php';
  require 'elements/filtreRecherche.php';
  ?>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <?php
      if (empty($carsSortedString)): ?>
        <div class="alert alert-info" role="alert">
          Aucune voiture disponible pour le moment.
        </div>
      <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?= $carsSortedString;
      endif; ?>
      </div>
    </div>
  </div>

  <?php

} else {

  require_once "elements/header.php"; ?>
  <?= $message ? $message : ''; ?>
  <?php
  require 'elements/landingSection.php';
  require 'elements/filtreRecherche.php';
  ?>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <?php $carsHtml = Vehicule::allCarsToHtml();
      if (empty($carsHtml)): ?>
        <div class="alert alert-info" role="alert">
          Aucune voiture disponible pour le moment.
        </div>
      <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?= $carsHtml;
      endif; ?>
      </div>
    </div>
  </div>

  <?php
}
require_once "elements/footer.php";
?>