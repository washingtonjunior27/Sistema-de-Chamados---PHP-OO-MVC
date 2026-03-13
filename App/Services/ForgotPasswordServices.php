<?php

namespace App\Services;

use App\Repositories\ForgotPasswordRepository;
use App\Models\ForgotPassword;
use App\Repositories\UsersRepository;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordServices
{
    private $forgotPasswordRepository;
    private $usersRepository;

    public function __construct()
    {
        $this->forgotPasswordRepository = new ForgotPasswordRepository();
        $this->usersRepository = new UsersRepository();
    }

    public function CreateForgotPasswordService(ForgotPassword $forgotPassword)
    {
        if (!$forgotPassword->getEmail()) {
            return ["error" => "Preencha os campos vazios!"];
        }

        $user = $this->usersRepository->VerifyUserData("email", $forgotPassword->getEmail());

        if (!$user) {
            return ["sucess" => "Enviaremos instruções caso encontremos o email"];
        }

        $this->forgotPasswordRepository->DeleteForgotPasswordRepository($forgotPassword->getEmail());
        $this->forgotPasswordRepository->CreateForgotPasswordRepository($forgotPassword);

        return ["sucess" => "Enviaremos instruções caso encontremos o email"];
    }

    public function CreateResetPasswordService($email, $password)
    {
        if (!$password) {
            return ['error' => "Informe a nova senha!"];
        }

        $options = [
            "memory_cost" => 65000,
            "time_cost" => 3,
            "threads" => 2
        ];

        $passwordHash = password_hash($password, PASSWORD_ARGON2ID, $options);

        $this->usersRepository->UpdateUserRepositoryByEmail($passwordHash, $email);
        $this->forgotPasswordRepository->DeleteForgotPasswordRepository($email);

        return ['sucess' => "Senha alterada com sucesso!"];
    }

    public function SendResetEmail($email, $link)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();

            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;

            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];

            $mail->Port = $_ENV['MAIL_PORT'];

            $mail->setFrom(
                $_ENV['MAIL_FROM'],
                $_ENV['MAIL_FROM_NAME']
            );

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = "Recuperação de senha";

            $mail->Body = "
            Clique no link abaixo para redefinir sua senha:<br><br>
            <a href='$link'>$link</a><br><br>
            Este link expira em 1 hora.
        ";

            $mail->send();

            return true;
        } catch (Exception $e) {

            return false;
        }
    }
}
