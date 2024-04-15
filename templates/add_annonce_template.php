<div class="container">
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <h1>Ajouter une annonce</h1>
            <form method="post">
                <div class="form-group row mt-3">
                    <label for="marque_add" class="col-4 col-form-label">Marque :</label>
                    <div class="col-8">
                        <input id="marque_add" name="marque_add" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="modele_add" class="col-4 col-form-label">Modèle :</label>
                    <div class="col-8">
                        <input id="modele_add" name="modele_add" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="description_add" class="col-4 col-form-label">Description (max 200 caractères) :</label>
                    <div class="col-8">
                        <textarea id="description_add" name="description_add" class="form-control"
                            maxlength="200"></textarea>
                    </div>
                </div>


                <!--<div class="form-group row mt-3">
                    <label for="transmission_add" class="col-4 col-form-label">Transmission :</label>
                    <div class="col-8">
                        <input id="transmission_add" name="transmission_add" type="text" class="form-control">
                    </div>
                </div> -->
                <div class="form-group row mt-3">
                    <label for="transmission_add" class="col-4 col-form-label">Transmission :</label>
                    <div class="col-8">
                        <select id="transmission_add" name="transmission_add" class="form-control">
                            <option value=""></option>
                            <option value="manuel">Manuelle</option>
                            <option value="sequentielle">Séquentielle</option>
                            <option value="automatique">Automatique</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row mt-3">
                    <label for="ville_add" class="col-4 col-form-label">Ville :</label>
                    <div class="col-8">
                        <input id="ville_add" name="ville_add" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="photo_add" class="col-4 col-form-label">Photo URL :</label>
                    <div class="col-8">
                        <input id="photo_add" name="photo_add" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="annee_add" class="col-4 col-form-label">Année :</label>
                    <div class="col-8">
                        <input id="annee_add" name="annee_add" type="number" class="form-control">
                    </div>
                </div>

                <!--<div class="form-group row mt-3">
                    <label for="carburant_add" class="col-4 col-form-label">Carburant :</label>
                    <div class="col-8">
                        <input id="carburant_add" name="carburant_add" type="text" class="form-control">
                    </div>
                </div>-->
                <div class="form-group row mt-3">
                    <label for="carburant_add" class="col-4 col-form-label">Carburant :</label>
                    <div class="col-8">
                        <select id="carburant_add" name="carburant_add" class="form-control">
                            <option value=""></option>
                            <option value="essence">Essence</option>
                            <option value="diesel">Diesel</option>
                            <option value="electrique">Électrique</option>
                            <option value="ethanol">Éthanol</option>
                            <option value="hydrogene">Hydrogène</option>
                            <option value="gpl">GPL</option>
                            <option value="hybride">Hybride (Électrique/Essence)</option>
                            <option value="hybride-diesel">Hybride (Électrique/Diesel ou autre)</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row mt-3">
                    <label for="km_add" class="col-4 col-form-label">Kilométrage :</label>
                    <div class="col-8">
                        <input id="km_add" name="km_add" type="number" class="form-control">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="prix_add" class="col-4 col-form-label">Prix :</label>
                    <div class="col-8">
                        <input id="prix_add" name="prix_add" type="number" class="form-control">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-dark btn-lg">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>