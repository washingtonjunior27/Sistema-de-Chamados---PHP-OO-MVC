<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/Users.php";

class UsersRepository
{
    private $pdo;

    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->Connect();
    }

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

    public function VerifyUserData($column, $data)
    {
        $sql = "SELECT * FROM users WHERE {$column} = :{$column}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":{$column}" => $data]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
