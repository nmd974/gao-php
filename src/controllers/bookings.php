<?php
require dirname(__DIR__)."/models/bookings.php";
require dirname(__DIR__)."/models/postes.php";

//Rechercher tous les postes
//Rechercher toutes les reservations comprise entre le timestamp du jour debut et timestamp du jour fin
//Pour chaque poste, on va parcourir creneaux par creneau et on check dans la liste des resa du jour en fonction des conditions


//Transformation des dates
date_default_timezone_set("Indian/Reunion");
$date_debut_limit = mktime(7, 30, 0, getdate()['mon'], getdate()['mday'], getdate()['year']);
$date_fin_limit = mktime(16, 30, 0, getdate()['mon'], getdate()['mday'], getdate()['year']);

//DATA BDD
$reservations = getBookingsByDate($date_debut_limit, $date_fin_limit);
$postes = getAllPostes();

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