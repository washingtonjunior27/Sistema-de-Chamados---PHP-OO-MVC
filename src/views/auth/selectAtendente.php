<!-- Modal -->
<div class="modal fade" id="selectAtendente<?= $chamado['id_chamado'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Selecionar Atendente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>index.php?route=/Chamados" method="POST">
                    <div class="mb-4">
                        <input type="hidden" name="action" value="selectAtendente">
                        <input type="hidden" name="id_chamado" value="<?= $chamado['id_chamado'] ?>">
                        <label for="role" class="form-label">Atendente</label>
                        <select class="form-select" name="atendente_chamado" id="role">
                            <?php
                            foreach ($atendentes as $atendente) {
                                if ($chamado['id_atendente'] === $atendente['id']) { ?>
                                    <option value="<?= $atendente['id'] ?>" selected><?= $atendente['name'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $atendente['id'] ?>"><?= $atendente['name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="d-flex gap-2 mt-5 mb-4">
                        <button type="submit" class="btn bg-warning py-2 text-dark">Atualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>