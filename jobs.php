<?php
session_start();


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       <style>
          .navbar-brand {
              font-family: 'Pacifico', cursive; /* Set the font-family to 'Pacifico' or your chosen curly font */
          }
      </style>

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
              <?php if(empty($_SESSION['user_id']) && empty($_SESSION['company_id'])){

                ?>
                  <li class="nav-item ">
                    <a class="nav-link active fw-bold text-light" aria-current="page" href="login.php">Login</a>
                  </li>
                 <li class="nav-item ">
                   <a class="nav-link active fw-bold text-light" aria-current="page" href="register.php">Sign-Up</a>
                </li>
                <?php

              } else { 
                if(isset($_SESSION['user_id'])){
                  ?>

                  <li class="nav-item ">
                   <a class="nav-link active fw-bold text-light" aria-current="page" href="users/index.php">Dashboard</a>
                  </li>

                  <?php
                } elseif(isset($_SESSION['company_id'])){
                  ?>
                    <li class="nav-item ">
                      <a class="nav-link active fw-bold text-light" aria-current="page" href="employers/index.php">Dashboard</a>
                    </li>
                  
                <?php }

              }
               ?>
              
            </ul>
          </div>
        </div>
      </nav>


    <!---Navigation Bar Ends Here-->

    <!----Job section starts here--->
    <div class="container my-3">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center display-4">Latest Vacancies</h3>
          <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search For Vacancies" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
    <div class="container my-5">
      <div class="row">
        <div class="col-md-3">
          1
        </div>
        <div class="col-md-9">2</div>
      </div>
    </div>
    <!----Job section ends here--->