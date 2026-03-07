<div class="container flex-fill d-flex flex-column justify-content-center gap-5">
    <h3 class="fs-3 text-center">Usuários</h3>

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

    <form class="d-flex" method="GET" action="<?= BASE_URL ?>index.php">
        <input type="hidden" name="route" value="/users">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered border-black text-nowrap">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Login</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col" colspan="3">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (count($users) > 0) {
                    foreach ($users as $user) {
                ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>


                            <?php if ($user['status'] == 1) { ?>
                                <td>Ativo</td>



                                <!-- DESATIVAR USUARIO - SE FOR ADMIN DESABILITADO -->
                                <?php if ($user['role'] === "admin") { ?>
                                    <td class="text-center">
                                        <i class="fa-solid fa-pen-to-square text-secondary fs-4 mt-1"></i>
                                    </td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-ban fs-4 text-secondary mt-1"></i>
                                    </td>
                                    <!-- DESATIVAR USUARIO - SE FOR ATENDENTE OU USUARIO É HABILITADO -->
                                <?php } else { ?>
                                    <!-- EDITAR USUARIO -->
                                    <td class="text-center  fs-4">
                                        <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#editUserAdmin<?= $user['id']; ?>">
                                            <i class="fa-solid fa-pen-to-square text-warning fs-4"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn p-0 btn-link text-danger" data-bs-toggle="modal" data-bs-target="#disableUser<?= $user['id']; ?>">
                                            <i class="fa-solid fa-ban fs-4 mt-1"></i>
                                        </button>
                                    </td>
                                <?php } ?>


                            <?php } else { ?>
                                <td>Desativado</td>

                                <!-- EDITAR USUARIO -->
                                <td class="text-center  fs-4">
                                    <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#editUserAdmin<?= $user['id']; ?>">
                                        <i class="fa-solid fa-pen-to-square text-warning fs-4"></i>
                                    </button>
                                </td>

                                <!-- REATIVAR USUARIO -->
                                <td class="text-center">
                                    <button type="button" class="btn p-0 btn-link text-success" data-bs-toggle="modal" data-bs-target="#enableUser<?= $user['id']; ?>">
                                        <i class="fa-solid fa-user-check fs-4 mt-1"></i>
                                    </button>
                                </td>
                        <?php }
                        }
                    } else { ?>
                        <td colspan="7" class="text-center">Nenhum usuário encontrado!</td>
                    <?php } ?>
                        </tr>
            </tbody>
        </table>
    </div>

    <?php foreach ($users as $user) {
        require __DIR__ . "/../auth/disableUserAdmin.php";
        require __DIR__ . "/../auth/enableUserAdmin.php";
        require __DIR__ . "/../auth/editUserAdmin.php";
    } ?>


    <nav aria-label="Page navigation example" class="align-self-center">
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