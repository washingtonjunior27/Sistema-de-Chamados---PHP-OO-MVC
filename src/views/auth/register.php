<div class="main-login vh-100 d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-between align-items-center rounded-3 bg-light gap-lg-2 p-4">
        <div class="container-right flex-fill">
            <div class="text-center">
                <h1 class="fw-bold mb-4">Cadastro</h1>
                <p class="text-black-50 mb-4">Crie uma conta para continuar</p>
            </div>
            <form action="/Sistema-de-Chamados/public/register.php" method="POST">

                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['error']);
                } ?>



                <div class="mb-3">
                    <label for="name" class="form-label">Nome completo</label>
                    <input type="text" class="form-control" name="name" placeholder="Digite seu nome completo">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Nome de Usuário</label>
                    <input type="text" class="form-control" name="username" placeholder="Digite seu nome de usuário (Login)">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="Digite sua senha">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Digite seu email">
                </div>
                <input type="hidden" name="role" value="user">
                <input type="hidden" name="status" value="1">
                <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Cadastrar</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-black-50">Já possui uma conta? <a href="/Sistema-de-Chamados/public/index.php" class="color-dark-blue">Faça login aqui</a></p>
            </div>
        </div>
        <div class="container-left p-5 d-lg-block col-md-6 d-none d-md-block">
            <img class="img-fluid" src="assets/img/undraw_authentication_1evl 1.png" alt="">
        </div>
    </div>
</div>