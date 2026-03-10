    <div class="container d-flex flex-column justify-content-center flex-fill">
        <h1 class="fw-bold mb-4 text-center">Abrir Chamado</h1>
        <form action="<?= BASE_URL ?>index.php?route=/OpenChamado" method="POST">

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <div class="mb-3">
                <label for="title_chamado" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="title_chamado" placeholder="Informe o titulo do chamado">
            </div>
            <div class="mb-3">
                <label for="priority_chamado" class="form-label">Prioridade</label>
                <select class="form-select" name="priority_chamado" id="Priority">
                    <option value="Urgente">Urgente</option>
                    <option value="Alta">Alta</option>
                    <option value="Média" selected>Media</option>
                    <option value="Baixa">Baixa</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message_chamado" class="form-label">Descrição</label>
                <textarea rows="5" class="form-control" name="message_chamado" placeholder="Informe a descrição do chamado"></textarea>
            </div>

            <input type="hidden" name="status_chamado" value="Aberto">
            <div class="d-flex gap-2">
                <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Salvar</button>
                <a href="<?= BASE_URL ?>index.php?route=/Chamados" type="submit" class="btn bg-danger w-100 rounded-5 py-2 text-light">Cancelar</a>
            </div>
        </form>
    </div>