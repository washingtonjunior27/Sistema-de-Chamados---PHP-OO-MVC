<?php

namespace App\Controllers;

use App\Models\Respostas;
use App\Services\RespostasServices;
use App\Repositories\ChamadosRepository;

class RespostasController
{
    private $resposta;
    private $respostaService;
    private $chamadoRepository;

    public function __construct()
    {
        $this->resposta = new Respostas();
        $this->respostaService = new RespostasServices();
        $this->chamadoRepository = new ChamadosRepository();
    }

    public function CreateRespostaController()
    {
        date_default_timezone_set('America/Manaus');

        $id_person = $_SESSION['user']['id'];
        $id_chamado = $_POST['id_chamado'];
        $chamado = $this->chamadoRepository->TrackChamadoRepository($id_chamado);
        $creator_id = $chamado['id_user'];

        $from = $_POST['from'] ?? 'chamados';

        $this->resposta->setMessage_resposta(trim($_POST['message_chamado'] ?? ""));
        $this->resposta->setDate_resposta(date('Y-m-d H:i:s'));
        $this->resposta->setId_user($id_person);
        $this->resposta->setId_chamado($id_chamado);

        $resultService = $this->respostaService->CreateRespostaService($this->resposta);

        if (isset($resultService['error'])) {
            $_SESSION['error'] = $resultService['error'];
            header("location: " . BASE_URL . "index.php?route=/ViewChamado&id_chamado=" . $this->resposta->getId_chamado() . "&from=" . $from);
            exit;
        }

        if (($_SESSION['user']['role'] != "user") && ($creator_id != $id_person)) {
            $this->chamadoRepository->UpdateStatusRepository("Em atendimento", $id_person, $this->resposta->getId_chamado());
        }

        $_SESSION['sucess'] = $resultService['sucess'];
        header("location: " . BASE_URL . "index.php?route=/ViewChamado&id_chamado=" . $this->resposta->getId_chamado() . "&from=" . $from);
        exit;
    }
}
