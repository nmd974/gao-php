<?php
require dirname(__DIR__)."/models/bookings.php";
require dirname(__DIR__)."/models/postes.php";
require dirname(__DIR__)."/models/users/users.php";

//Rechercher tous les postes
//Rechercher toutes les reservations comprise entre le timestamp du jour debut et timestamp du jour fin
//Pour chaque poste, on va parcourir creneaux par creneau et on check dans la liste des resa du jour en fonction des conditions

if(isset($_POST['action']) && $_POST['action'] == "search_date"){
    //Transformation des dates
    $date_selected = htmlspecialchars($_POST['date_search'], ENT_QUOTES);
    $date_debut_limit = mktime(7, 30, 0, (int)substr($date_selected, 5,2), (int)substr($date_selected, 8,2), (int)substr($date_selected, 0,4));
    $date_fin_limit = mktime(16, 30, 0, (int)substr($date_selected, 5,2), (int)substr($date_selected, 8,2), (int)substr($date_selected, 0,4));
    $_SESSION['date_search'] = htmlspecialchars($_POST['date_search'], ENT_QUOTES);

    //DATA BDD
    $reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
    $postes = getAllPostes();
    $utilisateurs = getAllUsers();
    unset($_POST['action']);
}elseif(isset($_POST['action']) && $_POST['action'] == "create_reservation"){
    unset($_POST['action']);
    $date_debut_limit = mktime(7, 30, 0, (int)substr($_POST['date_selected'], 5,2), (int)substr($_POST['date_selected'], 8,2), (int)substr($_POST['date_selected'], 0,4));
    $date_fin_limit = mktime(16, 30, 0, (int)substr($_POST['date_selected'], 5,2), (int)substr($_POST['date_selected'], 8,2), (int)substr($_POST['date_selected'], 0,4));
    $_SESSION['date_search'] = htmlspecialchars($_POST['date_selected'], ENT_QUOTES);

    //Verification des inputs
    $inputs_required = ["id", "utilisateur_id", "date_debut", "date_fin"];
    $error = false;
    foreach($inputs_required as $value){
        if($_POST["$value"] == ""){
            $error = true;
            $_SESSION['flash'] = array('Error', "Echec lors de la creation de reservation");
        }else{
            $_POST["$value"] = htmlspecialchars($_POST["$value"], ENT_QUOTES);
        }
    }
    if(!$error){
        if((int)substr($_POST['date_debut'],4,2) > 30){
            $min_debut = 0;
            $heure_debut = (int)substr($_POST['date_debut'],0,2) + 1;
        }elseif((int)substr($_POST['date_debut'],4,2) < 30){
            $min_debut = 30;
            $heure_debut = (int)substr($_POST['date_debut'],0,2);
        }
        if((int)substr($_POST['date_fin'],4,2) > 30){
            $min_fin = 0;
            $heure_fin = (int)substr($_POST['date_fin'],0,2) + 1;
        }elseif((int)substr($_POST['date_fin'],4,2) < 30){
            $min_fin = 30;
            $heure_fin = (int)substr($_POST['date_fin'],0,2);
        }
        //Il faut que la date de debut soit inferieure à la date de fin
        //Transformation des dates de reservation
        $_POST['date_debut'] = mktime($heure_debut, $min_debut, 0, (int)substr($_POST['date_selected'], 5,2), (int)substr($_POST['date_selected'], 8,2), (int)substr($_POST['date_selected'], 0,4));
        $_POST['date_fin'] = mktime($heure_fin, $min_fin, 0, (int)substr($_POST['date_selected'], 5,2), (int)substr($_POST['date_selected'], 8,2), (int)substr($_POST['date_selected'], 0,4));
        $_POST['nb_creneaux'] = ($_POST['date_fin'] - $_POST['date_debut']) / 1800;

        //Recuperation des resa sur le poste au jour selectionne
        $resa_to_check = getBookingsByDateByPoste($date_debut_limit,$date_fin_limit, $_POST['id']);

        if($date_debut_limit > $_POST['date_debut'] || $date_fin_limit < $_POST['date_fin']){
            $error = true;
            $_SESSION['flash'] = array('Error', "Echec lors de la creation de reservation. En dehors des horaires d'ouvertures");
        }
        //On verifie dans les resa sur ce poste
        //Recherche dans la bdd s'il y a des reservations sur ce poste et à cette date 
        //resa : 10 / 12 Si la date debut est comprise entre date_fin et date_debut (date_check <= date_fin && date_check >= date_debut) => erreur
        foreach($resa_to_check as $value){
            if($_POST['date_debut'] <= $value->date_fin && $_POST['date_debut'] >= $value->date_debut){
                $error = true;
                $_SESSION['flash'] = array('Error', "Echec lors de la creation de reservation, Creneaux deja reserve");
            }
        }
        if(!$error){
            $response = createBooking($_POST);
            if($response){
                $_SESSION['flash'] = array('Success', "Reservation confirmée");
                $reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
                $postes = getAllPostes();
                $utilisateurs = getAllUsers();
            }else{
                $reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
                $postes = getAllPostes();
                $utilisateurs = getAllUsers();
            }
        }else{
            $reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
            $postes = getAllPostes();
            $utilisateurs = getAllUsers();
        }
    }else{
        $_SESSION['flash'] = array('Error', "Echec lors de la creation de reservation, formulaire erroné");
        $reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
        $postes = getAllPostes();
        $utilisateurs = getAllUsers();
    }
}else{
    //Transformation des dates
    date_default_timezone_set("Indian/Reunion");
    $date_debut_limit = mktime(7, 30, 0, getdate()['mon'], getdate()['mday'], getdate()['year']);
    $date_fin_limit = mktime(16, 30, 0, getdate()['mon'], getdate()['mday'], getdate()['year']);

    //DATA BDD
    $reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
    $postes = getAllPostes();
    $utilisateurs = getAllUsers();
}

function keepResByposte($poste, $reservations, $compare){
    $reserve = false;
    foreach($reservations as $value){
        if($value->poste_id == $poste->id){
            $date_to_compare = $value->date_debut;
            for ($i=1; $i <= $value->nb_creneaux; $i++) { 
                if(date('H:i', $date_to_compare) == $compare){
                    $reserve = true;
                    return <<<HTML
                    <button type="button" class="btn btn-success text-success" data-bs-toggle="modal" data-bs-target="#res-{$value->res_id}">
                    1
                    </button>
HTML;
                }
                $date_to_compare = $date_to_compare + 1800;
            }

        }
    }
    if(!$reserve){
        return <<<HTML
        <button type="button" class="btn btn-danger text-danger">
        0
        </button>
HTML;
    }
}