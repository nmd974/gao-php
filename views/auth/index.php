<?php 
$title = 'Authentification';
$title_section = "Connexion requise"
?>

<div class="content-bloc shadow-lg p-md-5 p-1 h-100 d-flex flex-column justify-content-center align-items-center">
    <div class="w-xs-100 w-75 mt-5 mb-5">
        <form action="/login" method="post">
            <div class="col-12 form-floating mb-3">
                <input type="identifiant" class="form-control" id="identifiant" placeholder="identifiant" name="identifiant" value="<?= $_SESSION['identifiant'] ?? ''?>">
                <label for="identifiant">Identifiant</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <label for="password">Password</label>
            </div>
            <div class="text-end my-4">
                <button type="submit" class="btn btn-primary w-55 bg-green mr-5" id="ajouter_proprietaire" name="login">Se connecter</button>
            </div>
        </form>
    </div>
</div>

