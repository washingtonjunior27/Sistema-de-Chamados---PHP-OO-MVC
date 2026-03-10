<?php

require_once __DIR__ . "/../models/Chamados.php";
require_once __DIR__ . "/../services/ChamadosServices.php";
require_once __DIR__ . "/../repositories/ChamadosRepository.php";
require_once __DIR__ . "/../repositories/UsersRepository.php";

class ChamadosController
{
    private $chamado;
    private $chamadoService;
    private $chamadoRepository;
    private $usersRepository;

    public function __construct()
    {
        $this->chamado = new Chamados();
        $this->chamadoService = new ChamadosServices();
        $this->chamadoRepository = new ChamadosRepository();
        $this->usersRepository = new UsersRepository();
    }

    public function ChamadosReadController()
    {
        $chamados = $this->chamadoRepository->ReadChamadosRepository();
        $atendentes = $this->usersRepository->ReadAtendentesRepository();
        require __DIR__ . "/../views/app/chamados.php";
    }

    public function AtendimentosReadController()
    {
        $chamados = $this->chamadoRepository->ReadChamadosRepository();
        $atendentes = $this->usersRepository->ReadAtendentesRepository();
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
        $action = $_POST['action'];
        $this->chamado->setId_chamado($_POST['id_chamado']);

        $result = $this->chamadoRepository->TrackChamadoRepository($this->chamado->getId_chamado());

        if ($action == "viewChamadoAtendimentos") {
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
