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
    .card:hover 
    {
      transform: scale(1.035);
      transition: transform 0.3s ease-in-out;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
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
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
        <!-----Login Cards--->
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6 my-5 text-center">
                    <div class="card shadow bg-warning">
                        <div class="card-body my-5">
                            <h4 class="fw-bold text-muted mb-3">
                                Candidates Sign-Up !
                            </h4>
                            <a href="user-register.php" class="fw-bold" style="text-decoration: none;color: blue;"><h5>Proceed To Register <i class="fas fa-arrow-right fa-lg"></i></h5></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-5 text-center">
                    <div class="card shadow bg-warning">
                        <div class="card-body my-5">
                            <h4 class="fw-bold text-muted mb-3">
                                Employers Sign-Up !
                            </h4>
                            <a href="employer-register.php" class="fw-bold" style="text-decoration: none;color: blue;"><h5>Proceed To Register <i class="fas fa-arrow-right fa-lg"></i></h5></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
 <!----- Footer Section starts here----->
 <?php include 'footer.php'; ?>  
 <?php }
?> 