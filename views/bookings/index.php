<?php 
$title = 'Accueil';
$title_section = "Liste des reservations";
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
                        <p>Reservé de : <?=date('H:i:s', $reservation->date_debut)?> à <?=date('H:i:s', $reservation->date_fin)?> </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                    </div>
                </div>
                </div>
    <?php endforeach;?>
<?php endif;?>

<div class="content-bloc shadow-lg p-md-5 p-1 h-100 d-flex flex-column">
        <div class="col-md-4 col-12 mb-5">
            <label for="date_jour" class="form-label">Sélectionnez la date</label><br>
            <input type="date" name="date_jour" class="form-control" id="date_jour"
            value="<?= (new DateTime())->format('Y-m-d') ?>">
        </div>
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
                    <div class="tab-pane fade show <?= $i == 0 ? "active" : ""?>" id="v-pills-poste-<?=$poste->id?>" role="tabpanel" aria-labelledby="v-pills-poste-<?=$poste->id?>-tab">
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