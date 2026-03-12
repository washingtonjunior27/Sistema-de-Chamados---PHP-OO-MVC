<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Models\Chamados;
use PDO;
use PDOException;

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
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ReadLastChamadosRepositoryAdmin($limit, $offset)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ReadLastChamadosRepositoryAtendente($id_user, $limit, $offset)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE c.id_user = :id_user OR c.id_atendente = :id_user
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ReadLastChamadosRepositoryUser($id_user, $limit, $offset)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE c.id_user = :id_user
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SearchChamadoRepository($search)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE u.username LIKE :search OR c.title_chamado LIKE :search 
                        OR c.message_chamado LIKE :search OR c.status_chamado LIKE :search 
                        OR c.priority_chamado LIKE :search OR a.username LIKE :search
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $searchResult = "%" . $search . "%";
        $stmt->execute([":search" => $searchResult]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function FilterAtendenteRepository()
    {
        $sql = "SELECT DISTINCT c.id_atendente, a.username AS atendente_name FROM chamados AS c 
                INNER JOIN users AS a ON c.id_atendente = a.id
                WHERE c.id_atendente IS NOT NULL
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectFilterAtendenteRepository($atendentes)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE c.id_atendente = :atendentes
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":atendentes" => $atendentes]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectFilterStatusRepository($status_chamado)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE c.status_chamado = :status_chamado
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":status_chamado" => $status_chamado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectFilterPriorityRepository($priority_chamado)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE c.priority_chamado = :priority_chamado
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":priority_chamado" => $priority_chamado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function TrackChamadoRepository($id_chamado)
    {
        $sql = "SELECT c.*, u.username AS user_name, a.username AS atendente_name, u.role AS user_role 
                FROM chamados AS c 
                INNER JOIN users AS u ON c.id_user = u.id
                LEFT JOIN users AS a ON c.id_atendente = a.id
                WHERE c.id_chamado = :id_chamado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_chamado" => $id_chamado]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function UpdateStatusRepository($status_chamado, $id_atendente, $id_chamado)
    {
        $sql = "UPDATE chamados SET status_chamado = :status_chamado, id_atendente = :id_atendente
        WHERE id_chamado = :id_chamado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(
            [
                ":status_chamado" => $status_chamado,
                ":id_atendente" => $id_atendente,
                ":id_chamado" => $id_chamado
            ]
        );
    }
}
