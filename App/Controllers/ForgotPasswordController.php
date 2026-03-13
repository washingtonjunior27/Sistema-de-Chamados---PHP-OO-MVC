<?php

namespace App\Controllers;

use App\Models\ForgotPassword;
use App\Services\ForgotPasswordServices;
use App\Repositories\ForgotPasswordRepository;


class ForgotPasswordController
{
    private $forgotPassword;
    private $forgotPasswordServices;
    private $forgotPasswordRepository;

    public function __construct()
    {
        $this->forgotPassword = new ForgotPassword();
        $this->forgotPasswordServices = new ForgotPasswordServices();
        $this->forgotPasswordRepository = new ForgotPasswordRepository();
    }

    public function CreateForgotPasswordController()
    {
        $this->forgotPassword->setEmail(trim($_POST['email'] ?? ""));
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash("sha256", $token);
        $this->forgotPassword->setToken($tokenHash);
        $this->forgotPassword->setDate_expire(date("Y-m-d H:i:s", strtotime("+1 hour")));

        $link = "http://localhost" . BASE_URL . "index.php?route=/ResetPassword&token=" . $token;

        $result = $this->forgotPasswordServices->CreateForgotPasswordService($this->forgotPassword);

        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("location: " . BASE_URL . "index.php?route=/ForgotPassword");
            exit;
        }

        $this->forgotPasswordServices->SendResetEmail(
            $this->forgotPassword->getEmail(),
            $link
        );

        $_SESSION['sucess'] = $result['sucess'];
        header("location: " . BASE_URL . "index.php?route=/Login");
        exit;
    }

    public function CreateResetPasswordController()
    {
        $token = $_POST['token'];
        $tokenHash = hash("sha256", $token);
        $password = $_POST['reset_password'];

        $tokenData = $this->forgotPasswordRepository->FindTokenRepository($tokenHash);

        if (!$tokenData) {
            $_SESSION['error'] = "Token Invalido!";
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }
        if (strtotime($tokenData['date_expire']) < time()) {
            $_SESSION['error'] = "Token Expirado!";
            header("location: " . BASE_URL . "index.php?route=/Login");
            exit;
        }

        $reset = $this->forgotPasswordServices->CreateResetPasswordService($tokenData['email'], $password);

        if (isset($reset['error'])) {
            $_SESSION['error'] = $reset['error'];
            header("location: " . BASE_URL . "index.php?route=/ResetPassword&token=" . $token);
            exit;
        }

        $_SESSION['sucess'] = $reset['sucess'];
        header("location: " . BASE_URL . "index.php?route=/Login");
        exit;
    }
}
