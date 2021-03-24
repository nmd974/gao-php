<?php 
    $title = 'Authentification';
    $title_section = "no_view";
    require dirname(dirname(__DIR__))."/src/controllers/auth/login.php";
?>

<?php if($_SESSION["verification"]):?>
    <script> document.location.href=`<?=getenv("URL_APP")?>`; </script>
<?php endif;?>