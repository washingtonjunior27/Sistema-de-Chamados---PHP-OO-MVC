<div class="main-login min-vh-100 d-flex justify-content-center align-items-center p-4">
    <div class="container d-flex justify-content-between align-items-center rounded-3 bg-light gap-lg-2 p-4">
        <div class="container-left p-5 d-lg-block col-md-6 d-none d-md-block">
            <img class="img-fluid" src="assets/img/undraw_maintenance_4unj 1.png" alt="">
        </div>
        <div class="container-right flex-fill">
            <div class="text-center">
                <h1 class="fw-bold mb-4">LOGIN</h1>
                <p class="text-black-50 mb-4">Please login your account</p>
            </div>
            <form>

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
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your username">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div>
                <div class="mb-3 d-flex align-items-end justify-content-end">
                    <a href="#" class="color-dark-blue">Forgot your password?</a>
                </div>
                <button type="submit" class="btn bg-dark-blue w-100 rounded-5 py-2 text-light">Sign In</button>
            </form>
            <h4 id="login-separate" class="d-flex align-items-center justify-content-center gap-2 my-4">OR</h4>
            <button type="submit"
                class="btn bg-dark-blue w-100 rounded-5 py-2 text-light d-flex align-items-center justify-content-center gap-2">
                <i class="fa-brands fa-google fs-3"></i> Continue with google
            </button>
            <div class="text-center mt-4">
                <p class="text-black-50">Didn’t have an account?<a href="/Sistema-de-Chamados/public/register.php" class="color-dark-blue">
                        Sign In?</a></p>
            </div>
        </div>
    </div>
</div>