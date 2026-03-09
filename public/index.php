<?php

define("BASE_URL", "/sistema-de-chamados/public/");

require_once __DIR__ . "/../src/controllers/PagesController.php";

session_start();

$route = $_GET['route'] ?? "/login";
$pagesController = new PagesController();

switch ($route) {
    case "/login":
        $pagesController->LoginPageController();
        break;
    case "/logout":
        $pagesController->LogoutPageController();
        break;
    case "/register":
        $pagesController->RegisterPageController();
        break;
    case "/home":
        $pagesController->HomePageController();
        break;
    case "/profile":
        $pagesController->ProfilePageController();
        break;
    case "/users":
        $pagesController->UsersPageController();
        break;
    case "/chamados":
        $pagesController->ChamadosPageController();
        break;
    case "/openChamado":
        $pagesController->OpenChamadoPageController();
        break;
    default:
        $pagesController->LoginPageController();
        break;
}
