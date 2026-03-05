<?php

require_once __DIR__ . "/../repositories/UsersRepository.php";
require_once __DIR__ . "/../models/Users.php";

class UsersServices
{
    public function CreateUsersService(Users $user)
    {
        if (!$user->getName() || !$user->getUsername() || !$user->getPassword() || !$user->getEmail()) {
            $_SESSION['error'] = "Preencha os campos vazios!";
            header("location: /sistema-de-chamados/public/register.php");
            exit;
        }

        $userRepository = new UsersRepository();

        if ($userRepository->VerifyUserData("email", $user->getEmail())) {
            $_SESSION['error'] = "Email ja cadastrado!";
            header("location: /sistema-de-chamados/public/register.php");
            exit;
        }
        if ($userRepository->VerifyUserData("username", $user->getUsername())) {
            $_SESSION['error'] = "Login ja está em uso!";
            header("location: /sistema-de-chamados/public/register.php");
            exit;
        }

        $password_hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($password_hash);


        $userRepository->CreateUserRepository($user);
    }

    public function LoginUserService(Users $user)
    {
        if (!$user->getUsername() || !$user->getPassword()) {
            $_SESSION['error'] = "Preencha os campos vazios";
            header("location: /sistema-de-chamados/public/index.php");
            exit;
        }

        $userRepository = new UsersRepository();
        $userDb = $userRepository->VerifyUserData("username", $user->getUsername());

        if (!$userDb) {
            return ['error' => "Usuario ou senha inválidos!"];
        }

        if (!password_verify($user->getPassword(), $userDb['password'])) {
            return ['error' => "Senha inválida!"];
        }

        if ($userDb['status'] != 1) {
            return ['error' => "Usuário está desativado!"];
        }

        return ['sucess' => true, 'user' => $userDb];
    }
}
