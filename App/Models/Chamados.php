<?php

namespace App\Models;

class Chamados
{
    private int $id_chamado;
    private string $title_chamado;
    private string $message_chamado;
    private string $status_chamado; //Aberto, em atendimento, fechado
    private string $priority_chamado; //Urgente, alta, media, baixa
    private $created_at;
    private int $id_user; //quem abriu chamado
    private ?int $id_atendente = null; //quem está atendendo

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

    /**
     * Get the value of title_chamado
     */
    public function getTitle_chamado()
    {
        return $this->title_chamado;
    }

    /**
     * Set the value of title_chamado
     *
     * @return  self
     */
    public function setTitle_chamado($title_chamado)
    {
        $this->title_chamado = $title_chamado;

        return $this;
    }

    /**
     * Get the value of message_chamado
     */
    public function getMessage_chamado()
    {
        return $this->message_chamado;
    }

    /**
     * Set the value of message_chamado
     *
     * @return  self
     */
    public function setMessage_chamado($message_chamado)
    {
        $this->message_chamado = $message_chamado;

        return $this;
    }

    /**
     * Get the value of status_chamado
     */
    public function getStatus_chamado()
    {
        return $this->status_chamado;
    }

    /**
     * Set the value of status_chamado
     *
     * @return  self
     */
    public function setStatus_chamado($status_chamado)
    {
        $this->status_chamado = $status_chamado;

        return $this;
    }

    /**
     * Get the value of priority_chamado
     */
    public function getPriority_chamado()
    {
        return $this->priority_chamado;
    }

    /**
     * Set the value of priority_chamado
     *
     * @return  self
     */
    public function setPriority_chamado($priority_chamado)
    {
        $this->priority_chamado = $priority_chamado;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

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
     * Get the value of id_atendente
     */
    public function getId_atendente()
    {
        return $this->id_atendente;
    }

    /**
     * Set the value of id_atendente
     *
     * @return  self
     */
    public function setId_atendente($id_atendente)
    {
        $this->id_atendente = $id_atendente;

        return $this;
    }
}
