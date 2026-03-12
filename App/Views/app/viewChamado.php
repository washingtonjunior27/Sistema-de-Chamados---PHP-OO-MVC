<div class="container d-flex flex-column justify-content-start flex-fill gap-3 py-3 ">
    <!-- mensagem de erro -->
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['error']);
    } ?>

    <!-- Mensagem de sucesso -->
    <?php if (isset($_SESSION['sucess'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['sucess']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['sucess']);
    } ?>
    <a href="<?= BASE_URL . $pageRedirect ?>" type="submit" class="btn btn-group align-self-start rounded-5 py-2 text-light bg-danger">Voltar</a>

    <!-- INICIO DO CHAMADO -->
    <form class="align-self-start w-50 bg-dark-blue p-2 rounded text-light">
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="title_chamado" class="form-label">Titulo</label>
                <span><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($chamado['created_at']))) ?></span>
            </div>
            <input disabled value="<?= htmlspecialchars($chamado['title_chamado']) ?>" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label for="message_chamado" class="form-label">Descrição</label>
            <textarea disabled rows="3" class="form-control"><?= htmlspecialchars($chamado['message_chamado']) ?></textarea>
        </div>
    </form>

    <!-- RESPOSTA DO ATENDENTE -->
    <?php if ($respostas) {
        foreach ($respostas as $resposta) {
            if ($chamado['id_user'] === $resposta['id_user']) { ?>
                <form class="align-self-start w-50 bg-dark-blue p-2 rounded text-light">
                <?php } else { ?>
                    <form class="align-self-end w-50 bg-dark-blue p-2 rounded text-light">
                    <?php } ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="message_chamado" class="form-label">Respondido por <?= $resposta['user_name'] ?></label>
                            <span><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($resposta['date_resposta']))) ?></span>
                        </div>
                        <textarea disabled rows="3" class="form-control"><?= htmlspecialchars($resposta['message_resposta']) ?></textarea>
                    </div>
                    </form>
            <?php }
    } ?>

            <!-- NOVA RESPOSTA DO USUARIO -->
            <?php if ($chamado['status_chamado'] != "Finalizado") { ?>
                <form action="<?= BASE_URL ?>index.php?route=/Respostas" method="POST">
                    <input type="hidden" name="id_chamado" value="<?= $chamado['id_chamado']; ?>">
                    <input type="hidden" name="from" value="<?= htmlspecialchars($action) ?>">
                    <div class="mb-3">
                        <label for="message_chamado" class="form-label">Responder</label>
                        <textarea rows="5" class="form-control" name="message_chamado" placeholder="Responder chamado"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Responder</button>
                    </div>
                </form>
            <?php } ?>
</div>