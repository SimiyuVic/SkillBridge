
<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
        <!---Navigatiob Bar Starts-->
        <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand fw-bold text-light" href="index.php">Skill-Bridge</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="index.php">Log In</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


    <!---Navigatiob Bar Ends Here-->

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
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
                    if(isset($_SESSION['no-login'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey ! </strong> You have to Login first !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['no-login']);
                    }
                ?>
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center">
                       Admin Login  !
                    </h3>
                </div>
                <div class="card-body">
                     <form action="process/process-login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Enter Email</label>
                            <input type="email" name="email" class="form-control" placeholder=" Email *" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"  placeholder=" Password * " required>
                        </div>
                        <input type="submit" name="login" class="btn btn-outline-primary" value="Log In">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

