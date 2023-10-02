<?php 

include('assets/header.php'); 

?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
                 <?php
                    if(isset($_SESSION['register'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hurray ! </strong> Successfully Registered.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['register']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['login_error'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Invalid credentials .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['login_error']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['details'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Fill All Details .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['details']);
                    }
                ?>
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center">
                        Login Here !
                    </h3>
                </div>
                <div class="card-body">
                     <form action="process/login-process.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" name="user_name" class="form-control" placeholder=" e.g James">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"  placeholder=" Type in your Password">
                        </div>
                        <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
                        <p>Don't Have An Account?</p>
                        <a href="register.php"> Register Here</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('assets/footer.php'); ?>