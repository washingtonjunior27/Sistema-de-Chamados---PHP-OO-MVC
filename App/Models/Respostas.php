<?php

namespace App\Models;

class Respostas
{
    private int $id_reposta;
    private string $message_resposta;
    private $date_resposta;
    private int $id_user;
    private int $id_chamado;

    /**
     * Get the value of id_reposta
     */
    public function getId_reposta()
    {
        return $this->id_reposta;
    }

    /**
     * Set the value of id_reposta
     *
     * @return  self
     */
    public function setId_reposta($id_reposta)
    {
        $this->id_reposta = $id_reposta;

        return $this;
    }

    /**
     * Get the value of message_resposta
     */
    public function getMessage_resposta()
    {
        return $this->message_resposta;
    }

    /**
     * Set the value of message_resposta
     *
     * @return  self
     */
    public function setMessage_resposta($message_resposta)
    {
        $this->message_resposta = $message_resposta;

        return $this;
    }

    /**
     * Get the value of date_resposta
     */
    public function getDate_resposta()
    {
        return $this->date_resposta;
    }

    /**
     * Set the value of date_resposta
     *
     * @return  self
     */
    public function setDate_resposta($date_resposta)
    {
        $this->date_resposta = $date_resposta;

        return $this;
    }

    /**
     * Get the value of id_user
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_chamado
     */
    public function getId_chamado()
    {
        return $this->id_chamado;
    }

    /**
     * Set the value of id_chamado
     *
     * @return  self
     */
    public function setId_chamado($id_chamado)
    {
        $this->id_chamado = $id_chamado;

        return $this;
    }
}
