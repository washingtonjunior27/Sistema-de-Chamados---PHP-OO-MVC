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
                            <h5 class="card-title fs-1">12</h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Chamados Encerrados</div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">150</h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Usuários Ativos</div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">60</h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Chamados Hoje</div>
                        <div class="card-body">
                            <h5 class="card-title fs-1">27</h5>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide text-center">
                    <div class="card text-bg-primary mb-3 rounded-0" style=" min-height: 8rem;">
                        <div class="card-header fw-semibold">Melhor Atendente</div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <h5 class="card-title fs-5">washington.junior</h5>
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
        <table class="table table-bordered border-black text-nowrap">
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
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
                <tr>
                    <td>sarah.penafort</td>
                    <td>Problema Na Impressora</td>
                    <td>Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td>Aberto</td>
                    <td>Alta</td>
                    <td>A definir</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>