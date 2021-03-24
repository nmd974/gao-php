<?php

session_start();

if(!isset($_SESSION["logged"])){
    $_SESSION["logged"] = false;
}

$_SESSION["verification"] = false;


$_ENV['URL_APP'] = "";
putenv("URL_APP=http://localhost:8080");