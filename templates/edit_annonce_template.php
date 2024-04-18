<div class="album py-5 bg-body-tertiary">
  <div class="container">
    <h3>Modifier votre annonce</h3>
    <form method="post">
      <div class="form-group row mt-5">
        <label for="marque_mod" class="col-4 col-form-label">Marque</label>
        <div class="col-8">
          <input id="marque_mod" name="marque_mod" type="text" value="<?= $car->marque ?>" class="form-control">
        </div>
      </div>
      <div class="form-group row mt-3">
        <label for="modele_mod" class="col-4 col-form-label">Modele</label>
        <div class="col-8">
          <input id="modele_mod" name="modele_mod" type="text" class="form-control" value="<?= $car->modele ?>">
        </div>
      </div>

      <div class="form-group row mt-3">
        <label for="description_mod" class="col-4 col-form-label">Description (max 200 caractères) :</label>
        <div class="col-8">
          <textarea id="description_mod" name="description_mod" class="form-control"
            maxlength="200"><?= $car->description ?></textarea>
        </div>
      </div>


      <div class="form-group row mt-3">
        <label for="ville_mod" class="col-4 col-form-label">Ville</label>
        <div class="col-8">
          <input id="ville_mod" name="ville_mod" type="text" class="form-control" value="<?= $car->ville ?>">
        </div>
      </div>

      <div class="form-group row mt-3">
        <label for="transmission_mod" class="col-4 col-form-label">Transmission :</label>
        <div class="col-8">
          <select id="transmission_mod" name="transmission_mod" class="form-control">
            <option value="<?= $car->transmission ?>"><?= $car->transmission ?></option>
            <option value="manuel">Manuelle</option>
            <option value="sequentielle">Séquentielle</option>
            <option value="automatique">Automatique</option>
          </select>
        </div>
      </div>

      <div class="form-group row mt-3">
        <label for="annee_mod" class="col-4 col-form-label">Année</label>
        <div class="col-8">
          <input id="annee_mod" name="annee_mod" type="number" class="form-control" value="<?= $car->annee ?>">
        </div>
      </div>

      <div class="form-group row mt-3">
                    <label for="carburant_mod" class="col-4 col-form-label">Carburant :</label>
                    <div class="col-8">
                        <select id="carburant_mod" name="carburant_mod" class="form-control">
                            <option value="<?= $car->carburant ?>"><?= $car->carburant ?></option>
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
        <label for="photo_mod" class="col-4 col-form-label">Photo URL</label>
        <div class="col-8">
          <input id="photo_mod" name="photo_mod" type="text" class="form-control" value="<?= $car->photo ?>">
        </div>
      </div>
      <div class="form-group row mt-3">
        <label for="km_mod" class="col-4 col-form-label">Kilométrage</label>
        <div class="col-8">
          <input id="km_mod" name="km_mod" type="number" class="form-control" value="<?= $car->km ?>">
        </div>
      </div>
      <div class="form-group row mt-3">
        <label for="prix_mod" class="col-4 col-form-label">Prix</label>
        <div class="col-8">
          <input id="prix_mod" name="prix_mod" type="number" class="form-control" value="<?= $car->prix ?>">
        </div>
      </div>

      <div class="form-group row mt-3">
        <div class="offset-4 col-8">
          <button name="submit" type="submit" class="btn btn-primary">Modifier</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>