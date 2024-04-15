<div class="container mt-5">
    <h2>Contactez-nous</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="3" placeholder="Votre message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <div style="margin-top: 10px;"><?= $etat ? $etat : '' ?></div>
    </form>
</div>