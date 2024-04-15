<?php
require_once '../vendor/autoload.php';

use App\Mail;
use App\User;
use App\Client;
use App\Helper;
use App\Vehicule; 
use App\Transaction;
use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;

Helper::startSession();

$session_payement_id = $_SESSION['stripe_id_session'];
$car_id = $_SESSION['car_id'];

$stripe = new StripeClient(Helper::getStripeApiKey());

try {
    $session = $stripe->checkout->sessions->retrieve($session_payement_id, ['expand' => ['customer']]);

    $name = htmlentities($session->customer_details->name);
    $email = htmlentities($session->customer_details->email);
    $tel = (int)$session->customer_details->phone;
    $line1 = htmlentities($session->customer_details->address->line1);
    $line2 = htmlentities($session->customer_details->address->line2);
    $address = $line1 . " - " . $line2;
    $postcode = (int)$session->customer_details->address->postal_code;
    $country = htmlentities($session->customer_details->address->country);

    $carBoughtObj = Vehicule::getSingleCarObjById((int)$car_id);

    $clientBought = new Client($name, $email, $tel, $address, $postcode, $country);
    $clientBought->addToDB();

    $userProprioObj = User::getUserObjById($carBoughtObj->proprietaire_id);

    $transaction = Transaction::addTransaction($clientBought->id, $carBoughtObj->id, $userProprioObj->id);

    $status = Mail::sendMail($clientBought, $carBoughtObj, $userProprioObj);
} catch (ApiErrorException $e) {
    echo "Une erreur est survenue lors de la récupération des informations de la session : " . $e->getMessage();
}

if ($status === 'sent') : 
    require_once "elements/header.php";
    require_once "../templates/order_validation_template.php";
    require_once "elements/footer.php";
endif; 

