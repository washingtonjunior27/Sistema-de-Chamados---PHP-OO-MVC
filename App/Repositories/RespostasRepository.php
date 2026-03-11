<?php

namespace App\Repositories;

use App\Models\Respostas;
use App\Config\Connection;
use PDO;
use PDOException;

class RespostasRepository
{
    private $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->Connect();
    }

    public function CreateRespostasRepository(Respostas $resposta)
    {
        $sql = "INSERT INTO respostas (message_resposta, date_resposta, id_user, id_chamado) 
                VALUES (:message_resposta, :date_resposta, :id_user, :id_chamado)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":message_resposta" => $resposta->getMessage_resposta(),
            ":date_resposta" => $resposta->getDate_resposta(),
            ":id_user" => $resposta->getId_user(),
            ":id_chamado" => $resposta->getId_chamado()
        ]);
    }

    public function TrackChamadoRespostaRepository($id_chamado)
    {
        $sql = "SELECT r.*, u.username AS user_name FROM respostas AS r
                INNER JOIN chamados AS c ON c.id_chamado = r.id_chamado
                LEFT JOIN users AS u ON u.id = r.id_user
                WHERE r.id_chamado = :id_chamado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id_chamado" => $id_chamado
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
