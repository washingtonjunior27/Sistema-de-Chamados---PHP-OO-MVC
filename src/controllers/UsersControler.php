<?php

require_once __DIR__ . "/../services/UsersServices.php";
require_once __DIR__ . "/../models/Users.php";

class UsersControler
{
    public function CreateUserControler()
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
            header("location: /sistema-de-chamados/public/register.php");
            exit;
        }

        // SE SERVICES RETORNAR SUCESSO
        $_SESSION['sucess'] = $result['sucess'];
        header("location: /sistema-de-chamados/public/index.php");
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

    public function UpdateUserControler()
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
            header("location: /sistema-de-chamados/public/updateUser.php?user_id={$user->getId()}");
            exit;
        }

        // SE SERVICE RETORNAR SUCESS
        $_SESSION['sucess'] = $result['sucess'];
        unset($_SESSION['user']);
        header("location: /sistema-de-chamados/public/index.php");
        exit;
    }

    public function StatusUserControler()
    {
        $id = $_POST['user_id'];
        $action = $_POST['action'];

        $userRepository = new UsersRepository();

        if ($action === "enableUserAdmin") {
            $userRepository->StatusUserRepository($id, 1);

            $_SESSION['sucess'] = "Usuário reativado com sucesso!";
            header("location: /sistema-de-chamados/public/users.php");
            exit;
        } else {
            $userRepository->StatusUserRepository($id, 2);

            if ($_SESSION['user']['role'] === "admin") {
                $_SESSION['sucess'] = "Usuário desativado com sucesso!";
                header("location: /sistema-de-chamados/public/users.php");
                exit;
            }

            $_SESSION['sucess'] = "Usuário desativado com sucesso!";
            unset($_SESSION['user']);
            header("location: /sistema-de-chamados/public/index.php");
            exit;
        }
    }

    public function EnableUserControler() {}

    public function TrackUserUpdate()
    {
        // SE NAO ENCONTRAR ID NO GET
        if (!isset($_GET['user_id'])) {
            header("location: /sistema-de-chamados/public/home.php");
            exit;
        }

        // ARMAZENA ID DIGITADO NO URI E ID DE USUARIO DA SESSAO
        $user_id = $_GET['user_id'];
        $sessionUserId = $_SESSION['user']['id'];

        // FAZ A CINOARAÇÃO DOS IDS PARA QUE O USUARIO NAO POSSA BURLAR A EDIÇÃO COM ID DE OUTOR USUARIO
        if ($user_id !== $sessionUserId) {
            header("location: /sistema-de-chamados/public/home.php");
            exit;
        }

        // INSTANCIA USUARIOS E ARMAZENA ID
        $user = new Users();
        $user->setId($user_id);

        // CHAMMA REPOSITORY PARA ENCONTRAR USUARIO DE ACORDO COM O ID
        $userRepository = new UsersRepository();
        $dbUser = $userRepository->VerifyUserData("id", $user->getId());

        // MOSTRA O FORMULARIO DE UPDATE COM DADOS PREENCHIDOS
        require __DIR__ . "/../views/app/updateUser.php";
    }

    public function LoginUserControler()
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
            header("location: /sistema-de-chamados/public/index.php");
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
        header('location: /sistema-de-chamados/public/home.php');
        exit;
    }
}
