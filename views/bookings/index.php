<?php 
    $title = 'Accueil';
    $title_section = "Tableau de bord";
    require dirname(dirname(__DIR__))."/src/controllers/bookings.php";
?>

<?php if($reservations):?>
        <?php foreach($reservations as $reservation):?>
                <div class="modal fade" id="res-<?=$reservation->res_id?>" tabindex="-1" aria-labelledby="res-<?=$reservation->res_id?>-Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="res-<?=$reservation->res_id?>-Label">Détails de la réservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold">Reservé de : <?=date('H:i', $reservation->date_debut)?> à <?=date('H:i', $reservation->date_fin)?> </p>
                        <p class="fw-bold">Nom : <?=$reservation->nom?></p>
                        <p class="fw-bold">Prenom : <?=$reservation->prenom?></p>
                        <p class="fw-bold">N° de carte : <?=$reservation->carte_id?></p>
                    </div>
                    <div class="d-flex justify-content-end my-3 me-3">
                    <button type="button" class="btn btn-danger w-50" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#res-delete-<?=$reservation->res_id?>">
                        Annuler la reservation
                    </button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                    </div>
                </div>
                </div>
                <!--modal de delete-->
                <div class="modal fade" id="res-delete-<?=$reservation->res_id?>" tabindex="1" aria-labelledby="res-delete-<?=$reservation->res_id?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="res-delete-<?=$reservation->res_id?>Label">Détails de la réservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <p>Confirmez vous la suppression de la réservation ci-dessous ?</p>
                                    <p class="fw-bold">Reservé de : <?=date('H:i', $reservation->date_debut)?> à <?=date('H:i', $reservation->date_fin)?> </p>
                                    <p class="fw-bold">Nom : <?=$reservation->nom?></p>
                                    <p class="fw-bold">Prenom : <?=$reservation->prenom?></p>
                                    <p class="fw-bold">N° de carte : <?=$reservation->carte_id?></p>
                                    <input type="hidden" name="id" value="<?=$reservation->res_id?>">
                                    <input type="hidden" name="action" value="annulation_resa">
                                    <input type="hidden" name="date_selected" value="<?= isset($_SESSION['date_search']) ? htmlspecialchars($_SESSION['date_search']) : (new DateTime())->format('Y-m-d') ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success" name="cancel_reservation">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    <?php endforeach;?>
<?php endif;?>

<div class="content-bloc shadow-lg p-md-5 p-1 h-100 d-flex flex-column">

    <form method="post">
        <div class="col-md-4 col-12 mb-5">
            <label for="date_jour" class="form-label">Sélectionnez la date</label><br>
            <div class="d-flex">
            <input type="date" name="date_search" class="form-control" id="date_search" min="<?= (new DateTime())->format('Y-m-d') ?>"
            value="<?= isset($_SESSION['date_search']) ? htmlspecialchars($_SESSION['date_search']) : (new DateTime())->format('Y-m-d') ?>">
            <button type="submit" class="btn btn-success w-55 bg-green mr-5" name="search_btn">Rechercher</button>
            </div>
            <input type="hidden" name="action" value="search_date">
        </div>
    </form>

        <div class="d-flex align-items-start" id="content-bloc-change">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php $i = 0;?>
                <?php foreach($postes as $value):?>
                    <button class="nav-link <?= $i == 0 ? "active" : ""?>" id="v-pills-poste-<?=$value->id?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-poste-<?=$value->id?>" type="button" role="tab">Poste - <?=$value->id?></button>
                    <?php $i = $i + 1;?>
                <?php endforeach; ?>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <?php $i = 0;?>
                <?php foreach($postes as $poste):?>
                    <!--MODAL-->
                    <div class="modal fade" id="poste-resa-<?=$poste->id?>" tabindex="-1" data-bs-backdrop="static" aria-labelledby="poste-resa-<?=$poste->id?>-Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="poste-resa-<?=$poste->id?>-Label">Créer une réservation sur le poste <?=$poste->id?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" class="create_resa">
                                <div class="modal-body">
                                    <p class="mb-3">Date de reservation : <?= isset($_SESSION['date_search']) ? htmlspecialchars($_SESSION['date_search']) : (new DateTime())->format('Y-m-d') ?></p>
                                    <select class="form-select mb-3" name="utilisateur_id" required>
                                        <?php foreach($utilisateurs as $utilisateur):?>
                                            <option value="<?= $utilisateur->id?>"><?=$utilisateur->nom?> <?=$utilisateur->prenom?> / N° de carte : <?=$utilisateur->carte_id?></option>
                                        <?php endforeach?>
                                    </select>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Heure début</span>
                                        <input type="time" class="form-control" placeholder="Heure de début" max="16:00" min="08:00" name="date_debut" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Heure de fin</span>
                                        <input type="time" class="form-control" placeholder="Heure de début" max="16:00" min="08:00" name="date_fin" required>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?=$poste->id?>">
                                <input type="hidden" name="action" value="create_reservation">
                                <input type="hidden" name="date_selected" value="<?= isset($_SESSION['date_search']) ? htmlspecialchars($_SESSION['date_search']) : (new DateTime())->format('Y-m-d') ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success" name="create_reservation">Créer</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!--TAB PANNEL-->
                    <div class="tab-pane fade show <?= $i == 0 ? "active" : ""?>" id="v-pills-poste-<?=$poste->id?>" role="tabpanel" aria-labelledby="v-pills-poste-<?=$poste->id?>-tab">
                    <button type="button" class="btn btn-success mt-md-0 mt-3 button_add" data-bs-toggle="modal" data-bs-target="#poste-resa-<?=$poste->id?>">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <div class="d-flex flex-wrap w-100">
                        
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                08h00 - 08h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "8:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                08h30 - 09h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "8:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                09h00 - 09h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "9:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                09h30 - 10h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "9:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                10h00 - 10h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "10:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                10h30 - 11h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "10:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                11h00 - 11h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "11:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                11h30 - 12h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "11:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                12h00 - 12h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "12:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                12h30 - 13h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "12:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                13h00 - 13h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "13:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                13h30 - 14h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "13:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                14h00 - 14h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "14:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                14h30 - 15h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "14:30");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                15h00 - 15h30
                            </div>
                            <?= keepResByposte($poste, $reservations, "15:00");?>
                        </div>
                        <div class="d-flex flex-row me-2 mb-3 justify-content-md-center justify-content-between w-100 align-items-center">
                            <div class="bloc-horaire">
                                15h30 - 16h00
                            </div>
                            <?= keepResByposte($poste, $reservations, "15:30");?>
                        </div>
                    </div>
                </div>
                <?php $i++?>
                <?php endforeach;?>
            </div>
        </div>
</div>

<script>
//Blocage de l'appuie sur la touche entrée
var forms_create = document.querySelectorAll(".modal");
forms_create.forEach(el => {
    el.addEventListener('keypress', function(e){
        console.log(e);
        if (e.which == 13) {
        return false;
    }
    })
})
var forms_create = document.querySelectorAll(".create_resa input");
forms_create.forEach(el => {
    el.addEventListener('keypress', function(e){
        console.log(e);
        if (e.which == 13) {
        return false;
    }
    })
})
</script>