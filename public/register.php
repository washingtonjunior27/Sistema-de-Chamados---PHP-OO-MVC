<?php

session_start();

require __DIR__ . "/../src/views/layouts/auth/headerLogin.php";
require __DIR__ . "/../src/views/auth/register.php";

require __DIR__ . "/../src/controllers/UsersControler.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $userControler = new UsersControler();
    $userControler->CreateUserControler();
}

require __DIR__ . "/../src/views/layouts/auth/footerLogin.php";
