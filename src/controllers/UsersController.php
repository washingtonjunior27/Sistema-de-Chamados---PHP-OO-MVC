<?php

require_once __DIR__ . "/../services/UsersServices.php";
require_once __DIR__ . "/../models/Users.php";

class UsersController
{
    public function CreateUserController()
    {
        // INSTANCIA MODEL USERS
        $user = new Users();

        // RECEBE VARIAVEIS DO FORMULARIO DE CADASTRO
        $user->setName(trim($_POST['name'] ?? ""));
        $user->setUsername(trim($_POST['username'] ?? ""));
        $user->setPassword($_POST['password'] ?? "");
        $user->setEmail(trim($_POST['email'] ?? ""));
        $user->setRole($_POST['role'] ?? "");
        $user->setStatus($_POST['status'] ?? "");

        // CHAMA O SERVICE DE VALIDAÇÕES DO CADASTRO DE USUARIOS
        $usersService = new UsersServices();
        $result = $usersService->CreateUsersService($user);

        // SE SERVICES RETORNAR ERROR
        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("location: " . BASE_URL . "index.php?route=/register");
            exit;
        }

        // SE SERVICES RETORNAR SUCESSO
        $_SESSION['sucess'] = $result['sucess'];
        header("location: " . BASE_URL . "index.php?route=/login");
        exit;
    }

    public function ReadUserController()
    {
        $search = trim($_GET['search'] ?? "");
        // ARMAZENA DADOS DO BANCO DE DADOS COM REPOSITORY
        $userRepository = new UsersRepository();

        if ($search) {
            $users = $userRepository->SearchUserRepository($search);
        } else {
            $users = $userRepository->ReadUserRepository();
        }

        require __DIR__ . "/../views/app/users.php";
    }

    public function ProfileController()
    {
        // INSTANCIA DE MODEL USERS
        $user = new Users();

        // RECEBE VARIAVEIS DO FORMULARIO DE UPDATE
        $user->setId((int) $_POST['user_id']);
        $user->setName(trim($_POST['name']) ?? "");
        $user->setUsername(trim($_POST['username']) ?? "");
        $user->setPassword($_POST['password'] ?? "");
        $user->setEmail(trim($_POST['email']) ?? "");

        // CHAMA O SERVICE PARA VALIDAR O UPDATE DE USUARIOS
        $usersService = new UsersServices();
        $result = $usersService->UpdateUserService($user);

        // SE SERVICE RETORNAR ERROR
        if (isset($result["error"])) {
            $_SESSION['error'] = $result['error'];
            header("location:" . BASE_URL . "index.php?route=/profile");
            exit;
        }

        // SE SERVICE RETORNAR SUCESS
        $_SESSION['sucess'] = $result['sucess'];
        unset($_SESSION['user']);
        header("location:" . BASE_URL . "index.php?route=/login");
        exit;
    }

    public function StatusUserController()
    {
        $id = $_POST['user_id'];
        $action = $_POST['action'];

        $userRepository = new UsersRepository();

        if ($action === "enableUserAdmin") {
            $userRepository->StatusUserRepository($id, 1);

            $_SESSION['sucess'] = "Usuário reativado com sucesso!";
            header("location:" . BASE_URL . "index.php?route=/users");
            exit;
        } else {
            $userRepository->StatusUserRepository($id, 2);

            if ($_SESSION['user']['role'] === "admin") {
                $_SESSION['sucess'] = "Usuário desativado com sucesso!";
                header("location:" . BASE_URL . "index.php?route=/users");
                exit;
            }

            $_SESSION['sucess'] = "Usuário desativado com sucesso!";
            unset($_SESSION['user']);
            header("location:" . BASE_URL . "index.php?route=/login");
            exit;
        }
    }

    public function TrackProfileController()
    {
        // Recupera ID DA SESSAO
        $sessionUserId = $_SESSION['user']['id'];

        // INSTANCIA USUARIOS E ARMAZENA ID
        $user = new Users();
        $user->setId($sessionUserId);

        // CHAMMA REPOSITORY PARA ENCONTRAR USUARIO DE ACORDO COM O ID
        $userRepository = new UsersRepository();
        $dbUser = $userRepository->VerifyUserData("id", $user->getId());

        // MOSTRA O FORMULARIO DE UPDATE COM DADOS PREENCHIDOS
        require __DIR__ . "/../views/app/profile.php";
    }

    public function LoginUserController()
    {
        // INSTANCIA USUARIOS
        $user = new Users();

        // ARMAZENA CAMPOS DO LOGIN
        $user->setUsername(trim($_POST['username']) ?? "");
        $user->setPassword($_POST['password'] ?? "");

        // FAZ VALIDAÇÕES NO SERVICE
        $usersService = new UsersServices();
        $result = $usersService->LoginUserService($user);

        // SE SERVICE RETORNAR ERRO EXIBE MENSAGEM
        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("location:" . BASE_URL . "index.php?route=/login");
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
        header("location:" . BASE_URL . "index.php?route=/home");
        exit;
    }
}
