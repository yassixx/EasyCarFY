<div class="container mt-5">
  <body class="text-center">
    <form method="post" class="form-signin">
    <img class="mb-1" src="../assets/brand/car-front.svg" alt="" width="72" height="72">
    <h1 class="h1 mb-3 font-weight-normal">EasyCar</h1>
    <?= $error_login ?>
      <h2 class="h3 mb-1 font-weight-normal">Se connecter</h2>
      <h2 class="h6 mb-3 font-weight-normal text-muted">Vous n'avez pas de compte ? <a href="/register.php">S'inscrire</a></h2>
      <label for="inputEmail" class="sr-only">Adresse E-mail</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="E-mail" required autofocus>
      <label for="inputPassword" class="sr-only mt-2">Password</label>
      <input type="password" id="inputPassword" name = "password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Accéder</button>
      <h2 class="h6 mt-3 font-weight-normal text-muted">Mot de passe oublié ? <a href="/password_recovery.php">Réinitialiser</a></h2>
      <p class="mt-4 mb-3 text-muted">&copy; 2024 - 2029 | Fakiri Yassine</p>
    </form>
</div>


