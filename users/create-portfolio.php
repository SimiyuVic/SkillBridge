<?php

session_start();

if(!isset($_SESSION['user_id']))
{
  header('location: ../user-login.php');
  $_SESSION['must_login'] = "";
  exit;
}

@require_once '../config/config.php';
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
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand fw-bold text-light" href="#">Skill-Bridge</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item ">
                <a class="nav-link active fw-bold text-light" aria-current="page" href="../jobs.php">Jobs</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


    <!---Navigation Bar Ends Here-->
    <!-- Other dashboard content goes here -->
    <div class="container my-3">
        <div class="row">   
            <!-- User Dashboard -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    <h4>Welcome, <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?>!</h4>
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
                            <a href="edit-profile.php">
                                <i class="fa fa-user"></i> Edit Profile
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="index.php">
                                <i class="fa fa-book"></i> My Applications
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="../jobs.php">
                            <i class="fa-solid fa-circle-question fa-lg"></i> Jobs
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="mailbox.php">
                                <i class="fa fa-envelope"></i> Mailbox
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="create-portfolio.php">
                            <i class="fa-brands fa-envira fa-lg"></i> PortFolio
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="settings.php">
                            <i class="fa-solid fa-gear fa-lg"></i> Settings
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
            
                <?php
                    if(isset($_SESSION['success'])){
                        ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Hurray </strong> Updated succesfully !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['failed'])){
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops </strong> Update Failed !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['falied']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['add_project'])){
                        ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Congratulations </strong> One More Added !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['add_project']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['deleted'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey </strong> You can always add a new one!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['deleted']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['delete_failed'])){
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops </strong> Could not delete skill, Try again !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['delete_failed']);
                    }
                ?>
                <div class="">
                  <p class="lead my-3 border-bottom">This is your profile, you can Edit or Add a new skill  you have acquired </p>
                  <?php
                    $sql = "SELECT * FROM candidates WHERE user_id = '$_SESSION[user_id]'";
                    $result = mysqli_query($connection, $sql);

                    if($result->num_rows > 0)
                    {
                      while($row = mysqli_fetch_assoc($result))
                      { ?>
                        <!----HTML code goes here--->
                        <div class="row border-bottom">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <span class="fw-bold"><i class="fa-regular fa-envelope fa-xl"></i>  : <?php echo $row['email']; ?></span>
                            </div>
                            <div class="mb-3">
                              <span class="fw-bold"><i class="fa-solid fa-phone fa-xl"></i>  : <?php echo $row['phone_number']; ?></span>
                            </div>
                            <div class="mb-2">
                              <span class="fw-bold"><i class="fa-solid fa-clipboard-check fa-xl"></i>  : <?php echo $row['qualification']; ?></span>
                            </div>
                            <a href="add-skill.php" class="btn btn-outline-primary mt-3">ADD PROJECT</a>
                          </div>
                          <div class="col-md-6">
                            <div>
                              <h4 class="text-muted">About Yourself</h4>
                              <p class="lead"><?php echo $row['about_me']; ?></p>
                            </div>
                            <div>
                              <h4 class="text-muted">Your Skills</h4>
                              <p class="lead"><?php echo $row['skills']; ?></p>
                            </div>
                            <div>
                              <h4 class="text-muted">Current Occupation</h4>
                              <p class="lead"><?php echo $row['occupation']; ?></p>
                            </div>
                          </div>
                        </div>
                     <?php }
                      
                    } 
                  ?>
                </div>
                <!-- Display user information here -->
                <!----------Added Skills will be displayed here for the user------->
                  <h4 class="text-center  my-3">Your Mile-Stones <i class="fa-solid fa-face-smile-beam fa-xl"></i></h4>
                            
                              <?php
                                $sql = "SELECT * FROM portfolio WHERE user_id = '$_SESSION[user_id]'";
                                $result = mysqli_query($connection, $sql);
                                if($result)
                                {
                                  while($row = mysqli_fetch_assoc($result))
                                  { ?>
                                    <div class="my-2 card shadow">
                                      <div class="row">
                                        <div class="col-md-4 ms-2 my-2">
                                          <img src="../uploads/profile/<?php echo $row['profile']; ?>" class="img-fluid rounded"  alt="">
                                        </div>
                                        <div class="col-md-4">
                                          <p class="lead my-3 text-success fw-bold"><i class="fa-solid fa-laptop-file fa-lg"></i> <?php echo $row['project_info']; ?></p>
                                          <a href="<?php echo $row['project_link']; ?>" style="text-decoration: none;"><p class="lead text-primary"><i class="fa-solid fa-globe fa-lg"></i> <?php echo $row['project_link']; ?></p></a>
                                        </div>
                                        <div class="col-md-3 my-5">
                                          <div class="row">
                                            <div class="col-md-5 my-2">
                                              <form action="edit-skill.php" method="GET">
                                                <input type="hidden" name="id" value="<?php echo $row['portfolio_id']; ?>">
                                                <input type="submit" value="Edit" class="btn btn-outline-primary">
                                              </form>
                                            </div>
                                            <div class="col-md-5 my-2">
                                              <form action="../process/delete-skill.php" method="GET">
                                                <input type="hidden" name="id" value="<?php echo $row['portfolio_id']; ?>">
                                                <input type="submit" value="Delete" class="btn btn-outline-danger">
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                 <?php }
                              }
                            ?>
                <!----------Added Skills will end  here for the user------->
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