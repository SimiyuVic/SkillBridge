<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
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
        <!-----Login Cards--->
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <?php
                            if (isset($_SESSION['must_login'])) { 
                        ?>
                                <div id="login-alert" class="alert alert-danger" role="alert">
                                    You have to Login or Register First before accessing the page requested!
                                </div>

                                <script>
                                    // JavaScript code to fade out the alert after 5 seconds
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var loginAlert = document.getElementById('login-alert');

                                        // Add 'fade' class after a short delay to trigger the fade effect
                                        setTimeout(function() {
                                            loginAlert.style.transition = 'opacity 3s';
                                            loginAlert.style.opacity = 0;
                                        }, 5000);

                                        // Remove the alert after the animation duration (1000 milliseconds in this example)
                                        setTimeout(function() {
                                            loginAlert.style.display = 'none';
                                        }, 6000); // 5000 (fade out duration) + 1000 (initial delay)
                                    });
                                </script>
                        <?php 
                                unset($_SESSION['must_login']);
                            }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 my-5 text-center">
                    <div class="card shadow bg-warning">
                        <div class="card-body my-5">
                            <h4 class="fw-bold text-muted mb-3">
                                Candidates Login !
                            </h4>
                            <a href="user-login.php" class="fw-bold" style="text-decoration: none;color: blue;"><h5>Proceed To Login <i class="fas fa-arrow-right fa-lg"></i></h5></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-5 text-center">
                    <div class="card shadow bg-warning">
                        <div class="card-body my-5">
                            <h4 class="fw-bold text-muted mb-3">
                                Employers Login !
                            </h4>
                            <a href="employer-login.php" class="fw-bold" style="text-decoration: none;color: blue;"><h5>Proceed To Login <i class="fas fa-arrow-right fa-lg"></i></h5></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
 <!----- Footer Section starts here----->
 <?php include 'footer.php'; ?>   