<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\ForgotPassword;
use PDO;
use PDOException;

class ForgotPasswordRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->Connect();
    }

    public function CreateForgotPasswordRepository(ForgotPassword $forgotPassword)
    {
        $sql = "INSERT INTO forgot_password (email, token, date_expire) 
                VALUES (:email, :token, :date_expire)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":email" => $forgotPassword->getEmail(),
            ":token" => $forgotPassword->getToken(),
            ":date_expire" => $forgotPassword->getDate_expire()
        ]);
    }

    public function DeleteForgotPasswordRepository($email)
    {
        $sql = "DELETE FROM forgot_password WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":email" => $email
        ]);
    }

    public function FindTokenRepository($tokenHash)
    {
        $sql = "SELECT * FROM forgot_password WHERE token = :token";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":token" => $tokenHash
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
