<?php 
    $title = 'Utilisateurs';
    $title_section = "Gestion des comptes utilisateurs";
    require dirname(dirname(__DIR__))."/src/controllers/users.php";
?>

<!-- ZONE CREATION -->
<!-- *******************************************************************************************************************************-->
<!-- TABLE CREATE utilisateur -->
<div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="create_userLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_userLabel">Créer un compte utilisateur</h5>
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
<!-- TABLE utilisateur -->
<!-- *******************************************************************************************************************************-->
<?php if(count($utilisateurs) != 0):?>
<?php foreach($utilisateurs as $utilisateur):?>
<div class="modal fade" id="edit_user_<?= $utilisateur->id?>" tabindex="-1" aria-labelledby="edit_user_<?= $utilisateur->id?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_user_<?= $utilisateur->id?>Label">Modifier un compte utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nom" value="<?= $utilisateur->nom?>">
                        <label>Nom<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="prenom" value="<?= $utilisateur->prenom?>">
                        <label>Prenom<span class="text-danger">*</span></label>
                    </div>
                    <div class="mb-3">
                        <label>Date de naissance<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_naissance" value="<?= $utilisateur->date_naissance?>">
                    </div>
                    <input type="hidden" name="id" value="<?= $utilisateur->id?>">
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
<!-- *******************************************************************************************************************************-->
<div class="modal fade" id="delete_user_<?= $utilisateur->id?>" tabindex="-1" aria-labelledby="delet_user_<?= $utilisateur->id?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delet_user_<?= $utilisateur->id?>Label">Suppression d'un compte utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <p>Confirmez vous la suppression du compte de : "<?= ucfirst($utilisateur->prenom) . ' ' . ucfirst($utilisateur->nom) ?>"</p> 
                    <input type="hidden" name="id" value="<?= $utilisateur->id?>">
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
        <button type="button" class="btn btn-success mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#create_user">
            <i class="fa fa-plus" aria-hidden="true"></i> Créer un compte utilisateur
        </button>
    </div>

    <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">N° carte</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($utilisateurs) != 0):?>
                        <?php foreach($utilisateurs as $utilisateur):?>
                        <tr>
                            <td class="align-middle"><?= ucfirst($utilisateur->nom) ?></td>
                            <td class="align-middle"><?= ucfirst($utilisateur->prenom) ?></td>
                            <td class="align-middle"><?= $utilisateur->carte_id ?></td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-success me-4" data-bs-toggle="modal" data-bs-target="#<?= "edit_user_" . $utilisateur->id?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#<?= "delete_user_" . $utilisateur->id?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <?php else:?>
                        <tr>
                            <td class="align-middle" colspan="4">Vous n'avez pas d'utilisateurs enregistrés</td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
</div>