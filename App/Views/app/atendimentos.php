<div class="container flex-fill d-flex flex-column justify-content-center gap-4">
    <h3 class="fs-3 text-center mb-5 mt-3">Atendimentos</h3>

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

    <div class="search-form  d-flex justify-content-between align-items-center gap-4 mb-4">
        <form class="d-flex flex-fill flex-column gap-3" method="GET" action="<?= BASE_URL ?>index.php">
            <input type="hidden" name="route" value="/Atendimentos">
            <div class="search d-flex">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </div>

            <div class="filters d-flex gap-3">
                <div class="status">
                    <label for="status_chamado" class="form-label">Status</label>
                    <select class="form-select" name="status_chamado" onchange="this.form.submit()">
                        <option value="">Selecionar</option>
                        <?php
                        $statusChamado = $_GET['status_chamado'] ?? ""; ?>
                        <option value="Em atendimento" <?= $statusChamado === "Em atendimento" ? "selected" : "" ?>>Em atendimento</option>
                        <option value="Finalizado" <?= $statusChamado === "Finalizado" ? "selected" : "" ?>>Finalizado</option>
                    </select>
                </div>

                <div class="priority">
                    <label for="priority_chamado" class="form-label">Prioridade</label>
                    <select class="form-select" name="priority_chamado" onchange="this.form.submit()">
                        <option value="">Selecionar</option>
                        <?php
                        $priorityChamado = $_GET['priority_chamado'] ?? ""; ?>
                        <option value="Urgente" <?= $priorityChamado === "Urgente" ? "selected" : "" ?>>Urgente</option>
                        <option value="Alta" <?= $priorityChamado === "Alta" ? "selected" : "" ?>>Alta</option>
                        <option value="Média" <?= $priorityChamado === "Média" ? "selected" : "" ?>>Média</option>
                        <option value="Baixa" <?= $priorityChamado === "Baixa" ? "selected" : "" ?>>Baixa</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-black mobile-nowrap align-middle">
            <thead>
                <tr>
                    <th scope="col">Ver</th>
                    <th scope="col">Finalizar</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Status</th>
                    <th scope="col">Prioridade</th>
                    <th scope="col">Atendente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $itemChamados = false;
                foreach ($chamados as $chamado) {
                    $itemChamados = true;
                ?>

                    <tr>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>index.php?route=/ViewChamado&id_chamado=<?= $chamado['id_chamado'] ?>&from=Atendimentos" type="submit" class="btn p-0 btn-link text-success">
                                <i class="fa-solid fa-eye text-primary fs-4"></i>
                            </a>
                        </td>

                        <?php if ($chamado['status_chamado'] === "Finalizado") { ?>
                            <td class="text-center"><i class="fa-solid fa-check text-secondary fs-4"></i></td>
                        <?php } else { ?>
                            <td class="text-center">
                                <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#endChamadoAtendente<?= $chamado['id_chamado']; ?>">
                                    <i class="fa-solid fa-check text-success fs-4"></i>
                                </button>
                            </td>
                        <?php } ?>

                        <td class="chamado-name"><?= htmlspecialchars($chamado['user_name']) ?></td>
                        <td class="chamado-title"><?= htmlspecialchars($chamado['title_chamado']) ?></td>
                        <td class="chamado-desc text-justify"><?= htmlspecialchars($chamado['message_chamado']); ?></td>
                        <td class="chamado-atend"><?= htmlspecialchars($chamado['status_chamado']); ?></td>
                        <td class="chamado-atend"><?= htmlspecialchars($chamado['priority_chamado']); ?></td>
                        <?php if (!$chamado['id_atendente']) { ?>
                            <td>À definir</td>
                        <?php } else { ?>
                            <td><?= htmlspecialchars($chamado['atendente_name']) ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>

                <?php if ($itemChamados === false) { ?>
                    <tr>
                        <td colspan="8" class="text-center">Nenhum chamado para exibir!</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <?php foreach ($chamados as $chamado) {
        require __DIR__ . "/../auth/endChamadoAtendente.php";
    } ?>


    <nav aria-label="Page navigation example" class="align-self-center mt-3">
        <ul class="pagination">
            <?php
            $query = $_GET;
            $range = 2;

            $start = max(1, $page - $range);
            $end = min($totalPages, $page + $range); ?>

            <?php if ($page > 1) {
                $query['page'] = $page - 1; ?>
                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL ?>index.php?<?= http_build_query($query) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php } ?>


            <?php for ($i = $start; $i <= $end; $i++) {
                $query['page'] = $i ?>

                <li class="page-item <?= $i == $page ? "active" : "" ?>">
                    <a class="page-link" href="?<?= http_build_query($query) ?>"><?= $i ?></a>
                </li>

            <?php } ?>

            <?php if ($page < $totalPages) {
                $query['page'] = $page + 1; ?>

                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL ?>index.php?<?= http_build_query($query) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>