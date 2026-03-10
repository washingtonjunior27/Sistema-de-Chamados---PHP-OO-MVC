<?php

namespace App\Config;

use PDO;
use PDOException;

class Connection
{
    private $dbHost = "localhost";
    private $dbName = "chamados";
    private $dbUser = "root";
    private $dbPassword = "";

    public function Connect()
    {
        try {
            $conn = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName};charset=utf8", $this->dbUser, $this->dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Erro de conexão!!" . $e->getMessage();
        }
    }
}
