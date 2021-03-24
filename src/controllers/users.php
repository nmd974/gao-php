<?php
require dirname(__DIR__)."/models/users/users.php";
use \Waavi\Sanitizer\Sanitizer;

if(isset($_POST['id']) && $_POST['action'] == "update"){
    
}elseif (isset($_POST['id']) && $_POST['action'] == "delete") {
    
}elseif (isset($_POST['id']) && $_POST['action'] == "create") {
    //Verification des inputs & Nettoyage
    $validation = validation($_POST);
    if(!$validation){
        $data_sanitized = sanitizer($_POST);
        $response = createUser($data_sanitized);
        if($response){
            $_SESSION['flash'] = array('Success', "Compte créé avec succès !");
            $utilisateurs = getAllUsers();
        }
    }else{
        $_SESSION['flash'] = array('Error', "Echec lors de la création du compte");
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