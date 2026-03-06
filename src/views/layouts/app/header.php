<div class="content d-flex flex-column min-vh-100">
    <header class="bg-dark-blue">
        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex align-items-center justify-content-between justify-content-md-between">
                <a class="navbar-brand text-light fw-bold fs-3" href="home.php">COORD. TI</a>
                <button class="navbar-toggler bg-light" ty pe="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-light active" aria-current="page" href="home.php">Inicio</a>
                        </li>


                        <?php if ($_SESSION['user']['role'] === "admin") { ?>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Usuarios</a>
                            </li>
                        <?php } ?>


                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Chamados</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <form action="/sistema-de-chamados/public/updateUser.php" method="GET">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                                <button type="submit" class="nav-link text-light"><?= $_SESSION['user']['username']; ?></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/sistema-de-chamados/public/logout.php">Sair</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>