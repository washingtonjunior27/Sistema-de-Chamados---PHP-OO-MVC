<div class="content d-flex flex-column min-vh-100">
    <header class="bg-dark-blue">
        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex align-items-center justify-content-between justify-content-md-between">
                <a class="navbar-brand text-light fw-bold fs-3" href="<?= BASE_URL ?>index.php?route=/Home">COORD. TI</a>
                <button class="navbar-toggler bg-light" ty pe="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-light active" aria-current="page" href="<?= BASE_URL ?>index.php?route=/Home">Inicio</a>
                        </li>


                        <?php if ($_SESSION['user']['role'] === "admin") { ?>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="<?= BASE_URL ?>index.php?route=/Users">Usuarios</a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['user']['role'] != "user") { ?>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="<?= BASE_URL ?>index.php?route=/Atendimentos">Atendimentos</a>
                            </li>
                        <?php } ?>


                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= BASE_URL ?>index.php?route=/Chamados">Chamados</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= BASE_URL ?>index.php?route=/Profile">
                                <?= $_SESSION['user']['username']; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= BASE_URL ?>index.php?route=/Logout">Sair</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>