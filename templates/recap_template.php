<div class="container p-3">
            <div class='alert alert-success' role='alert'>
                Ajout reussi.
            </div>
            <h3><?=$title?></h3>
            <div class="album py-5 bg-body-tertiary">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <?= $carM->vehiculeToHtml(); ?>
                    </div>
                </div>
            </div>
        </div>