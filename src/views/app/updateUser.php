<?php require __DIR__ . "/../app/deleteUser.php" ?>

<div class="container d-flex flex-fill justify-content-between align-items-center rounded-3 gap-lg-2 p-4">
    <div class="container-right flex-fill">
        <div class="text-center">
            <h1 class="fw-bold mb-4">Atualizar</h1>
            <p class="text-black-50 mb-4">Atualize seus dados abaixo</p>
        </div>
        <form action="/Sistema-de-Chamados/public/updateUser.php" method="POST">

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <input type="hidden" name="action" value="updateUser">
            <input type="hidden" name="user_id" value="<?= $dbUser['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nome completo</label>
                <input type="text" class="form-control" name="name" placeholder="Digite seu nome completo" value="<?= $dbUser['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" name="username" placeholder="Digite seu nome de usuário (Login)" value="<?= $dbUser['username']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Digite sua senha">
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Digite seu email" value="<?= $dbUser['email']; ?>">
            </div>
            <div class="d-flex gap-2 mt-5 mb-4">
                <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Atualizar</button>
                <a href="/sistema-de-chamados/public/home.php" type="submit" class="btn bg-dark w-100 rounded-5 py-2 text-light">Voltar</a>
            </div>
        </form>

        <!-- Button trigger modal Delete -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Excluir conta
        </button>
    </div>
</div>