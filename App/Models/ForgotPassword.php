<?php

namespace App\Models;

class ForgotPassword
{
    private int $id;
    private string $email;
    private string $token;
    private $date_expire;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of date_expire
     */
    public function getDate_expire()
    {
        return $this->date_expire;
    }

    /**
     * Set the value of date_expire
     *
     * @return  self
     */
    public function setDate_expire($date_expire)
    {
        $this->date_expire = $date_expire;

        return $this;
    }
}
