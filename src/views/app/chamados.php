<div class="container flex-fill d-flex flex-column justify-content-center">
    <h3 class="fs-3 text-center mb-5 mt-3">Chamados</h3>

    <?php if (isset($_SESSION['sucess'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['sucess']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['sucess']);
    } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['error']);
    } ?>

    <div class="search-form d-flex justify-content-between align-items-center gap-4 mb-4">
        <a href="<?= BASE_URL ?>index.php?route=/openChamado" class="btn btn-primary">Abrir Chamado</a>
        <form class="d-flex flex-fill" method="GET" action="<?= BASE_URL ?>index.php">
            <input type="hidden" name="route" value="/users">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-black mobile-nowrap align-middle">
            <thead>
                <tr>
                    <th scope="col">Usuário</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">status</th>
                    <th scope="col">Atendente</th>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <th scope="col" colspan="5">Ações</th>
                    <?php } else { ?>
                        <th scope="col">Ações</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $itemChamados = false;
                foreach ($chamados as $chamado) {
                    if (($chamado['id_user'] === $_SESSION['user']['id']) ||
                        ($_SESSION['user']['role'] === "admin")
                    ) {
                        $itemChamados = true;
                ?>

                        <tr>
                            <td class="chamado-name"><?= $chamado['user_name'] ?></td>
                            <td class="chamado-title"><?= $chamado['title_chamado']; ?></td>
                            <td class="chamado-desc text-justify"><?= $chamado['message_chamado']; ?></td>
                            <td class="chamado-atend"><?= $chamado['status_chamado']; ?></td>
                            <?php if (!$chamado['id_atendente']) { ?>
                                <td>Sem atendente</td>
                            <?php } else { ?>
                                <td><?= $chamado['atendente_name'] ?></td>
                            <?php } ?>
                            <?php if ($_SESSION['user']['role'] === "admin") {
                                if ($chamado['status_chamado'] == "Finalizado") { ?>
                                    <td class="text-center" colspan="3">
                                        <i class="fa-solid fa-eye text-primary fs-4"></i>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center">
                                        <i class="fa-solid fa-eye text-primary fs-4"></i>
                                    </td>
                                <?php } ?>

                                <!-- DESIGNAR ATENDENTE CASO NAO TENHA AINDA -->

                                <?php
                                if ($chamado['status_chamado'] != "Finalizado") {
                                    if (!$chamado['id_atendente']) { ?>
                                        <td class="text-center">
                                            <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#selectAtendente<?= $chamado['id_chamado']; ?>">
                                                <i class="fa-solid fa-hand-pointer text-black fs-4"></i>
                                            </button>
                                        </td>

                                        <!-- REDESIGNAR ATENDENTE CASO JA TENHA -->
                                    <?php } else { ?>
                                        <td class="text-center">
                                            <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#selectAtendente<?= $chamado['id_chamado']; ?>">
                                                <i class="fa-solid fa-arrows-rotate text-black fs-4"></i>
                                            </button>
                                        </td>
                                    <?php } ?>


                                    <td class="text-center">
                                        <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#endChamado<?= $chamado['id_chamado']; ?>">
                                            <i class="fa-solid fa-check text-success fs-4"></i>
                                        </button>

                                    </td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-pen-to-square text-warning fs-4"></i>
                                    </td>
                                <?php }
                                if ($chamado['status_chamado'] == "Finalizado") { ?>
                                    <td class="text-center" colspan="2">
                                        <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#deleteChamado<?= $chamado['id_chamado']; ?>">
                                            <i class="fa-solid fa-trash-can text-danger fs-4"></i>
                                        </button>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center">
                                        <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#deleteChamado<?= $chamado['id_chamado']; ?>">
                                            <i class="fa-solid fa-trash-can text-danger fs-4"></i>
                                        </button>
                                    </td>
                                <?php } ?>
                            <?php } else { ?>
                                <td class="text-center">
                                    <i class="fa-solid fa-eye text-primary fs-4 mt-1"></i>
                                </td>
                            <?php } ?>
                        </tr>

                <?php }
                } ?>

                <?php if ($itemChamados === false) { ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum chamado para exibir!</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <?php foreach ($chamados as $chamado) {
        require __DIR__ . "/../auth/selectAtendente.php";
        require __DIR__ . "/../auth/endChamado.php";
        require __DIR__ . "/../auth/deleteChamado.php";
    } ?>


    <nav aria-label="Page navigation example" class="align-self-center mt-3">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>