<?php

require_once __DIR__ . "/../repositories/UsersRepository.php";

class ChamadosController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UsersRepository();
    }

    public function ChamadosReadController()
    {
        //$chamados = $this->userRepository->ReadChamadosRepository();
        require __DIR__ . "/../views/app/chamados.php";
    }
}
