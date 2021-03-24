<?php
require dirname(__DIR__)."/models/users/users.php";
use \Waavi\Sanitizer\Sanitizer;

if(isset($_POST['id']) && $_POST['action'] == "update"){
    $validation = validation($_POST);
    if(!$validation){
        $data_sanitized = sanitizer($_POST);
        $data_sanitized['id'] = intval(htmlspecialchars($_POST['id'], ENT_QUOTES));
        $data_sanitized['carte_id'] = substr($data_sanitized['nom'],0,1).substr($data_sanitized['prenom'],0,1).'-'. bin2hex(random_bytes(2));
        $response = updateUser($data_sanitized);
        if($response){
            $_SESSION['flash'] = array('Success', "Compte modifié avec succès !");
            $utilisateurs = getAllUsers();
        }else{
            $_SESSION['flash'] = array('Error', "Echec lors de la modification du compte");
            $utilisateurs = getAllUsers();
        }
    }else{
        $utilisateurs = getAllUsers();
    }
}elseif (isset($_POST['id']) && $_POST['action'] == "delete") {
    $id = intval(htmlspecialchars($_POST['id'], ENT_QUOTES));
    $response = deleteUser($id);
    if($response){
        $_SESSION['flash'] = array('Success', "Compte supprimé avec succès !");
        $utilisateurs = getAllUsers();
    }else{
        $_SESSION['flash'] = array('Error', "Echec lors de la suppression du compte");
        $utilisateurs = getAllUsers();
    }
}elseif(isset($_POST['action']) && $_POST['action'] == "create") {
    $validation = validation($_POST);
    if(!$validation){
        $data_sanitized = sanitizer($_POST);
        $data_sanitized['carte_id'] = substr($data_sanitized['nom'],0,1).substr($data_sanitized['prenom'],0,1).'-'. bin2hex(random_bytes(2));
        $response = createUser($data_sanitized);
        if($response){
            $_SESSION['flash'] = array('Success', "Compte créé avec succès !");
            $utilisateurs = getAllUsers();
        }else{
            $_SESSION['flash'] = array('Error', "Echec lors de la création du compte");
            $utilisateurs = getAllUsers();
        }
    }else{
        $utilisateurs = getAllUsers();
    }
}elseif(isset($_POST['action']) && $_POST['action'] == "rechercher") {
    $search_value = trim(htmlspecialchars($_POST['search_value'], ENT_QUOTES));
    $response = searchUser($search_value);
    if($response){
        $utilisateurs = $response;
    }else{
        $_SESSION['flash'] = array('Error', "Aucun résultat");
        $utilisateurs = getAllUsers();
    }
}else{
    $utilisateurs = getAllUsers();
}

function sanitizer($data){
    $data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'date_naissance' => $_POST['date_naissance']
    ];
    $filters = [
        'nom' => 'trim|escape|capitalize|htmlspecialchars',
        'prenom' => 'trim|escape|capitalize|htmlspecialchars',
        'date_naissance' => 'trim|escape|htmlspecialchars|digit'
    ];

    $customFilter = [
        'htmlspecialchars' => function($value, $options = []){
            return htmlspecialchars($value, ENT_QUOTES);
        }
    ];

    $sanitizer = new Sanitizer($data, $filters,  $customFilter);
    $data_sanitized = $sanitizer->sanitize();
    return $data_sanitized;
}

function validation($data){
    $inputs_required = ["nom", "prenom", "date_naissance"];
    $error = false;
    foreach($inputs_required as $value){
        if($data["$value"] == ""){
            $error = true;
            $_SESSION['flash'] = array('Error', "Echec lors de la creation du compte utilisateur </br> Veuillez vérifier les champs");
            $_SESSION['date_naissance'] = $data['date_naissance'];
            $_SESSION['prenom'] = $data['prenom'];
            $_SESSION['nom'] = $data['nom'];
        }
    }
    return $error;
}