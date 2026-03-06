<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/Users.php";

class UsersRepository
{
    private $pdo;

    // CONSTRUTOR DE PDO
    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->Connect();
    }

    // SQL PARA CRIAR USUARIO
    public function CreateUserRepository(Users $user)
    {
        $sql = "INSERT INTO users (name, username, password, email, role, status) 
                VALUES (:name, :username, :password, :email, :role, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":name" => $user->getName(),
            ":username" => $user->getUsername(),
            ":password" => $user->getPassword(),
            ":email" => $user->getEmail(),
            ":role" => $user->getRole(),
            ":status" => $user->getStatus()
        ]);
    }

    // SQL PARA ATUALIZAR USUARIO
    public function UpdateUserRepository(Users $user)
    {
        $sql = "UPDATE users SET name = :name, username = :username, password = :password, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":name" => $user->getName(),
            ":username" => $user->getUsername(),
            ":password" => $user->getPassword(),
            ":email" => $user->getEmail(),
            ":id" => $user->getId()
        ]);
    }

    // SQL PARA BUSCAR USUARIO UNICO. $COLUMN É DIGITADO MANUALMENTE NOS CONTROLERS. SEM RISCO DE SQL INJECTION. $DATA RECEBE DADOS.
    public function VerifyUserData($column, $data)
    {
        $sql = "SELECT * FROM users WHERE {$column} = :{$column}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":{$column}" => $data]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
