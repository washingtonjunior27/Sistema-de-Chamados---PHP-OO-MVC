<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Conta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-7">Tem certeza que deseja excluir sua conta??</h3>
            </div>
            <form class="modal-footer" action="/sistema-de-chamados/public/updateUser.php" method="POST">
                <input type="hidden" name="action" value="deleteUser">
                <input type="hidden" name="user_id" value="<?= $dbUser['id'] ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
</div>