<!-- Modal -->
<div class="modal fade" id="deleteChamado<?= $chamado['id_chamado'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Chamado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mt-3">Tem certeza que deseja excluir esse chamado??</p>
            </div>
            <form class="modal-footer" action="<?= BASE_URL ?>index.php?route=/Chamados" method="POST">
                <input type="hidden" name="action" value="deleteChamado">
                <input type="hidden" name="id_chamado" value="<?= $chamado['id_chamado'] ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
</div>