<?php

require_once __DIR__ . "/../models/Chamados.php";
require_once __DIR__ . "/../services/ChamadosServices.php";
require_once __DIR__ . "/../repositories/ChamadosRepository.php";

class ChamadosController
{
    private $chamado;
    private $chamadoService;
    private $chamadoRepository;

    public function __construct()
    {
        $this->chamado = new Chamados();
        $this->chamadoService = new ChamadosServices();
        $this->chamadoRepository = new ChamadosRepository;
    }

    public function ChamadosReadController()
    {
        $chamados = $this->chamadoRepository->ReadChamadosRepository();
        require __DIR__ . "/../views/app/chamados.php";
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
            header("location:" . BASE_URL . 'index.php?route=/openChamado');
            exit;
        }

        $_SESSION['sucess'] = $result['sucess'];
        header("location: " . BASE_URL . "index.php?route=/chamados");
        exit;
    }
}
