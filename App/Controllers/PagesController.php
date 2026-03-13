<?php

namespace App\Controllers;

use App\Controllers\UsersController;
use App\Controllers\ChamadosController;
use App\Controllers\ForgotPasswordController;
use App\Repositories\ForgotPasswordRepository;

class PagesController
{
    private $userController;
    private $chamadosController;
    private $forgotPasswordController;
    private $forgotPasswordRepository;

    public function __construct()
    {
        $this->userController = new UsersController();
        $this->chamadosController = new ChamadosController();
        $this->forgotPasswordController = new ForgotPasswordController();
        $this->forgotPasswordRepository = new ForgotPasswordRepository();
    }

    public function LoginPageController()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->userController->LoginUserController();
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/app/login.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function ForgotPasswordPageController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->forgotPasswordController->CreateForgotPasswordController();
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../Views/app/forgotPassword.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }
    public function ResetPasswordPageController()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->forgotPasswordController->CreateResetPasswordController();
            return; // Interrompe para não carregar a view abaixo
        }

        $token = $_GET['token'] ?? "";

        if (!$token) {
            $_SESSION['error'] = "Token Invalido!";
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        $tokenHash = hash("sha256", $token);

        $tokenData = $this->forgotPasswordRepository->FindTokenRepository($tokenHash);

        if (!$tokenData) {
            $_SESSION['error'] = "Token Invalido!";
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        if (strtotime($tokenData['date_expire']) < time()) {
            $_SESSION['error'] = "Token Expirado!";
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }
        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/app/resetPassword.php";
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
        require __DIR__ . "/../views/app/register.php";
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
