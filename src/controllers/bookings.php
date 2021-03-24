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

//Traitement
//Pour chaque poste dans la liste de resa on ajoute au tableau afin d'optimiser le temps de traitement
$postes_array_res = [];
if($reservations){
    foreach($reservations as $value){
        $postes_array_res[] = $value->poste_id;
    }
}

function toHTML_poste($postes){
    if($postes){
        $i = 0;
        foreach($postes as $value){
            $i++;
            if($i == 1){
                return <<<HTML
                <button class="nav-link" id="v-pills-poste-{$value->id}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-poste-{$value->id}" type="button" role="tab" aria-controls="v-pills-poste-{$value->id}" aria-selected="true">Poste - $value->id</button>
HTML;
            }else{
                return <<<HTML
                <button class="nav-link" id="v-pills-poste-{$value->id}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-poste-{$value->id}" type="button" role="tab" aria-controls="v-pills-poste-{$value->id}" aria-selected="false">Poste - $value->id</button>
HTML;
            }
        }
    }
}

function toHTML_tabs($postes, $reservations){
    
    
    
    
    
    
    
    
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="d-flex flex-wrap w-100">
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                08h00 - 08h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                08h30 - 09h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                09h00 - 09h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                09h30 - 10h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                10h00 - 10h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                10h30 - 11h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                11h00 - 11h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                11h30 - 12h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                12h00 - 12h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                12h30 - 13h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                13h00 - 13h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                14h30 - 15h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                15h00 - 15h30
                            </div>
                            <div class="bg-success text-success bloc-resa">0</div>
                        </div>
                        <div class="d-flex flex-row me-2 justify-content-md-center justify-content-between w-100">
                            <div class="bloc-horaire">
                                15h30 - 16h00
                            </div>
                            <div class="bg-danger text-danger bloc-resa">0</div>
                        </div>
                    </div>
                </div>
}


