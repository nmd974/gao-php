<?php

session_start();

if(!isset($_SESSION["logged"])){
    $_SESSION["logged"] = false;
}

$_SESSION["verification"] = false;

date_default_timezone_set("Indian/Reunion");
$_ENV['URL_APP'] = "";
// putenv("URL_APP=http://localhost:8080");