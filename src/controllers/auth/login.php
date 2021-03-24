<?php
require dirname(dirname(__DIR__))."/models/users/users.php";

if(isset($_POST['login'])){
    //Verification des inputs & Nettoyage
    $error = false;
    $inputs_required = ["identifiant", "password"];
    foreach($inputs_required as $value){
        if($_POST["$value"] == ""){
            $error = true;
            $_SESSION['flash'] = array('Error', "Echec lors de la creation de l'annonce </br> Veuillez vérifier les champs");
            $_SESSION["verification"] = true;
            $_SESSION['identifiant'] = $_POST['identifiant'];
        }else{
            $_POST["$value"] = htmlspecialchars($_POST["$value"], ENT_QUOTES);
        }
    }
    if(!$error){
        unset($_POST['login']);
        $response = loginHandler($_POST);
        if(count($response) > 0){
            if(password_verify($_POST['password'], $response[0]->password)){
                $_SESSION['logged'] = true;
                $_SESSION['flash'] = array('Success', "Bienvenue sur votre outil de gestion de reservation de poste informatique");
                $_SESSION["verification"] = true;
            }else{
                $_SESSION['flash'] = array('Error', "Identifiant ou mot de passe incorrect");
                $_SESSION["verification"] = true;
                $_SESSION['identifiant'] = $_POST['identifiant'];
            }
        }
    }else{
        $_SESSION['flash'] = array('Error', "Veuillez compléter les champs obligatoires");
        $_SESSION["verification"] = true;
        $_SESSION['identifiant'] = $_POST['identifiant'];
    }
}

