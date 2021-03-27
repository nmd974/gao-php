<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Centre culturel - Gestion des reservations d'ordinateurs</title>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/c18e5332f2.js"></script>
</head>

<body>
    <div class="d-flex disabledOverflow" id="wrapper">
        <!--LOADER-->
        <div class="h-100 w-100 bg-light position-absolute d-flex justify-content-center align-items-center" id="loader_wrapper"  style="z-index: 10001">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <?php if(isset($_SESSION['flash'])):?>
        <?php if($_SESSION['flash'][0] == "Success"):?>
        <div class="position-fixed bottom-0 start-50 translate-middle-x" style="z-index: 10002">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" id="liveToast" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
            <?= $_SESSION['flash'][1] ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        </div>
        <?php else:?>
        <div class="position-fixed bottom-0 start-50 translate-middle-x" style="z-index: 10002">
        <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" id="liveToast" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
                <?= $_SESSION['flash'][1] ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        </div>
        <?php endif;?>
        <?php endif;?>

        <!-- Sidebar -->
        <?php if(isset($_SESSION['logged']) && $_SESSION['logged']):?>
        <div class="border-right position-fixed" id="sidebar-wrapper">

            <div class="list-group list-group-flush">
                <a href="<?= getenv("URL_APP")?>"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-start">
                    <i class="fa fa-tachometer me-3" aria-hidden="true"></i>
                    <div>Tableau de bord</div>
                </a>
                <a href="<?= getenv("URL_APP")?>/utilisateurs"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-start">
                    <i class="fa fa-users me-3" aria-hidden="true"></i>
                    <div>Liste des utilisateurs</div>
                </a>
                <a href="<?= getenv("URL_APP")?>/poste-informatique"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-start">
                    <i class="fa fa-laptop me-3" aria-hidden="true"></i>
                    <div>Liste des postes informatiques</div>
                </a>
            </div>
        </div>
        <?php endif;?>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="ms-2 d-flex align-items-center">
                    <?php if(isset($_SESSION['logged']) && $_SESSION['logged']):?>
                        <i class="fa fa-bars fa-2x fa-action" style="color:white;" aria-hidden="true"
                            id="sidebar-toggle"></i>
                    <?php endif;?>
                        <a class="navbar-brand ms-2" href="./accueil.php">Centre culturel</a>
                    </div>
                    <?php if(isset($_SESSION['logged']) && $_SESSION['logged']):?>
                        <a href="<?=getenv("URL_APP")?>/logout"><i class="fa fa-power-off fa-2x me-2 fa-action" id="logout" style="color:white;" aria-hidden="true"></i></a>
                    <?php else:?>
                        <a href="<?=getenv("URL_APP")?>"><i class="fa fa-power-off fa-2x me-2 fa-action" id="logout" style="color:white;" aria-hidden="true"></i></a>
                    <?php endif;?>
                </div>
            </nav>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <div class="container-fluid">
        <div id="starting-page">
            <div class="title-content d-flex align-items-center">
                <div class="delimiter-title"></div>
                <div class="delimiter-title ms-1"></div>
                <h2 class="ms-4"><?= $title_section ?? 'Centre culturel' ?></h2>
            </div>
            <div class="bloc-content">
                <!-- METTRE ICI LE CONTENU-->
                <?= $content ?>
            </div>
        </div>
        <!-- </div> -->
        <!-- END WRAPPER CONTENT -->
    </div>
    <!-- END STARTING PAGE -->
    </div>
    <!-- END CONTAINER -->
    <?php if($title_section != "no_view"):?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <!-- GESTION SIDEBAR TOGGLE -->
        <script>
            $("#sidebar-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $("#starting-page").toggleClass("toggled");
            });
            <?php if(isset($_SESSION['logged']) && $_SESSION['logged']):?>
            $('html').css('overflow-y', 'scroll');
            //Gestion du loader
            $(document).ready(function (){
                $('#loader_wrapper').remove();
            })
            <?php endif;?>
            //Gestion des msg flash
            <?php if(isset($_SESSION['flash'])):?>   
                var toast = new bootstrap.Toast(document.getElementById('liveToast'))
                toast.show();
                <?php unset($_SESSION['flash']);?>
            <?php endif; ?>
        </script>
    <?php endif;?>
</body>

</html>
