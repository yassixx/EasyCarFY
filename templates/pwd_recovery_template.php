<div class="container mt-5">
  <body class="text-center">
    <form method="post" class="form-signin">
      <img class="mb-1" src="../assets/brand/car-front.svg" alt="" width="72" height="72">
      <h1 class="h1 mb-3 font-weight-normal">EasyCar</h1>
      <?= $message ?>
      <h2 class="h3 mb-3 font-weight-normal">Récupération de mot de passe</h2>
      <label for="inputEmail" class="sr-only">Adresse E-mail</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="E-mail" required autofocus>
      <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Envoyer un nouveau mot de passe</button>
      <p class="mt-4 mb-3 text-muted">&copy; 2024 - 2029 | Fakiri Yassine</p>
    </form>
  </body>
</div>