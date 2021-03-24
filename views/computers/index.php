<?php 
    $title = 'Postes informatiques';
    $title_section = "Gestion des postes informatiques";
    require dirname(dirname(__DIR__))."/src/controllers/postes.php";
?>

<!-- ZONE CREATION -->
<!-- *******************************************************************************************************************************-->
<!-- TABLE CREATE poste -->
<div class="modal fade" id="create_poste" tabindex="-1" aria-labelledby="create_posteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_posteLabel">Créer un compte poste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nom">
                        <label>Nom<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="prenom">
                        <label>Prenom<span class="text-danger">*</span></label>
                    </div>
                    <div class="mb-3">
                        <label>Date de naissance<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_naissance">
                    </div>
                </div>
                <input type="hidden" name="action" value="create">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" name="create">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- *******************************************************************************************************************************-->
<!-- ZONE UPDATE AND DELETE -->
<!-- TABLE poste -->
<!-- *******************************************************************************************************************************-->
<?php if(count($postes) != 0):?>
<?php foreach($postes as $poste):?>
<div class="modal fade" id="edit_poste_<?= $poste->id?>" tabindex="-1" aria-labelledby="edit_poste_<?= $poste->id?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_poste_<?= $poste->id?>Label">Modifier un poste informatique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" style="height: 100px"><?= nl2br($poste->description) ?></textarea>
                        <label>Description<span class="text-danger">*</span></label>
                    </div>
                    <input type="hidden" name="id" value="<?= $poste->id?>">
                    <input type="hidden" name="action" value="update">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" name="update">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_poste_etat_<?= $poste->id?>" tabindex="-1" aria-labelledby="edit_poste_etat_<?= $poste->id?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_poste_etat_<?= $poste->id?>Label">Activer / Désactiver un poste informatique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                <?php if($poste->etat == "actif"):?>
                    <p>Confirmez vous la desactivation du poste : <?= $poste->id ?></p>
                    <input type="hidden" name="etat" value="inactif">
                <?php else:?>
                    <p>Confirmez vous l'activation du poste : <?= $poste->id ?></p>
                    <input type="hidden" name="etat" value="actif">
                <?php endif;?>
 
                    <input type="hidden" name="id" value="<?= $poste->id?>">
                    <input type="hidden" name="action" value="edit_etat">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" name="edit_etat">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- *******************************************************************************************************************************-->
<div class="modal fade" id="delete_poste_<?= $poste->id?>" tabindex="-1" aria-labelledby="delet_poste_<?= $poste->id?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delet_poste_<?= $poste->id?>Label">Suppression d'un poste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <p>Confirmez vous la suppression du poste : "<?= $poste->id ?>"</p> 
                    <input type="hidden" name="id" value="<?= $poste->id?>">
                    <input type="hidden" name="action" value="delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" name="delete">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php endif;?>

<div class="content-bloc shadow-lg p-md-5 p-1 h-100 d-flex flex-column">
    <div class="d-flex align-items-center justify-content-between flex-wrap my-5">
        <form class="d-flex" method="post">
            <input class="form-control me-2" type="search" name="search_value" placeholder="Recherche" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
            <input type="hidden" name="action" value="rechercher">
        </form>
        <button type="button" class="btn btn-success mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#create_poste">
            <i class="fa fa-plus" aria-hidden="true"></i> Créer un poste
        </button>
    </div>

    <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($postes) != 0):?>
                        <?php foreach($postes as $poste):?>
                        <tr>
                            <td class="align-middle"><?= ucfirst($poste->id) ?></td>
                            <td class="align-middle"><?= ucfirst(substr($poste->description, 0, 25)) ?>...</td>
                            <td class="d-flex justify-content-around flex-wrap">
                                <button type="button" class="btn btn-success me-4" data-bs-toggle="modal" data-bs-target="#<?= "edit_poste_" . $poste->id?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <?php if($poste->etat == "actif"):?>
                                <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#<?= "edit_poste_etat_" . $poste->id?>">
                                        Desactiver
                                </button>
                                <?php else:?>
                                    <button type="button" class="btn btn-success me-4" data-bs-toggle="modal" data-bs-target="#<?= "edit_poste_etat_" . $poste->id?>">
                                        Activer
                                </button>
                                <?php endif;?>
                                <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#<?= "delete_poste_" . $poste->id?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>

                            </td>
                        </tr>
                        <?php endforeach;?>
                        <?php else:?>
                        <tr>
                            <td class="align-middle" colspan="3">Vous n'avez pas de postes enregistrés</td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
</div>