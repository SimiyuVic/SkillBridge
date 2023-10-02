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
  
  <nav class="navbar navbar-expand-lg bg-warning ">
  <div class="container">
    <a class="navbar-brand" href="home.php">Skill-Bridge</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vaccancies
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Internships</a></li>
            <li><a class="dropdown-item" href="#">Attachments</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Entry-Level</a></li>
          </ul>
        </li>
        
          <?php
            if( isset($_SESSION['user_name']) && !empty($_SESSION['user_name']) ){
              ?>
              <li class="nav-item">
              <a class="nav-link" href="../dashboard.php"><button class="btn btn-tertiary" type="submit"><i class="fa-solid fa-user fa-xl"></i></button></a>
              
            </li>
            <a class="nav-link" href="log-out.php"><button class="btn btn-outline-danger" type="submit">Log Out</button></a>
             

          <?php
            }
            else {
              ?>
              <a class="nav-link" href="#">Employers</a>
              <a class="nav-link" href="login.php"><button class="btn btn-outline-primary" type="submit">Log In</button></a>
              <a class="nav-link" href="register.php"><button class="btn btn-outline-success" type="submit">Sign Up</button></a>
           <?php
            }
          ?>
         
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>