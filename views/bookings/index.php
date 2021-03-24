<?php 
$title = 'Accueil';
$title_section = "Liste des reservations"
?>

<div class="content-bloc shadow-lg p-md-5 p-1 h-100 d-flex flex-column">
        <div class="col-md-4 col-12 mb-5">
            <label for="date_jour" class="form-label">Sélectionnez la date</label><br>
            <input type="date" name="date_jour" class="form-control" id="date_jour"
            value="<?= (new DateTime())->format('Y-m-d') ?>">
        </div>
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Poste - 1</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Poste - 2</button>
                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Poste - 3</button>
                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Poste - 4</button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
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
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
        </div>
</div>