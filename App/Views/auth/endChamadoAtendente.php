<!-- Modal -->
<div class="modal fade" id="endChamadoAtendente<?= $chamado['id_chamado'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Chamado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mt-3">Tem certeza que deseja finalizar esse chamado??</p>
            </div>
            <form class="modal-footer" action="<?= BASE_URL ?>index.php?route=/Atendimentos" method="POST">
                <input type="hidden" name="action" value="endChamadoAtendente">
                <input type="hidden" name="id_chamado" value="<?= $chamado['id_chamado'] ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Finalizar</button>
            </form>
        </div>
    </div>
</div>