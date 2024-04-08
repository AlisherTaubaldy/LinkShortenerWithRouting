<?php

require_once("../vendor/autoload.php");

use App\Controller\FormController;
use App\Controller\HashController;
use Database\DataBase;
use Routes\router;

$router = new Router();

use App\Models\Redirect;

$data = [
    'long_link' => 'http/regfdsfdd',
    'short_link' => 'ergdfsdxccc',
];


$router->get("/", FormController::class,  "execute");
$router->post("/form", FormController::class ,  "insertLink");

$router->addNotFoundHandler(HashController::class , "redirectByShortLink");

$router->run();







//
