<div class="container">
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }
        .card-body {
            padding: 30px;
        }
        .list-group-item {
            border: none;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Confirmation de commande
                </div>
                <div class="card-body">
                    <h5 class="card-title">Merci pour votre commande !</h5>
                    <p class="card-text">Votre commande a été confirmée avec succès.</p>
                    <h6>Récapitulatif de la commande :</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Marque: <?php echo $carBoughtObj->marque; ?></li>
                        <li class="list-group-item">Année: <?php echo $carBoughtObj->annee; ?></li>
                        <li class="list-group-item">Carburant: <?php echo $carBoughtObj->carburant; ?></li>
                        <li class="list-group-item">Kilométrage: <?php echo $carBoughtObj->km; ?> km</li>
                        <li class="list-group-item">Prix: <?php echo $carBoughtObj->prix; ?> €</li>
                    </ul>
                    <p class="mt-3"><h6>Un e-mail de confirmation a été envoyé à <?php echo $clientBought->email;?></h6> avec les informations de contact du propriétaire.</p>
                    <p>Pour toute question, veuillez contacter le propriétaire du véhicule :</p>
                    <ul class="list-group">
                        <li class="list-group-item">Nom du propriétaire: <?php echo $userProprioObj->nom; ?></li>
                        <li class="list-group-item">E-mail du propriétaire: <?php echo $userProprioObj->email; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br>