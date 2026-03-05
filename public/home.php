<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit;
}

require __DIR__ . "/../src/views/layouts/auth/headerLogin.php";
require __DIR__ . "/../src/views/layouts/app/header.php";
require __DIR__ . "/../src/views/app/home.php";
require __DIR__ . "/../src/views/layouts/app/footer.php";
require __DIR__ . "/../src/views/layouts/auth/footerLogin.php";
