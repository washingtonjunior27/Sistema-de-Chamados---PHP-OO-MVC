<?php

require_once __DIR__ . "/../services/UsersServices.php";
require_once __DIR__ . "/../models/Users.php";

class UsersControler
{
    public function CreateUserControler()
    {
        $user = new Users();

        $user->setName(trim($_POST['name'] ?? ""));
        $user->setUsername(trim($_POST['username'] ?? ""));
        $user->setPassword($_POST['password'] ?? "");
        $user->setEmail(trim($_POST['email'] ?? ""));
        $user->setRole($_POST['role'] ?? "");
        $user->setStatus($_POST['status'] ?? "");

        $usersService = new UsersServices();
        $usersService->CreateUsersService($user);


        $_SESSION['sucess'] = "Usuário criado com sucesso!";
        header("location: /sistema-de-chamados/public/index.php");
        exit;
    }

    public function LoginUserControler()
    {
        $user = new Users();
        $user->setUsername(trim($_POST['username']) ?? "");
        $user->setPassword($_POST['password'] ?? "");

        $usersService = new UsersServices();
        $result = $usersService->LoginUserService($user);

        if (isset($userDb['error'])) {
            $_SESSION['error'] = $userDb['error'];
            header("location: /sistema-de-chamados/public/index.php");
            exit;
        }

        $userDb = $result['user'];
        session_regenerate_id();

        $_SESSION['user'] = [
            'id' => $userDb['id'],
            'username' => $userDb['username'],
            'role' => $userDb['role']
        ];

        header('location: /sistema-de-chamados/public/home.php');
        exit;
    }
}
