<?php

require_once("../vendor/autoload.php");

use App\Controller\PageController;
use App\Models\User;
use Routes\router;

$router = new Router();

$router->get("/", PageController::class,  "execute", "main/main.php");

$router->get("/about/about", PageController::class, "execute", "aboutus/aboutus.php");
$router->get("/about/mission", PageController::class, "execute", "aboutus/mission.php");
$router->get("/about/zadachi", PageController::class, "execute", "aboutus/zadazhi.php");
$router->get("/about/target", PageController::class, "execute", "aboutus/target.php");

$router->get("/content/recommendations", PageController::class, "execute", "soderzhanieObr/metRecomendations.php");
$router->get("/content/eduprograms", PageController::class, "execute", "soderzhanieObr/obrazProg.php");
$router->get("/content/posobia", PageController::class, "execute", "soderzhanieObr/metPosobia.php");
$router->get("/content/studylit", PageController::class, "execute", "soderzhanieObr/studyLiterature.php");

$router->get("/news", PageController::class, "execute", "news/news.php");

$router->get("/training/baza", PageController::class, "execute", "pca/bazaClushatelei.php");
$router->get("/training/anketa", PageController::class, "execute", "pca/anketirovanie.php");
$router->get("/training/anketa/innovation", PageController::class, "execute", "pca/anketa/innovation.php");
$router->get("/training/anketa/innovation_ink", PageController::class, "execute", "pca/anketa/innovationInk.php");
$router->get("/training/anketa/management", PageController::class, "execute", "pca/anketa/management.php");
$router->get("/training/anketa/pedagog", PageController::class, "execute", "pca/anketa/pedagog.php");
$router->get("/training/anketa/practice", PageController::class, "execute", "pca/anketa/teoriyaPrac.php");
$router->get("/training/projects", PageController::class, "execute", "pca/proektyOP.php");
$router->get("/training/agreed", PageController::class, "execute", "pca/soglasovannieOP.php");
$router->get("/training/rules", PageController::class, "execute", "pca/pravilauchast.php");
$router->get("/training/application", PageController::class, "execute", "pca/zayavka.php");
$router->get("/training/support", PageController::class, "execute", "pca/podderzhka.php");

$router->get("/documents/ourdocuments", PageController::class, "execute", "documents/ourDocuments.php");
$router->get("/documents/npa", PageController::class, "execute", "documents/npa.php");

$router->get("/additional/bukh", PageController::class, "execute", "dopUslugi/bukhUslugi.php");
$router->get("/additional/finance", PageController::class, "execute", "dopUslugi/finEconomUslugi.php");
$router->get("/additional/tourism", PageController::class, "execute", "dopUslugi/turUslugi.php");
$router->get("/additional/organization", PageController::class, "execute", "dopUslugi/organizaciaKursov.php");

$router->get("/test", PageController::class, "execute", "test.php");

$router->run();
