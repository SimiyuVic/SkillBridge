<?php
session_start();


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    
 
  <div class="container my-5">
 
        <div class="row justify-content-center">
      
            <div class="col-md-6">
                <div class="card shadow">
                <?php
                    if(isset($_SESSION['success_message'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hurray ! </strong> Account Created Successfully .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['success_message']);
                    }
                ?>
                 <?php
                    if(isset($_SESSION['login'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Details cannot Be Empty .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['login']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['login_error'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> Invalid Credentials.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['login_error']);
                    }
                ?>
                    <div class="card-header">
                        <h3 class="text-center">Login Here !</h3>
                    </div>
                    <div class="card-body">
                         <form action="process/login-process.php" method="POST">
                         <div class="mb-3">
                                <label  class="form-label">User Name</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter your name e.g James">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Input your Password">
                            </div>
                            <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>