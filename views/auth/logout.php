<?php
    $title = 'Authentification';
    $title_section = "no_view";
    $_SESSION["verification"] = true;
    $_SESSION['logged'] = true;
    unset($_SESSION['logged']);
    session_destroy();
?>

<?php if($_SESSION["verification"]):?>
    <script> document.location.href=`<?=getenv("URL_APP")?>`; </script>
<?php endif;?>