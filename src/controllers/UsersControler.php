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
        $user->setIs_active($_POST['is_active'] ?? "");

        echo ($_POST['name']);

        $usersService = new UsersServices();
        $usersService->CreateUsersService($user);


        $_SESSION['sucess'] = "Usuário criado com sucesso!";
        header("location: /sistema-de-chamados/public/index.php");
        exit;
    }
}
