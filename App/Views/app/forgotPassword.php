<div class="main-login min-vh-100 d-flex justify-content-center align-items-center p-4">
    <div class="container d-flex flex-column rounded-3 bg-light gap-lg-2 p-4 col-12 col-sm-10 col-md-7 col-lg-6 col-xl-5">
        <div class="text-center">
            <h1 class="fw-bold mb-4">Esqueceu sua senha?</h1>
            <p class="text-black-50 mb-4">Por favor informe seu email</p>
        </div>
        <form action="<?= BASE_URL ?>index.php?route=/ForgotPassword" method="POST">

            <?php if (isset($_SESSION['sucess'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['sucess']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['sucess']);
            } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['error']);
            } ?>

            <div class="mb-3 w-100">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Digite seu email">
            </div>
            <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Enviar</button>
        </form>
        <div class="text-center mt-4">
            <p class="text-black-50">Não possui uma conta?<a href="<?= BASE_URL ?>index.php?route=/Register" class="color-dark-blue">
                    Cadastre-se?</a></p>
        </div>
        <div class="text-center">
            <p class="text-black-50">Ja possui uma conta?<a href="<?= BASE_URL ?>index.php?route=/Login" class="color-dark-blue">
                    Fazer login?</a></p>
        </div>
    </div>
</div>