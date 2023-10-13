<?php

session_start();

if(!isset($_SESSION['email']))
{
  header('location: index.php');
  $_SESSION['no-login'] = "";
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <!---Navigatiob Bar Starts-->
      <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold text-light" href="#">Skill-Bridge</a>
          
        </div>
      </nav>


    <!---Navigatiob Bar Ends Here-->
    <!-- Other dashboard content goes here -->
    <div class="container my-3">
        <div class="row">   
            <!-- User Dashboard -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    <h4>Welcome, <?php echo $_SESSION['username']; ?> !</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <style>
                            /* Style the links */
                            .list-group-item a {
                                text-decoration: none; /* Remove text underline */
                                color: darkslategray; /* Set text color to dark */
                            }

                            /* Style the icons */
                            .list-group-item a i {
                                color: darkslategray; /* Set icon color to dark */
                                margin-right: 5px; /* Add margin between icons and text */
                            }
                        </style>

                        <!-- Edit Profile -->
                        <li class="list-group-item">
                            <a href="dashboard.php">
                            <i class="fa-solid fa-gauge-high fa-xl"></i> Dashboard
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="active-jobs.php">
                            <i class="fa-solid fa-briefcase fa-xl"></i>Active Jobs
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="applications.php">
                            <i class="fa-regular fa-address-card fa-lg"></i> Applications
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="companies.php">
                            <i class="fa-solid fa-building fa-lg"></i> Companies
                            </a>
                        </li>
                        <!-- Logout -->
                        <li class="list-group-item">
                            <a href="../log-out.php">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- User Profile Information -->
            <div class="col-md-8">
                
                <!-- Display user information here -->
            </div>
        </div>
    </div>

    <!----Footer Section--->
    <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center  ">
      <strong>Copyright &copy; 2023 <a href="index.php">Skill-Bridge</a>.</strong> All rights
    reserved.
    </div>
  </footer>
<script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>