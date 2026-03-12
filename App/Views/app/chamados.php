<div class="container flex-fill d-flex flex-column justify-content-center gap-4">
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
        <a href="<?= BASE_URL ?>index.php?route=/OpenChamado" class="btn btn-primary">Abrir Chamado</a>
        <form class="d-flex flex-fill" method="GET" action="<?= BASE_URL ?>index.php">
            <input type="hidden" name="route" value="/Chamados">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-black mobile-nowrap align-middle">
            <thead>
                <tr>
                    <th scope="col">Ver</th>
                    <?php if ($_SESSION['user']['role'] != "user") { ?>
                        <th scope="col">Atender</th>
                    <?php } ?>
                    <th scope="col">Usuário</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Status</th>
                    <th scope="col">Prioridade</th>
                    <th scope="col">Atendente</th>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <th scope="col" colspan="3">Ações</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $itemChamados = false;
                foreach ($chamados as $chamado) {
                    if ((($chamado['id_user'] === $_SESSION['user']['id']) || ($_SESSION['user']['role'] === "admin")) ||
                        (($_SESSION['user']['role'] === "atendente") && ($chamado['status_chamado'] === "Aberto"))
                    ) {
                        $itemChamados = true;
                ?>

                        <tr>
                            <td class="text-center">
                                <a href="<?= BASE_URL ?>index.php?route=/ViewChamado&id_chamado=<?= $chamado['id_chamado'] ?>&from=Chamados" type="submit" class="btn p-0 btn-link text-success">
                                    <i class="fa-solid fa-eye text-primary fs-4"></i>
                                </a>
                            </td>

                            <?php if (($_SESSION['user']['role'] != "user" && $chamado['status_chamado'] === "Aberto")
                                && ($_SESSION['user']['id'] != $chamado['id_user'])
                            ) { ?>
                                <td class="text-center">
                                    <button type="button" class="btn p-0 btn-link text-primary" data-bs-toggle="modal" data-bs-target="#responseChamado<?= $chamado['id_chamado']; ?>">
                                        <i class="fa-solid fa-message fs-4"></i>
                                    </button>
                                </td>
                            <?php } elseif ($_SESSION['user']['role'] != "user") { ?>
                                <td class="text-center">
                                    <i class="fa-solid fa-message text-secondary fs-4"></i>
                                </td>
                            <?php } ?>

                            <td class="chamado-name"><?= htmlspecialchars($chamado['user_name']) ?></td>
                            <td class="chamado-title"><?= htmlspecialchars($chamado['title_chamado']); ?></td>
                            <td class="chamado-desc text-justify"><?= htmlspecialchars($chamado['message_chamado']); ?></td>
                            <td class="chamado-atend"><?= htmlspecialchars($chamado['status_chamado']); ?></td>
                            <td class="chamado-atend"><?= htmlspecialchars($chamado['priority_chamado']); ?></td>
                            <?php if (!$chamado['id_atendente']) { ?>
                                <td>À definir</td>
                            <?php } else { ?>
                                <td><?= htmlspecialchars($chamado['atendente_name']) ?></td>
                            <?php } ?>

                            <!-- AÇÕES -->
                            <?php if (($_SESSION['user']['role'] === "admin") && ($chamado['status_chamado'] != "Finalizado")) { ?>
                                <!-- FINALIZAR CHAMADO-->
                                <td class="text-center">
                                    <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#endChamado<?= $chamado['id_chamado']; ?>">
                                        <i class="fa-solid fa-check text-success fs-4"></i>
                                    </button>
                                </td>
                            <?php } ?>

                            <?php if ($_SESSION['user']['role'] === "admin") {
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



                                <?php }
                                if ($chamado['status_chamado'] == "Finalizado") { ?>
                                    <td class="text-center" colspan="3">
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
                            <?php } ?>
                        </tr>

                <?php }
                } ?>

                <?php if ($itemChamados === false) { ?>
                    <tr>
                        <td colspan="8" class="text-center">Nenhum chamado para exibir!</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <?php foreach ($chamados as $chamado) {
        require __DIR__ . "/../auth/selectAtendente.php";
        require __DIR__ . "/../auth/responseChamado.php";
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