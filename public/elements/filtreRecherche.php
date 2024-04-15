<div class="container mt-1 custom-section" style="background-color: #e5e5e5;">
  <div class="row">
    <!-- Filtrer par Marque -->
    <div class="col-md-3 mb-3 mt-3">
      <h5>Trier par Marque</h5>
      <select name="tri_marque" class="form-control" onchange="window.location.href = '?filter_marque=' + this.value;">
        <option value="All">Toutes les marques</option>
        <?php foreach ($marqueListArrayObj as $marque): ?>
          <?php foreach ($marque as $property => $value): ?>
            <option value="<?= htmlentities($value) ?>">
              <?= htmlentities($value) ?>
            </option>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Filtrer par Année -->
    <div class="col-md-3 mb-3 mt-3">
      <h5>Trier par Année</h5>
      <a href="?sort=annee&order=asc"><button class="btn btn-dark">▲</button></a>
      <a href="?sort=annee&order=desc"><button class="btn btn-dark ml-2">▼</button></a>
    </div>
    <!-- Filtrer par Prix -->
    <div class="col-md-3 mb-3 mt-3">
      <h5>Trier par Prix</h5>
      <a href="?sort=prix&order=asc"><button class="btn btn-dark">▲</button></a>
      <a href="?sort=prix&order=desc"><button class="btn btn-dark ml-2">▼</button></a>
    </div>
    <!-- Filtrer par Kilométrage -->
    <div class="col-md-3 mb-3 mt-3">
      <h5>Trier par Kilométrage</h5>
      <a href="?sort=km&order=asc"><button class="btn btn-dark">▲</button></a>
      <a href="?sort=km&order=desc"><button class="btn btn-dark ml-2">▼</button></a>
    </div>
  </div>
  
<!-- Recherche et Réinitialisation -->
<div class="row">
  <!-- Recherche -->
  <div class="col-md-6 mb-3">
    <h5>Rechercher</h5>
    <form method="get">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Rechercher...">
        <div class="input-group-append">
          <button class="btn btn-dark" type="submit">Rechercher</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Réinitialiser les filtres et recherches -->
  <div class="col-md-6 mb-3 mt-md-0 mt-3">
    <h5 class="d-none d-md-block">Réinitialiser</h5>
    <a href="/"><button class="btn btn-dark">Réinitialiser</button></a>
  </div>
</div>

</div>