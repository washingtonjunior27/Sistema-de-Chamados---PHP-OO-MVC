<?php

require_once __DIR__ . "/UsersController.php";

class PagesController
{
    private $userController;

    public function __construct()
    {
        $this->userController = new UsersController();
    }

    public function LoginPageController()
    {

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/auth/login.php";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->userController->LoginUserController();
        }

        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function LogoutPageController()
    {
        $_SESSION = [];
        session_destroy();
        header("location:" . BASE_URL . "index.php?route=/login");
    }

    public function RegisterPageController()
    {
        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/auth/register.php";

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->userController->CreateUserController();
        }

        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function HomePageController()
    {
        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/login");
            exit;
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";
        require __DIR__ . "/../views/app/home.php";
        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }

    public function ProfilePageController()
    {

        if (!isset($_SESSION['user'])) {
            header("location: " . BASE_URL . "index.php?route=/login");
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
            header("location: " . BASE_URL . "index.php?route=/login");
            exit;
        }

        if ($_SESSION['user']['role'] != "admin") {
            header("location: " . BASE_URL . "index.php?route=/home");
            exit;
        }

        require __DIR__ . "/../views/layouts/auth/headerLogin.php";
        require __DIR__ . "/../views/layouts/app/header.php";

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->userController->StatusUserController();
        } else {
            $this->userController->ReadUserController();
        }

        require __DIR__ . "/../views/layouts/app/footer.php";
        require __DIR__ . "/../views/layouts/auth/footerLogin.php";
    }
}
