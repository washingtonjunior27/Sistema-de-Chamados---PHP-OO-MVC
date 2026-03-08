<?php

require_once __DIR__ . "/../repositories/UsersRepository.php";
require_once __DIR__ . "/../models/Users.php";

class UsersServices
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UsersRepository();
    }

    public function CreateUsersService(Users $user)
    {
        // VALIDA CAMPOS VAZIOS
        if (!$user->getName() || !$user->getUsername() || !$user->getPassword() || !$user->getEmail()) {
            return ["error" => "Preencha os campos vazios!"];
        }

        // VALIDA EMAILS JA CADASTRADOS
        if ($this->userRepository->VerifyUserData("email", $user->getEmail())) {
            return ["error" => "Email ja cadastrado!"];
        }
        // VALIDA USERNAMES JA CADASTRADOS
        if ($this->userRepository->VerifyUserData("username", $user->getUsername())) {
            return ["error" => "Login ja está em uso!"];
        }
        // HASH EXTRA PARA ARGON2ID CONTRA PLACAS DE VIDEOS COM MUITOS NUCLEOS
        $options = [
            "memory_cost" => 65000,
            "time_cost" => 3,
            "threads" => 2
        ];

        // HASH DE SENHA
        $password_hash = password_hash($user->getPassword(), PASSWORD_ARGON2ID, $options);
        $user->setPassword($password_hash);


        $this->userRepository->CreateUserRepository($user);

        return ["sucess" => "Cadastro realizado com sucesso"];
    }

    public function UpdateUserService(Users $user)
    {
        // VALIDA CAMPOS VAZIOS
        if (!$user->getName() || !$user->getUsername() || !$user->getEmail() || !$user->getPassword()) {
            return ['error' => "Preencha os campos vazios!"];
        }

        // VERIFICA SE O USERNAME JA EXISTE NO BANCO DE DADOS E ARMAZENA TODOS OS DADOS EM UMA VARIAVEL SE RETURN TRUE
        $usernameDb = $this->userRepository->VerifyUserData("username", $user->getUsername());


        // SE TIVER RETORNADO TRUE
        if ($usernameDb) {
            // VERIFICA SE O ID RETORNADO DO USUARIO É O MESMO DO USUÁRIO LOGADO, PARA QUE ASSIM POSSA ATUALIZAR DADOS REPETIDOS.
            if ((int)$usernameDb['id'] !== (int)$user->getId()) {
                return ['error' => "Login ja está em uso!"];
            }
        }

        // VERIFICA SE O EMAIL JA EXISTE NO BANCO DE DADOS E ARMAZENA TODOS OS DADOS EM UMA VARIAVEL SE RETURN TRUE
        $emailDb = $this->userRepository->VerifyUserData("email", $user->getEmail());
        // SE TIVER RETORNADO TRUE
        if ($emailDb) {
            // VERIFICA SE O ID RETORNADO DO USUARIO É O MESMO DO USUÁRIO LOGADO, PARA QUE ASSIM POSSA ATUALIZAR DADOS REPETIDOS.
            if ((int)$emailDb['id'] !== (int)$user->getId()) {
                return ['error' => "Email ja cadastrado!"];
            }
        }

        $options = [
            "memory_cost" => 65000,
            "time_cost" => 3,
            "threads" => 2
        ];

        $password_hash = password_hash($user->getPassword(), PASSWORD_ARGON2ID, $options);
        $user->setPassword($password_hash);
        $this->userRepository->UpdateUserRepository($user);
        return ["sucess" => "Dados atualizados com sucesso!"];
    }

    public function UpdateUserAdminService(Users $user)
    {
        // VALIDA CAMPOS VAZIOS
        if (!$user->getName() || !$user->getUsername() || !$user->getEmail()) {
            return ['error' => "Preencha os campos vazios!"];
        }

        // VERIFICA SE O USERNAME JA EXISTE NO BANCO DE DADOS E ARMAZENA TODOS OS DADOS EM UMA VARIAVEL SE RETURN TRUE
        $usernameDb = $this->userRepository->VerifyUserData("username", $user->getUsername());

        // SE TIVER RETORNADO TRUE
        if ($usernameDb) {
            // VERIFICA SE O ID RETORNADO DO USUARIO É O MESMO DO USUÁRIO LOGADO, PARA QUE ASSIM POSSA ATUALIZAR DADOS REPETIDOS.
            if ((int)$usernameDb['id'] !== (int)$user->getId()) {
                return ['error' => "Login ja está em uso!"];
            }
        }

        // VERIFICA SE O EMAIL JA EXISTE NO BANCO DE DADOS E ARMAZENA TODOS OS DADOS EM UMA VARIAVEL SE RETURN TRUE
        $emailDb = $this->userRepository->VerifyUserData("email", $user->getEmail());
        // SE TIVER RETORNADO TRUE
        if ($emailDb) {
            // VERIFICA SE O ID RETORNADO DO USUARIO É O MESMO DO USUÁRIO LOGADO, PARA QUE ASSIM POSSA ATUALIZAR DADOS REPETIDOS.
            if ((int)$emailDb['id'] !== (int)$user->getId()) {
                return ['error' => "Email ja cadastrado!"];
            }
        }


        $this->userRepository->UpdateUserAdminRepository($user);
        return ["sucess" => "Dados atualizados com sucesso!"];
    }

    public function LoginUserService(Users $user)
    {
        // VERIFICA CAMPOS VAZIOS
        if (!$user->getUsername() || !$user->getPassword()) {
            return ["error" => "Preencha os campos vazios"];
        }

        // VERIFICA SE USUARIO EXISTE NO BANCO DE DADOS
        $userDb = $this->userRepository->VerifyUserData("username", $user->getUsername());

        // SE USUARIO NAO EXISTE RETORNA INVALIDO
        if (!$userDb) {
            return ['error' => "Usuario ou senha inválidos!"];
        }

        // SE USUARIO EXISTE MAS SENHA ESTÁ ERRADA RETORNA INVALIDO
        if (!password_verify($user->getPassword(), $userDb['password'])) {
            return ['error' => "Senha inválida!"];
        }

        // SE USUARIO EXISTE MAS ESTA COM STATUS INATIVO RETORNA INVALIDO
        if ($userDb['status'] != 1) {
            return ['error' => "Usuário está desativado!"];
        }

        return ['sucess' => true, 'user' => $userDb];
    }
}
