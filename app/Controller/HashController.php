<?php

namespace App\Controller;

use App\Models\Redirect;
class HashController
{

    public static function redirectByShortLink()
    {
        $redirect = new Redirect();

        $requestUri = parse_url($_SERVER['REQUEST_URI']);

        $requestPath = $requestUri['path'];

        $requestPath = trim($requestPath, "/");

        $result = $redirect->searchKey("short_link", $requestPath);


        if ($result){
            header("Location: " . $result['long_link']);
        } else {
            include __DIR__ . "/../Views/404.php";
        }
    }
}
