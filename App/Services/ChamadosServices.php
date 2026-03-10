<?php

namespace App\Services;

use App\Models\Chamados;
use App\Repositories\ChamadosRepository;

class ChamadosServices
{
    private $chamadoRepository;

    public function __construct()
    {
        $this->chamadoRepository = new ChamadosRepository();
    }

    public function CreateChamadoService(Chamados $chamado)
    {
        if (!$chamado->getTitle_chamado() || !$chamado->getMessage_chamado()) {
            return ['error' => "Preencha os campos vazios!"];
        }

        $this->chamadoRepository->CreateChamadoRepository($chamado);

        return ['sucess' => "Chamado aberto com sucesso!"];
    }
}
