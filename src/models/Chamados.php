<?php

class Chamados
{
    private int $id_chamados;
    private string $title_chamados;
    private string $message_chamados;
    private string $status_chamados; //Aberto, em atendimento, fechado
    private string $priority_chamados; //Urgente, alta, media, baixa
    private $created_at;
    private int $id_user; //quem abriu chamado
    private int $id_atendente; //quem está atendendo

    /**
     * Get the value of id_chamados
     */
    public function getId_chamados()
    {
        return $this->id_chamados;
    }

    /**
     * Set the value of id_chamados
     *
     * @return  self
     */
    public function setId_chamados($id_chamados)
    {
        $this->id_chamados = $id_chamados;

        return $this;
    }

    /**
     * Get the value of title_chamados
     */
    public function getTitle_chamados()
    {
        return $this->title_chamados;
    }

    /**
     * Set the value of title_chamados
     *
     * @return  self
     */
    public function setTitle_chamados($title_chamados)
    {
        $this->title_chamados = $title_chamados;

        return $this;
    }

    /**
     * Get the value of message_chamados
     */
    public function getMessage_chamados()
    {
        return $this->message_chamados;
    }

    /**
     * Set the value of message_chamados
     *
     * @return  self
     */
    public function setMessage_chamados($message_chamados)
    {
        $this->message_chamados = $message_chamados;

        return $this;
    }

    /**
     * Get the value of status_chamados
     */
    public function getStatus_chamados()
    {
        return $this->status_chamados;
    }

    /**
     * Set the value of status_chamados
     *
     * @return  self
     */
    public function setStatus_chamados($status_chamados)
    {
        $this->status_chamados = $status_chamados;

        return $this;
    }

    /**
     * Get the value of priority_chamados
     */
    public function getPriority_chamados()
    {
        return $this->priority_chamados;
    }

    /**
     * Set the value of priority_chamados
     *
     * @return  self
     */
    public function setPriority_chamados($priority_chamados)
    {
        $this->priority_chamados = $priority_chamados;

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
     * Get the value of id_usuario
     */
    public function getId_usuario()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */
    public function setId_usuario($id_user)
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
