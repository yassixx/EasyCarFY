<?php
require '../vendor/autoload.php';
use App\User;
use App\Helper;

Helper::startSession();
ob_start();

require_once "elements/header.php";

$error_login = '';
if (!empty($_GET['info']) == 'connection_needed') {
  $error_login = '<div class="container mt-3">
<div class="alert alert-info" role="alert">
    Se connecter pour ajouter une voiture.
</div>
</div>
';
}

if (isset($_SESSION['connection']) && $_SESSION['connection'] == 'true') {
  header('Location: /dashboard.php');
  exit();
}

if (!empty($_POST)) {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $emailIn = htmlentities($_POST['email']);
    $passwordIn = htmlentities($_POST['password']);
    $user = User::authenticate($emailIn, $passwordIn);
    if ($user !== null) {
      $_SESSION['connection'] = true;
      $_SESSION['idProprietaire'] = $user['id'];
      $_SESSION['nom'] = $user['nom'];
      header("Location: /dashboard.php");
      exit();
    } else {
      $error_login = '<div class="alert alert-danger" role="alert">
          Identifient ou mot de passe incorrect. Reesseyez
          </div>';
    }
  }
}
ob_end_flush();

require_once "../templates/login_page_template.php";
require_once "elements/footer.php";
