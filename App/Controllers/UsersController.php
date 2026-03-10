<?php

namespace App\Controllers;

use App\Services\UsersServices;
use App\Models\Users;
use App\Repositories\UsersRepository;
use App\Repositories\ChamadosRepository;

class UsersController
{
    private $userRepository;
    private $chamadosRepository;
    private $usersService;
    private $user;

    public function __construct()
    {
        $this->userRepository = new UsersRepository();
        $this->chamadosRepository = new ChamadosRepository();
        $this->usersService = new UsersServices();
        $this->user = new Users();
    }

    public function CreateUserController()
    {
        // RECEBE VARIAVEIS DO FORMULARIO DE CADASTRO
        $this->user->setName(trim($_POST['name'] ?? ""));
        $this->user->setUsername(trim($_POST['username'] ?? ""));
        $this->user->setPassword($_POST['password'] ?? "");
        $this->user->setEmail(trim($_POST['email'] ?? ""));
        $this->user->setRole($_POST['role'] ?? "");
        $this->user->setStatus($_POST['status'] ?? "");

        // CHAMA O SERVICE DE VALIDAÇÕES DO CADASTRO DE USUARIOS
        $result = $this->usersService->CreateUsersService($this->user);

        // SE SERVICES RETORNAR ERROR
        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("location: " . BASE_URL . "index.php?route=/Register");
            exit;
        }

        // SE SERVICES RETORNAR SUCESSO
        $_SESSION['sucess'] = $result['sucess'];
        header("location: " . BASE_URL . "index.php?route=/Login");
        exit;
    }

    public function ReadUserController()
    {
        $search = trim($_GET['search'] ?? "");
        // ARMAZENA DADOS DO BANCO DE DADOS COM REPOSITORY

        if ($search) {
            $users = $this->userRepository->SearchUserRepository($search);
        } else {
            $users = $this->userRepository->ReadUserRepository();
        }

        require __DIR__ . "/../views/app/users.php";
    }

    public function HomeReadController()
    {
        $users = $this->userRepository->ReadUserRepository();
        $chamados = $this->chamadosRepository->ReadChamadosRepository();
        require __DIR__ . "/../views/app/home.php";
    }

    public function ProfileController()
    {
        // RECEBE VARIAVEIS DO FORMULARIO DE UPDATE
        $this->user->setId((int) $_POST['user_id']);
        $this->user->setName(trim($_POST['name']) ?? "");
        $this->user->setUsername(trim($_POST['username']) ?? "");
        $this->user->setPassword($_POST['password'] ?? "");
        $this->user->setEmail(trim($_POST['email']) ?? "");

        // CHAMA O SERVICE PARA VALIDAR O UPDATE DE USUARIOS
        $result = $this->usersService->UpdateUserService($this->user);

        // SE SERVICE RETORNAR ERROR
        if (isset($result["error"])) {
            $_SESSION['error'] = $result['error'];
            header("location:" . BASE_URL . "index.php?route=/Profile");
            exit;
        }

        // SE SERVICE RETORNAR SUCESS
        $_SESSION['sucess'] = $result['sucess'];
        unset($_SESSION['user']);
        header("location:" . BASE_URL . "index.php?route=/Login");
        exit;
    }

    public function ProfileAdminController()
    {
        $this->user->setId((int) $_POST['user_id']);
        $this->user->setName(trim($_POST['name']) ?? "");
        $this->user->setUsername(trim($_POST['username']) ?? "");
        $this->user->setEmail(trim($_POST['email']) ?? "");
        $this->user->setRole(trim($_POST['role']) ?? "");

        // CHAMA O SERVICE PARA VALIDAR O UPDATE DE USUARIOS
        $result = $this->usersService->UpdateUserAdminService($this->user);

        // SE SERVICE RETORNAR ERROR
        if (isset($result["error"])) {
            $_SESSION['error'] = $result['error'];
            header("location:" . BASE_URL . "index.php?route=/Users");
            exit;
        }

        $_SESSION['sucess'] = $result['sucess'];
        header("location:" . BASE_URL . "index.php?route=/Users");
        exit;
    }

    public function StatusUserController()
    {
        $id = $_POST['user_id'];
        $action = $_POST['action'];

        if ($action === "enableUserAdmin") {
            $this->userRepository->StatusUserRepository($id, 1);

            $_SESSION['sucess'] = "Usuário reativado com sucesso!";
            header("location:" . BASE_URL . "index.php?route=/Users");
            exit;
        } else {
            $this->userRepository->StatusUserRepository($id, 2);

            if ($_SESSION['user']['role'] === "admin") {
                $_SESSION['sucess'] = "Usuário desativado com sucesso!";
                header("location:" . BASE_URL . "index.php?route=/Users");
                exit;
            }

            $_SESSION['sucess'] = "Usuário desativado com sucesso!";
            unset($_SESSION['user']);
            header("location:" . BASE_URL . "index.php?route=/Login");
            exit;
        }
    }

    public function TrackProfileController()
    {
        // Recupera ID DA SESSAO
        $sessionUserId = $_SESSION['user']['id'];

        // INSTANCIA USUARIOS E ARMAZENA ID
        $this->user->setId($sessionUserId);

        // CHAMMA REPOSITORY PARA ENCONTRAR USUARIO DE ACORDO COM O ID
        $dbUser = $this->userRepository->VerifyUserData("id", $this->user->getId());

        // MOSTRA O FORMULARIO DE UPDATE COM DADOS PREENCHIDOS
        require __DIR__ . "/../views/app/profile.php";
    }

    public function LoginUserController()
    {
        // ARMAZENA CAMPOS DO LOGIN
        $this->user->setUsername(trim($_POST['username']) ?? "");
        $this->user->setPassword($_POST['password'] ?? "");

        // FAZ VALIDAÇÕES NO SERVICE
        $result = $this->usersService->LoginUserService($this->user);

        // SE SERVICE RETORNAR ERRO EXIBE MENSAGEM
        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("location:" . BASE_URL . "index.php?route=/Login");
            exit;
        }

        // SE RETORNAR SUCESSO ARMAZENA DADOS RETORNADOS EM VARIAVEL
        $userDb = $result['user'];
        session_regenerate_id();

        // ARMAZENA DADOS DE SESSAO EM ARRAY
        $_SESSION['user'] = [
            'id' => $userDb['id'],
            'username' => $userDb['username'],
            'role' => $userDb['role']
        ];

        // FINALIZA PROCESSO DE LOGIN
        header("location:" . BASE_URL . "index.php?route=/Home");
        exit;
    }
}
