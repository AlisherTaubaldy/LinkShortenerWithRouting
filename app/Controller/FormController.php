<?php

namespace App\Controller;

use App\Models\Redirect;

class FormController
{

    public $DOMAIN = "localhost:8000";
    public function execute(): void
    {
        require_once __DIR__ . "/../Views/form.php";
    }

    public function insertLink(){

        $redirect = new Redirect();

        $long_link =  $_POST["link"];

        $redirect->create($long_link);

        include __DIR__ . "/../Views/form.php";

        echo $this->DOMAIN . "/" .  $redirect->getShortLink();
    }
}