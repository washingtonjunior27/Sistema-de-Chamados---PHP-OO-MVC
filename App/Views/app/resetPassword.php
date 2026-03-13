<div class="main-login min-vh-100 d-flex justify-content-center align-items-center p-4">
    <div class="container d-flex flex-column rounded-3 bg-light gap-lg-2 p-4 col-12 col-sm-10 col-md-7 col-lg-6 col-xl-5">
        <div class="text-center">
            <h1 class="fw-bold mb-4">Resetar Senha</h1>
            <p class="text-black-50 mb-4">Por favor informe sua nova senha</p>
        </div>
        <form action="<?= BASE_URL ?>index.php?route=/ResetPassword" method="POST">

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">
            <div class="mb-3 w-100">
                <label for="reset_password" class="form-label">Senha</label>
                <input type="password" class="form-control" name="reset_password" placeholder="Digite sua nova senha">
            </div>
            <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Enviar</button>
        </form>
    </div>
</div>