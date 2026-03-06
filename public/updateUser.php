<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit;
}

require __DIR__ . "/../src/views/layouts/auth/headerLogin.php";
require __DIR__ . "/../src/views/layouts/app/header.php";

require_once __DIR__ . "/../src/controllers/UsersControler.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $userControler = new UsersControler();
    $userControler->UpdateUserControler();
} else {
    $userControler = new UsersControler();
    $userControler->TrackUserUpdate();
}

require __DIR__ . "/../src/views/layouts/app/footer.php";
require __DIR__ . "/../src/views/layouts/auth/footerLogin.php";
