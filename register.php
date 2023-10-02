<?php 


include('assets/header.php'); 

?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
                 <?php
                    if(isset($_SESSION['details'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Details cannot be empty .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['details']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['username'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Similar Username Exists ! 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['username']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['username'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Similar Username Exists ! 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['username']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['email'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Similar Email Exists ! 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['email']);
                    }
                ?>
               

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center">
                       Register Here !
                    </h3>
                </div>
                <div class="card-body">
                     <form action="process/register-process.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" name="user_name" class="form-control" placeholder=" e.g Jamiey">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder=" e.g info@mail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder=" e.g 0711223344">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder=" Type in your Password">
                        </div>
                        <button type="submit" name="register" class="btn btn-outline-primary">Submit</button>
                        <p>Already Have An Account?</p>
                        <a href="login.php"> Login Here</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('assets/footer.php'); ?>