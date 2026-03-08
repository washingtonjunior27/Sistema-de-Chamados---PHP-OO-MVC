<div class="container flex-fill d-flex flex-column justify-content-center">
    <h3 class="fs-3 text-center mb-5">Chamados</h3>

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
        <a href="" class="btn btn-primary">Abrir Chamado</a>
        <form class="d-flex flex-fill" method="GET" action="<?= BASE_URL ?>index.php">
            <input type="hidden" name="route" value="/users">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-black mobile-nowrap">
            <thead>
                <tr>
                    <th scope="col">Usuário</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">status</th>
                    <th scope="col">Atendente</th>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <th scope="col" colspan="5">Ações</th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>

                <!--  -->
                <tr>
                    <td>washington.junior</td>
                    <td class="chamado-title">Problema na Impressora</td>
                    <td class="chamado-desc text-justify">Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td class="chamado-atend">Em atendimento</td>
                    <td>sarah.penafort</td>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <td class="text-center">
                            <i class="fa-solid fa-eye text-primary fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-hand-pointer text-black fs-4 mt-1"></i>
                        </td>
                        <!-- <td class="text-center">
                            <i class="fa-solid fa-arrows-rotate text-black fs-4 mt-1"></i>
                        </td> -->
                        <td class="text-center">
                            <i class="fa-solid fa-check text-success fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-pen-to-square text-warning fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash-can text-danger fs-4 mt-1"></i>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>washington.junior</td>
                    <td class="chamado-title">Problema na Impressora</td>
                    <td class="chamado-desc text-justify">Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td class="chamado-atend">Em atendimento</td>
                    <td>sarah.penafort</td>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <td class="text-center">
                            <i class="fa-solid fa-eye text-primary fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-hand-pointer text-black fs-4 mt-1"></i>
                        </td>
                        <!-- <td class="text-center">
                            <i class="fa-solid fa-arrows-rotate text-black fs-4 mt-1"></i>
                        </td> -->
                        <td class="text-center">
                            <i class="fa-solid fa-check text-success fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-pen-to-square text-warning fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash-can text-danger fs-4 mt-1"></i>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>washington.junior</td>
                    <td class="chamado-title">Problema na Impressora</td>
                    <td class="chamado-desc text-justify">Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td class="chamado-atend">Em atendimento</td>
                    <td>sarah.penafort</td>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <td class="text-center">
                            <i class="fa-solid fa-eye text-primary fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-hand-pointer text-black fs-4 mt-1"></i>
                        </td>
                        <!-- <td class="text-center">
                            <i class="fa-solid fa-arrows-rotate text-black fs-4 mt-1"></i>
                        </td> -->
                        <td class="text-center">
                            <i class="fa-solid fa-check text-success fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-pen-to-square text-warning fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash-can text-danger fs-4 mt-1"></i>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>washington.junior</td>
                    <td class="chamado-title">Problema na Impressora</td>
                    <td class="chamado-desc text-justify">Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td class="chamado-atend">Em atendimento</td>
                    <td>sarah.penafort</td>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <td class="text-center">
                            <i class="fa-solid fa-eye text-primary fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-hand-pointer text-black fs-4 mt-1"></i>
                        </td>
                        <!-- <td class="text-center">
                            <i class="fa-solid fa-arrows-rotate text-black fs-4 mt-1"></i>
                        </td> -->
                        <td class="text-center">
                            <i class="fa-solid fa-check text-success fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-pen-to-square text-warning fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash-can text-danger fs-4 mt-1"></i>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>washington.junior</td>
                    <td class="chamado-title">Problema na Impressora</td>
                    <td class="chamado-desc text-justify">Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime Estou tentando Imprimir mas o Papel está travanado e não imprime</td>
                    <td class="chamado-atend">Em atendimento</td>
                    <td>sarah.penafort</td>
                    <?php if ($_SESSION['user']['role'] === "admin") { ?>
                        <td class="text-center">
                            <i class="fa-solid fa-eye text-primary fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-hand-pointer text-black fs-4 mt-1"></i>
                        </td>
                        <!-- <td class="text-center">
                            <i class="fa-solid fa-arrows-rotate text-black fs-4 mt-1"></i>
                        </td> -->
                        <td class="text-center">
                            <i class="fa-solid fa-check text-success fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-pen-to-square text-warning fs-4 mt-1"></i>
                        </td>
                        <td class="text-center">
                            <i class="fa-solid fa-trash-can text-danger fs-4 mt-1"></i>
                        </td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>


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