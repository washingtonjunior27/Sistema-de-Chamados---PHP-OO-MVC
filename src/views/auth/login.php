<div class="main-login min-vh-100 d-flex justify-content-center align-items-center p-4">
    <div class="container d-flex justify-content-between align-items-center rounded-3 bg-light gap-lg-2 p-4">
        <div class="container-left p-5 d-lg-block col-md-6 d-none d-md-block">
            <img class="img-fluid" src="assets/img/undraw_maintenance_4unj 1.png" alt="">
        </div>
        <div class="container-right flex-fill">
            <div class="text-center">
                <h1 class="fw-bold mb-4">LOGIN</h1>
                <p class="text-black-50 mb-4">Por favor informe seu login e senha</p>
            </div>
            <form action="/sistema-de-chamados/public/index.php" method="POST">

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

                <div class="mb-3">
                    <label for="username" class="form-label">Nome de Usuário</label>
                    <input type="text" class="form-control" name="username" placeholder="Digite seu nome de usuário (Login)">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="Digite sua senha">
                </div>
                <div class="mb-3 d-flex align-items-end justify-content-end">
                    <a href="#" class="color-dark-blue">Esqueceu sua senha?</a>
                </div>
                <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Entrar</button>
            </form>
            <h4 id="login-separate" class="d-flex align-items-center justify-content-center gap-2 my-4">OU</h4>
            <button type="submit"
                class="btn bg-dark-blue w-100 rounded-5 py-2 text-light d-flex align-items-center justify-content-center gap-2">
                <i class="fa-brands fa-google fs-3"></i> Continuar com google
            </button>
            <div class="text-center mt-4">
                <p class="text-black-50">Não possui uma conta?<a href="/Sistema-de-Chamados/public/register.php" class="color-dark-blue">
                        Cadastre-se?</a></p>
            </div>
        </div>
    </div>
</div>