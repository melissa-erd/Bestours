<?php


use MiladRahimi\PhpRouter\Router;
use src\Controllers\MainController;

require_once "vendor/autoload.php";

ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'docker');
ORM::configure('password', 'docker');

$router = Router::create();
$router->setupView('views');



$router->get('/', [MainController::class, 'index']);
$router->get('/detail-page/{id}', [MainController::class, 'detail_page']);
//$router->get('/detail-page', [MainController::class, 'detail_page']);



$router->dispatch();