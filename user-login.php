<?php
session_start();

if (isset($_SESSION['company_id'])) {
    $_SESSION['already_logged'] = true;
    header('location: employers/index.php');
} elseif (isset($_SESSION['user_id'])) {
    $_SESSION['already_logged'] = true;
    // You may redirect to a different location for users, e.g., 'users/index.php'
    header('location: users/index.php');
}
else
{ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-mQ93GR66o7D/EVEqUp0BqL45PQa24a6LZQ2Hb4cZ2z0x0vfFSzBvKv0ATs2DSh9efIt2uc5bBO1RoQ1HhehD5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  </head>
  <style>
    .navbar-nav .nav-link
    {
        color: white !important;
    }
    .navbar-brand
    {
        font-size: 29px;
        font-family: 'caveat', sans-serif;
        color: white !important;

    }
  </style>
  <!-----Navbar starts here----->
  <nav class="navbar navbar-expand-lg  bg-warning">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign-up.php">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
        <!----Login Form---->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <?php
                    if(isset($_SESSION['register_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hurray !</strong> Registration successful
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['register_success']);
                    }
                ?>
                 <?php
                    if(isset($_SESSION['wrong_details']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hey !</strong> Wrong Email or Password
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['wrong_details']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['empty_details']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Details cannot be empty
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['empty_details']);
                    }
                ?>
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <h5 class="text-muted">
                                Login Here !
                            </h5>
                        </div>
                        <div class="card-body my-5">
                            <form action="process/user-login-process.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="email"  name="email" class="form-control" placeholder=" e.g email@example.com">
                                    <label for="floatingInput">Email Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                <input type="password"  name="password" class="form-control" placeholder=" Enter Your Password">
                                    <label for="floatingInput">Password</label>
                                </div>
                                <input type="submit" name="login" value="Login" class="btn btn-outline-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
 <!----- Footer Section starts here----->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>  
<?php }
?>   