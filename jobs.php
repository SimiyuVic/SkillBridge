<?php

session_start();

if(!isset($_SESSION['email']))
{
  header('location: ../user-login.php');
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <!---Navigatiob Bar Starts-->
      <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand fw-bold text-light" href="#">Skill-Bridge</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item ">
                <a class="nav-link active fw-bold text-light" aria-current="page" href="users/index.php">Dashboard</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link active fw-bold text-light" aria-current="page" href="log-out.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


    <!---Navigatiob Bar Ends Here-->