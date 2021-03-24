<?php
require dirname(__DIR__)."/models/postes.php";
use \Waavi\Sanitizer\Sanitizer;

if(isset($_POST['id']) && $_POST['action'] == "update"){
    $validation = validation($_POST);
    if(!$validation){
        $data_sanitized = sanitizer($_POST);
        $data_sanitized['id'] = intval(htmlspecialchars($_POST['id'], ENT_QUOTES));
        $response = updatePoste($data_sanitized);
        if($response){
            $_SESSION['flash'] = array('Success', "Poste modifié avec succès !");
            $postes = getAllPostesEtat();
        }else{
            $_SESSION['flash'] = array('Error', "Echec lors de la modification du Poste");
            $postes = getAllPostesEtat();
        }
    }else{
        $postes = getAllPostesEtat();
    }
}elseif (isset($_POST['id']) && $_POST['action'] == "edit_etat") {
    if($_POST['etat'] == "actif" || $_POST['etat'] == "inactif"){
        $data_to_send = array(
            "id" => intval(htmlspecialchars($_POST['id'], ENT_QUOTES)),
            "etat" => htmlspecialchars($_POST['etat'], ENT_QUOTES)
        );
        $response = updateEtatPoste($data_to_send);
        if($response){
            $_SESSION['flash'] = array('Success', "Etat du poste modifié avec succès !");
            $postes = getAllPostesEtat();
        }else{
            $_SESSION['flash'] = array('Error', "Echec lors de la modification de l'etat du Poste");
            $postes = getAllPostesEtat();
        }
    }else{
        $_SESSION['flash'] = array('Error', "Echec lors de la modification de l'etat du Poste");
        $postes = getAllPostesEtat();
    }
    
}elseif (isset($_POST['id']) && $_POST['action'] == "delete") {
    $id = intval(htmlspecialchars($_POST['id'], ENT_QUOTES));
    $response = deletePoste($id);
    if($response){
        $_SESSION['flash'] = array('Success', "Poste supprimé avec succès !");
        $postes = getAllPostesEtat();
    }else{
        $_SESSION['flash'] = array('Error', "Echec lors de la suppression du Poste");
        $postes = getAllPostesEtat();
    }
}elseif(isset($_POST['action']) && $_POST['action'] == "create") {
    $validation = validation($_POST);
    if(!$validation){
        $data_sanitized = sanitizer($_POST);
        $response = createPoste($data_sanitized);
        if($response){
            $_SESSION['flash'] = array('Success', "Poste créé avec succès !");
            $postes = getAllPostesEtat();
        }else{
            $_SESSION['flash'] = array('Error', "Echec lors de la création du Poste");
            $postes = getAllPostesEtat();
        }
    }else{
        $postes = getAllPostesEtat();
    }
}elseif(isset($_POST['action']) && $_POST['action'] == "rechercher") {
    $search_value = trim(htmlspecialchars($_POST['search_value'], ENT_QUOTES));
    $response = searchPoste($search_value);
    if($response){
        $postes = $response;
    }else{
        $_SESSION['flash'] = array('Error', "Aucun résultat");
        $postes = getAllPostesEtat();
    }
}else{
    $postes = getAllPostesEtat();
}

function sanitizer($data){
    $data_to_sanitize = [
        'description' => $_POST['description']
    ];
    $filters = [
        'description' => 'trim|escape|capitalize|htmlspecialchars'
    ];

    $customFilter = [
        'htmlspecialchars' => function($value, $options = []){
            return htmlspecialchars($value, ENT_QUOTES);
        }
    ];

    $sanitizer = new Sanitizer($data_to_sanitize, $filters,  $customFilter);
    $data_sanitized = $sanitizer->sanitize();
    return $data_sanitized;
}

function validation($data){
    $inputs_required = ["description"];
    $error = false;
    foreach($inputs_required as $value){
        if($data["$value"] == ""){
            $error = true;
            $_SESSION['flash'] = array('Error', "Echec lors de la creation du Poste utilisateur </br> Veuillez vérifier les champs");
            $_SESSION['description'] = $data['description'];
        }
    }
    return $error;
}