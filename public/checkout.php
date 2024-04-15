<?php
require '../vendor/autoload.php';
use App\BD;
use App\Helper;
use App\Vehicule;
use Stripe\Stripe;
use Stripe\Checkout\Session;

Helper::startSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["car_id_buy"])) {
    $idCarToBuy = (int)$_POST["car_id_buy"];
    try {
      $carToBuy = Vehicule::getSingleCarObjById($idCarToBuy);
    } catch (Exception $e) {
      echo "Problème lors de la récupération de la voiture à acheter.";
      exit; 
    }
  }
}

$key = 'sk_test_51MpuBoB6TpCJUNmLPo3wFPyLCwHTFNfaLLchuurH27HrT9QysJAY7D2t3tGAElS0Sz34kNxFsNIr98JD7yBXC7x300XBOPCaVs';
Stripe::setApiKey($key);

$session = Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'eur',
        'unit_amount' => $carToBuy->prix * 100, 
        'product_data' => [
          'name' => 'Voiture: ' . $carToBuy->marque, 
          'description' => "Année: {$carToBuy->annee}, Carburant: {$carToBuy->carburant}, Kilométrage: {$carToBuy->km}",
          'images' => [$carToBuy->photo] 
        ],
      ],
      'quantity' => 1,
    ]
  ],
  'mode' => 'payment',
  'billing_address_collection' => 'required', 
  'success_url' => 'http://localhost:8002/success.php',
  'cancel_url' => 'http://localhost:8002/vehicule_detail.php?voiture=' . $idCarToBuy, 
  'automatic_tax' => [
    'enabled' => true,
  ],
]);

$_SESSION['stripe_id_session'] = $session->id;
$_SESSION['car_id'] = (int)$idCarToBuy;
if ($session) { 
  header('Location: ' . $session->url);
  exit;
} else {
  echo "Problème lors de la création de la session de paiement avec Stripe.";
  exit;
}
?>
