<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/Chamados.php";

class ChamadosRepository
{
    private $pdo;
    public function __construct()
    {
        $con = new Connection();
        $this->pdo = $con->Connect();
    }

    public function CreateChamadoRepository(Chamados $chamado)
    {
        $sql = "INSERT INTO chamados (title_chamado, message_chamado, status_chamado, 
        priority_chamado, created_at, id_user, id_atendente) 
        VALUES (:title_chamado, :message_chamado, :status_chamado, :priority_chamado, 
        :created_at, :id_user, :id_atendente)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":title_chamado" => $chamado->getTitle_chamado(),
            ":message_chamado" => $chamado->getMessage_chamado(),
            ":status_chamado" => $chamado->getStatus_chamado(),
            ":priority_chamado" => $chamado->getPriority_chamado(),
            ":created_at" => $chamado->getCreated_at(),
            ":id_user" => $chamado->getId_user(),
            ":id_atendente" => $chamado->getId_atendente(),
        ]);
    }


    public function ReadChamadosRepository()
    {
        $sql = "SELECT c.*, u.name AS user_name, a.name AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateAtendenteRepository($id_atendente, $status_chamado, $id_chamado)
    {
        $sql = "UPDATE chamados SET id_atendente = :id_atendente, status_chamado = :status_chamado
        WHERE id_chamado = :id_chamado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(
            [
                ":id_atendente" => $id_atendente,
                ":status_chamado" => $status_chamado,
                ":id_chamado" => $id_chamado
            ]
        );
    }

    public function EndChamadoRepository($status_chamado, $id_chamado)
    {
        $sql = "UPDATE chamados SET status_chamado = :status_chamado WHERE id_chamado = :id_chamado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":status_chamado" => $status_chamado,
            ":id_chamado" => $id_chamado
        ]);
    }

    public function DeleteChamadoRepository($id_chamado)
    {
        $sql = "DELETE FROM chamados WHERE id_chamado = :id_chamado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_chamado" => $id_chamado]);
    }
}
