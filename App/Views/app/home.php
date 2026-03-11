<main class="container mt-5 flex-fill">

    <?php if ($_SESSION['user']['role'] === "user") { ?>
        <h3 class="fs-3 mb-5 text-center">Painel de Usuário</h3>
    <?php } elseif ($_SESSION['user']['role'] === "admin") { ?>
        <h3 class="fs-3 mb-5 text-center">Painel de Administrador</h3>
    <?php } else { ?>
        <h3 class="fs-3 mb-5 text-center">Painel de Atendente</h3>
    <?php } ?>

    <div class="cards-main">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide  text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Chamados em Aberto</div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">
                                <?php
                                $chamadosEmAberto = 0;
                                foreach ($chamados as $chamado) {
                                    if ((($chamado['id_user'] === $_SESSION['user']['id'])
                                            || ($_SESSION['user']['role'] === "admin"))
                                        && ($chamado['status_chamado'] != "Finalizado")
                                    ) {
                                        $chamadosEmAberto++;
                                    }
                                }
                                echo $chamadosEmAberto;
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Chamados Encerrados</div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">
                                <?php
                                $chamadosEmAberto = 0;
                                foreach ($chamados as $chamado) {
                                    if ((($chamado['id_user'] === $_SESSION['user']['id'])
                                            || ($_SESSION['user']['role'] === "admin"))
                                        && ($chamado['status_chamado'] === "Finalizado")
                                    ) {
                                        $chamadosEmAberto++;
                                    }
                                }
                                echo $chamadosEmAberto;
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Usuários Ativos</div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">
                                <?php
                                $activeUsers = 0;
                                foreach ($users as $user) {
                                    if ($user['status'] == 1) {
                                        $activeUsers++;
                                    }
                                }
                                echo $activeUsers;
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">
                            <?php if ($_SESSION['user']['role'] === "admin") { ?>
                                Chamados Hoje (Totais)
                            <?php } else { ?>
                                Chamados Hoje
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">
                                <?php
                                $chamadosHoje = 0;
                                $hoje = date("Y-m-d");
                                foreach ($chamados as $chamado) {
                                    if ((($chamado['id_user'] === $_SESSION['user']['id']) || ($_SESSION['user']['role'] === "admin"))
                                        && (substr($chamado['created_at'], 0, 10) === $hoje)
                                    ) {
                                        $chamadosHoje++;
                                    }
                                }
                                echo $chamadosHoje;
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="last-call mt-5 mb-5">
        <h2 class="text-dark fs-6 fw-bold">Ultimos Chamados</h2>
    </div>

    <div class="table-responsive mb-5">
        <table class="table table-bordered border-black mobile-nowrap align-middle">
            <thead>
                <tr>
                    <th scope="col">Usuário</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col">Prioridade</th>
                    <th scope="col">Atendente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chamados as $chamado) { ?>
                    <tr>
                        <td><?= $chamado['user_name'] ?></td>
                        <td><?= $chamado['title_chamado'] ?></td>
                        <td class="chamado-desc text-justify"><?= $chamado['message_chamado'] ?></td>
                        <td><?= $chamado['status_chamado'] ?></td>
                        <td><?= $chamado['priority_chamado'] ?></td>

                        <?php if ($chamado['atendente_name'] === NULL) { ?>
                            <td>À definir</td>
                        <?php } else { ?>
                            <td><?= $chamado['atendente_name'] ?></td>
                        <?php } ?>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</main>