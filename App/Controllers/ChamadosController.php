<?php

namespace App\Controllers;

use App\Models\Chamados;
use App\Services\ChamadosServices;
use App\Repositories\ChamadosRepository;
use App\Repositories\UsersRepository;
use App\Repositories\RespostasRepository;

class ChamadosController
{
    private $chamado;
    private $chamadoService;
    private $chamadoRepository;
    private $usersRepository;
    private $respostaRepository;

    public function __construct()
    {
        $this->chamado = new Chamados();
        $this->chamadoService = new ChamadosServices();
        $this->chamadoRepository = new ChamadosRepository();
        $this->usersRepository = new UsersRepository();
        $this->respostaRepository = new RespostasRepository;
    }

    public function ChamadosReadController()
    {
        $id_user = $_SESSION['user']['id'];
        $results = [
            "search" => trim($_GET['search'] ?? ""),
            "atendentes" => $_GET['atendentes'] ?? 0,
            "status_chamado" => trim($_GET['status_chamado'] ?? ""),
            "priority_chamado" => trim($_GET['priority_chamado'] ?? ""),
            "id_user" => $id_user
        ];

        if ($_SESSION['user']['role'] === "atendente") {
            $results["user_role"] = "atendente";
        }
        if ($_SESSION['user']['role'] === "user") {
            $results["user_role"] = "user";
        }

        $page = $_GET['page'] ?? 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $chamados = $this->chamadoRepository->FiltersChamadosRepository($results, $limit, $offset);
        $countChamados = $this->chamadoRepository->CountChamadosRepository($results);
        $totalPages = ceil($countChamados / $limit);

        $selectAtendente = $this->chamadoRepository->FilterAtendenteRepository($id_user);

        require __DIR__ . "/../views/app/chamados.php";
    }

    public function AtendimentosReadController()
    {
        $results = [
            "search" => trim($_GET['search'] ?? ""),
            "status_chamado" => trim($_GET['status_chamado'] ?? ""),
            "priority_chamado" => trim($_GET['priority_chamado'] ?? ""),
            "id_atendente" => $_SESSION['user']['id']
        ];

        $page = $_GET['page'] ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $chamados = $this->chamadoRepository->FiltersChamadosRepository($results, $limit, $offset);
        $countChamados = $this->chamadoRepository->CountChamadosRepository($results);
        $totalPages = ceil($countChamados / $limit);

        $selectAtendentes = $this->usersRepository->ReadAtendentesRepository();
        require __DIR__ . "/../views/app/atendimentos.php";
    }

    public function OpenChamadoController()
    {
        date_default_timezone_set('America/Manaus');

        $id_user = $_SESSION['user']['id'];

        $this->chamado->setTitle_chamado(trim($_POST['title_chamado'] ?? ""));
        $this->chamado->setMessage_chamado(trim($_POST['message_chamado'] ?? ""));
        $this->chamado->setStatus_chamado(trim($_POST['status_chamado'] ?? ""));
        $this->chamado->setPriority_chamado(trim($_POST['priority_chamado'] ?? ""));
        $this->chamado->setCreated_at(date('Y/m/d H:i:s'));
        $this->chamado->setId_user($id_user);

        $result = $this->chamadoService->CreateChamadoService($this->chamado);

        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("location:" . BASE_URL . 'index.php?route=/OpenChamado');
            exit;
        }

        $_SESSION['sucess'] = $result['sucess'];
        header("location: " . BASE_URL . "index.php?route=/Chamados");
        exit;
    }

    public function ViewChamadoController()
    {
        $action = $_GET['from'];
        $id_chamado = $_GET['id_chamado'] ?? 0;
        $id_user = $_SESSION['user']['id'];

        $chamado = $this->chamadoRepository->TrackChamadoRepository($id_chamado);
        $respostas = $this->respostaRepository->TrackChamadoRespostaRepository($id_chamado);

        if (!$id_chamado) {
            header("Location: " . BASE_URL . "index.php?route=/Home");
            exit;
        }

        if (!$chamado) {
            header("Location: " . BASE_URL . "index.php?route=/Home");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role'];

        $allowed = false;

        if ($role === "admin") {
            $allowed = true;
        }

        if ($role === "user" && $chamado['id_user'] == $user_id) {
            $allowed = true;
        }

        if ($role === "atendente") {

            // chamado criado por ele
            if ($chamado['id_user'] == $user_id) {
                $allowed = true;
            }

            // chamado atribuído a ele
            if ($chamado['id_atendente'] == $user_id) {
                $allowed = true;
            }

            // chamado aberto sem atendente
            if ($chamado['status_chamado'] === "Aberto") {
                $allowed = true;
            }
        }

        if (!$allowed) {
            header("Location: " . BASE_URL . "index.php?route=/Chamados");
            exit;
        }



        if ($action == "Atendimentos") {
            $pageRedirect = "index.php?route=/Atendimentos";
        } else {
            $pageRedirect = "index.php?route=/Chamados";
        }

        require __DIR__ . "/../views/app/viewChamado.php";
    }

    public function SelectAtendenteController()
    {
        $this->chamado->setId_atendente(trim($_POST['atendente_chamado'] ?? ""));
        $this->chamado->setStatus_chamado("Em Atendimento");
        $this->chamado->setId_chamado($_POST['id_chamado']);

        $this->chamadoRepository->UpdateAtendenteRepository(
            $this->chamado->getId_atendente(),
            $this->chamado->getStatus_chamado(),
            $this->chamado->getId_chamado()
        );

        $_SESSION['sucess'] = "Atendente designado para o chamado com sucesso!";
        header("location: " . BASE_URL . "index.php?route=/Chamados");
        exit;
    }

    public function ResponseChamadoController()
    {
        $id_atendente = $_SESSION['user']['id'];
        $this->chamado->setId_atendente($id_atendente);
        $this->chamado->setStatus_chamado("Em Atendimento");
        $this->chamado->setId_chamado($_POST['id_chamado']);
        $this->chamadoRepository->UpdateAtendenteRepository(
            $this->chamado->getId_atendente(),
            $this->chamado->getStatus_chamado(),
            $this->chamado->getId_chamado()
        );
        $_SESSION['sucess'] = "Chamado pego com sucesso!";
        header("location: " . BASE_URL . "index.php?route=/Atendimentos");
        exit;
    }

    public function EndChamadoController()
    {
        $action = $_POST['action'];
        $this->chamado->setId_chamado($_POST['id_chamado']);
        $this->chamado->setStatus_chamado("Finalizado");

        $this->chamadoRepository->EndChamadoRepository(
            $this->chamado->getStatus_chamado(),
            $this->chamado->getId_chamado()
        );

        if ($action === "endChamadoAtendente") {
            $_SESSION['sucess'] = "Chamado encerrado com sucesso!";
            header("location: " . BASE_URL . "index.php?route=/Atendimentos");
            exit;
        }

        $_SESSION['sucess'] = "Chamado encerrado com sucesso!";
        header("location: " . BASE_URL . "index.php?route=/Chamados");
        exit;
    }

    public function DeleteChamadoController()
    {
        $this->chamado->setId_chamado($_POST['id_chamado']);

        $this->chamadoRepository->DeleteChamadoRepository($this->chamado->getId_chamado());

        $_SESSION['sucess'] = "Chamado excluido com sucesso!";
        header("location: " . BASE_URL . "index.php?route=/Chamados");
        exit;
    }
}
