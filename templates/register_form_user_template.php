<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
<?=$problem_password?>
	<h3 class="card-title mt-3 text-center">S'inscrire</h3>
    <p class="text-center">Vous n'avez pas de compte ? <a href="/login_page.php"><bold>Se connecter<bold></a></p>

	<form method="post">
        <div class="form-group input-group mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="nameCreation" class="form-control" placeholder="Nom complet" type="text">
        </div>
        <div class="form-group input-group mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="emailCreation" class="form-control" placeholder="E-mail" type="email">

        <div class="form-group input-group mt-3">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name = "passwordCreation" class="form-control" placeholder="Choisissez un mot de passe" type="password">
        </div> 

        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name ="passwordConfirmation" class="form-control" placeholder="Confirmez votre mot de passe" type="password">
        </div> 

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block"> S'inscrire  </button>
        </div>   
    </form>
</article>
</div> 

</div> 
