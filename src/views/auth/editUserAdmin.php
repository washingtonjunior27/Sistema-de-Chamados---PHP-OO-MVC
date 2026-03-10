<!-- Modal -->
<div class="modal fade" id="editUserAdmin<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Dados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>index.php?route=/Users" method="POST">
                    <input type="hidden" name="action" value="editUserAdmin">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" name="name" placeholder="Digite seu nome completo" value="<?= $user['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome de Usuário</label>
                        <input type="text" class="form-control" name="username" placeholder="Digite seu nome de usuário (Login)" value="<?= $user['username']; ?>">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Digite seu email" value="<?= $user['email']; ?>">
                    </div>
                    <div class="mb-4">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" name="role" id="role">
                            <option value="admin" <?= $user['role'] === "admin" ? "selected" : "" ?>>Admin</option>
                            <option value="atendente" <?= $user['role'] === "atendente" ? "selected" : "" ?>>Atendente</option>
                            <option value="user" <?= $user['role'] === "user" ? "selected" : "" ?>>User</option>
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