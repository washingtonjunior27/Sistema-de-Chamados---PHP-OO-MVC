<?php

namespace App\Controllers;

use App\Controllers\UsersController;
use App\Controllers\ChamadosController;
use App\Controllers\RespostasController;

class PagesController
{
    private $userController;
    private $chamadosController;
    private $respostasController;

    public function __construct()
    {
        $this->userController = new UsersController();
        $this->chamadosController = new ChamadosController();
        $this->respostasController = new RespostasController();
    }

    public function LoginPageController()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->userController->LoginUserController();
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/auth/login.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function LogoutPageController()
    {
        $_SESSION = [];
        session_destroy();
        header("location:" . BASE_URL . "index.php?route=/Login");
    }

    public function RegisterPageController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->userController->CreateUserController();
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/auth/register.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function HomePageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";
        $this->userController->HomeReadController();
        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function ChamadosPageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_POST['action'] === "selectAtendente") {
                $this->chamadosController->SelectAtendenteController();
            }
            if ($_POST['action'] === "responseChamado") {
                $this->chamadosController->ResponseChamadoController();
            }
            if ($_POST['action'] === "endChamado") {
                $this->chamadosController->EndChamadoController();
            }
            if ($_POST['action'] === "deleteChamado") {
                $this->chamadosController->DeleteChamadoController();
            }
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";
        $this->chamadosController->ChamadosReadController();
        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function OpenChamadoPageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->chamadosController->OpenChamadoController();
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";
        require __DIR__ . "/../views/app/openChamado.php";
        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function ProfilePageController()
    {

        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";


        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_POST['action'] === "updateUser") {
                $this->userController->ProfileController();
            }

            if ($_POST['action'] === "disableUser") {
                $this->userController->StatusUserController();
            }
        } else {
            $this->userController->TrackProfileController();
        }

        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function UsersPageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        if ($_SESSION['user']['role'] != "admin") {
            header("location: " . BASE_URL . "index.php?route=/Home");
            exit;
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // ADMIN PODE EDITAR PERFIS DE USUARIOS
            if ($_POST['action'] === "editUserAdmin") {
                $this->userController->ProfileAdminController();
            }

            // ATUALIZAÇÃO DE CONTA ATIVA OU INATIVA
            $this->userController->StatusUserController();
        } else {
            // APRESENTA TODOS OS DADOS
            $this->userController->ReadUserController();
        }

        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function ViewChamadoPageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";

        $this->chamadosController->ViewChamadoController();

        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function AtendimentosPageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }
        if ($_SESSION['user']['role'] === "user") {
            header("location: " . BASE_URL . "index.php?route=/Home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($_POST['action'] === "endChamadoAtendente") {
                $this->chamadosController->EndChamadoController();
            }
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";
        $this->chamadosController->AtendimentosReadController();
        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }
}
