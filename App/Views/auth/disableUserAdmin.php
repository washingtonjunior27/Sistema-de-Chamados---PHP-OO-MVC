<!-- Modal -->
<div class="modal fade" id="disableUser<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Desativar Conta de Usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mt-3">Tem certeza que deseja desativar a conta do usuario <?= $user['username'] ?>?</p>
            </div>
            <form class="modal-footer" action="<?= BASE_URL ?>index.php?route=/Users" method="POST">
                <input type="hidden" name="action" value="disableUserAdmin">
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Desativar</button>
            </form>
        </div>
    </div>
</div>