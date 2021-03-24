<?php
require '../vendor/autoload.php';
require '../src/session.php';

//Ajout de la customisation du debbogage php
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

//Ici on dégini le dossier principal
$router = new App\Router(dirname(__DIR__) . '/views');

//On détermine les différentes routes via la class Router
if($_SESSION["logged"]){
    $router
    ->get('/', 'bookings/index', '')
    ->get('/logout', 'auth/logout', '')
    ->run();
}else{
    $router
    ->get('/', 'auth/index', '')
    ->get('/login', 'auth/login', '')
    ->run();
}



