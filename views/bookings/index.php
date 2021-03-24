<?php 
$title = 'Accueil';
$title_section = "Liste des reservations";
require dirname(dirname(__DIR__))."/src/controllers/bookings.php";
?>

<div class="content-bloc shadow-lg p-md-5 p-1 h-100 d-flex flex-column">
        <div class="col-md-4 col-12 mb-5">
            <label for="date_jour" class="form-label">Sélectionnez la date</label><br>
            <input type="date" name="date_jour" class="form-control" id="date_jour"
            value="<?= (new DateTime())->format('Y-m-d') ?>">
        </div>
        <div class="d-flex align-items-start" id="content-bloc-change">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php toHTML_poste($postes); ?>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
        </div>
</div>