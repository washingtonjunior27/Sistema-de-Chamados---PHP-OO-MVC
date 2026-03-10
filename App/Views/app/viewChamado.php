<div class="container d-flex flex-column justify-content-start flex-fill gap-3 py-3 ">
    <a href="<?= BASE_URL . $pageRedirect ?>" type="submit" class="btn btn-group align-self-start rounded-5 py-2 text-light bg-danger">Voltar</a>

    <!-- INICIO DO CHAMADO -->
    <form class="align-self-start w-50 bg-dark-blue p-2 rounded text-light">
        <div class="mb-3">
            <label for="title_chamado" class="form-label">Titulo</label>
            <input disabled value="<?= $result['title_chamado'] ?>" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label for="message_chamado" class="form-label">Descrição</label>
            <textarea disabled rows="3" class="form-control"><?= $result['message_chamado'] ?></textarea>
        </div>
    </form>

    <!-- RESPOSTA DO ATENDENTE -->
    <form action="<?= BASE_URL ?>index.php?route=/ViewChamado" method="POST" class="align-self-end w-50 bg-dark-blue p-2 rounded text-light">
        <div class="mb-3">
            <label for="message_chamado" class="form-label">Respondido por <?= $result['atendente_name'] ?></label>
            <textarea disabled rows="3" class="form-control"><?= $result['message_chamado'] ?></textarea>
        </div>
    </form>

    <?php if ($result['status_chamado'] != "Finalizado") { ?>
        <!-- NOVA RESPOSTA DO USUARIO -->
        <form action="<?= BASE_URL ?>index.php?route=/ViewChamado" method="POST">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <div class="mb-3">
                <label for="message_chamado" class="form-label">Responder</label>
                <textarea rows="5" class="form-control" name="message_chamado" placeholder="Acrescente informações ao chamado"></textarea>
            </div>

            <input type="hidden" name="status_chamado" value="aberto">
            <div class="d-flex gap-2">
                <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Responder</button>
            </div>
        </form>
    <?php } ?>
</div>