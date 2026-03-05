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

        $password_hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($password_hash);

        $userRepository = new UsersRepository();
        $userRepository->CreateUserRepository($user);
    }
}
