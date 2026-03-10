<?php

define("BASE_URL", "/sistema-de-chamados/public/");

require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\PagesController;

session_start();

$route = $_GET['route'] ?? "/login";
$pagesController = new PagesController();

switch ($route) {
    case "/Login":
        $pagesController->LoginPageController();
        break;
    case "/Logout":
        $pagesController->LogoutPageController();
        break;
    case "/Register":
        $pagesController->RegisterPageController();
        break;
    case "/Home":
        $pagesController->HomePageController();
        break;
    case "/Profile":
        $pagesController->ProfilePageController();
        break;
    case "/Users":
        $pagesController->UsersPageController();
        break;
    case "/Chamados":
        $pagesController->ChamadosPageController();
        break;
    case "/OpenChamado":
        $pagesController->OpenChamadoPageController();
        break;
    case "/ViewChamado":
        $pagesController->ViewChamadoPageController();
        break;
    case "/Atendimentos":
        $pagesController->AtendimentosPageController();
        break;
    default:
        $pagesController->LoginPageController();
        break;
}
