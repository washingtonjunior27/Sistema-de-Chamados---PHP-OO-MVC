<?php

namespace App\Services;

use App\Models\Respostas;
use App\Repositories\RespostasRepository;

class RespostasServices
{
    private $respostasRepository;

    public function __construct()
    {
        $this->respostasRepository = new RespostasRepository();
    }

    public function CreateRespostaService(Respostas $resposta)
    {
        if (!$resposta->getMessage_resposta()) {
            return ['error' => "Preencha os campos vazios!"];
        }

        $this->respostasRepository->CreateRespostasRepository($resposta);

        return ['sucess' => "Resposta publicada com sucesso!"];
    }
}
