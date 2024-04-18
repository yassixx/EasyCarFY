<?php
namespace App;

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{

    public static function sendMail($client, $carB, $proprietaire)
    {

        try {
            $mail = Helper::setupMailConfig();

            $mail->setFrom('from@example.com', 'EasyCar');
            $mail->addAddress($client->email);
            $mail->addAddress('servermailrecoveryfy@gmail.com');


            $mail->isHTML(true);
            $mail->Subject = "[Test] - Confirmation d'achat - " . $carB->marque;
            $mail->Body = "
                <h2>Confirmation d'achat de véhicule</h2>
                <p>Bonjour {$client->name},</p>
                <p>Nous vous confirmons l'achat du véhicule suivant :</p>
                <ul>
                    <li><strong>Marque :</strong> {$carB->marque}</li>
                    <li><strong>Année :</strong> {$carB->annee}</li>
                    <li><strong>Carburant :</strong> {$carB->carburant}</li>
                    <li><strong>Kilométrage :</strong> {$carB->km} km</li>
                    <li><strong>Prix :</strong> {$carB->prix} €</li>
                </ul>
                <p>Votre véhicule vous sera livré très prochainement par notre garage propriétaire. Voici les informations pour les contacter :</p>
                <ul>
                    <li><strong>Nom du propriétaire :</strong> {$proprietaire->nom}</li>
                    <li><strong>E-mail du propriétaire :</strong> {$proprietaire->email}</li>
                </ul>
                <p>Merci pour votre achat.</p>
                <p>Cordialement,<br>EasyCar</p>
            ";

            $mail->AltBody = "Confirmation d'achat de véhicule
            
                Bonjour {$client->name},
                
                Nous vous confirmons l'achat du véhicule suivant :
                - Marque : {$carB->marque}
                - Année : {$carB->annee}
                - Carburant : {$carB->carburant}
                - Kilométrage : {$carB->km} km
                - Prix : {$carB->prix} €
                
                Votre véhicule vous sera livré très prochainement par notre garage propriétaire. Voici les informations pour les contacter :
                - Nom du propriétaire : {$proprietaire->nom}
                - E-mail du propriétaire : {$proprietaire->email}
                
                Merci pour votre achat.
                
                Cordialement,
                EasyCar";

            $mail->send();
            return 'sent';
        } catch (Exception $e) {
            Helper::logMessage("Le message de confirmation n'a pas pu être envoyé. Erreur du Mailer : $client->email - {$mail->ErrorInfo}");
            return 'errorMail';
        }
    }

    public static function sendPasswordResetEmail($email, $newPassword)
    {
        $mail = new PHPMailer(true);

        try {
            $mail = Helper::setupMailConfig();

            $mail->setFrom('recovery@pwd.com', 'EasyCar');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "[Test] - Reinitialisation de votre mot de passe";
            $mail->Body = "
                <h2>Réinitialisation de votre mot de passe</h2>
                <p>Bonjour,</p>
                <p>Votre nouveau mot de passe est le suivant :</p>
                <p><strong>{$newPassword}</strong></p>
                <p>Nous vous recommandons de le changer après vous être connecté.</p>
                <p>Cordialement,<br>EasyCar</p>
            ";

            $mail->AltBody = "Réinitialisation de votre mot de passe
            
                Bonjour,
                
                Votre nouveau mot de passe est le suivant :
                {$newPassword}
                
                Nous vous recommandons de le changer après vous être connecté.
                
                Cordialement,
                EasyCar";

            $mail->send();
            return true;
        } catch (Exception $e) {
            Helper::logMessage("Le message de passwordRecovery n'a pas pu être envoyé. Erreur du Mailer : $email". $e->getMessage());
            return false;
        }
    }

    public static function contactMessage($nom, $email, $message)
    {
        $mail = new PHPMailer(true);

        try {
            $mail = Helper::setupMailConfig();

            $mail->setFrom('servermailrecoveryfy@gmail.com', 'EasyCar');
            $mail->addAddress($email, $nom);
            $mail->addAddress('servermailrecoveryfy@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Merci de nous avoir contacte - EasyCar';
            $mail->Body = "
                <h2>Contact Récapitulatif</h2>
                <p>Bonjour <strong>$nom</strong>,</p>
                <p>Merci de nous avoir contacté. Voici un récapitulatif de votre message :</p>
                <p>Email: $email</p>
                <p>Message: $message</p>
                <p>Nous vous répondrons dès que possible.</p>
                <p>Cordialement,<br>EasyCar</p>
            ";
            $mail->AltBody = "Contact Récapitulatif
            
                Bonjour $nom,
                
                Merci de nous avoir contacté. Voici un récapitulatif de votre message :
                Email: $email
                Message: $message
                
                Nous vous répondrons dès que possible.
                
                Cordialement,
                EasyCar";

            $mail->send();
            return true;
        } catch (Exception $e) {
            Helper::logMessage("Le message de contact n'a pas pu être envoyé. Erreur du Mailer : $email". $e->getMessage());
            return false;
        }
    }
}


?>