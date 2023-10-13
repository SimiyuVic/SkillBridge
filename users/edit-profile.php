<?php

session_start();

@require_once "../config/config.php";

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


    <!---Navigatiob Bar Ends Here-->
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
                <!-- Display user information here -->
                <h4>Edit Profile</h4>
                <?php
                    if(isset($_SESSION['update_success'])){
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hurray ! </strong> Profile Updated Successfully .!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['update_success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['no-data'])){
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops ! </strong> No Data Retrieved . !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['no-data']);
                    }
                ?>
                <?php
                $currentUser = $_SESSION['firstname'];
                $sql = "SELECT * FROM candidates WHERE firstname = '$currentUser'";
                $gotResults = mysqli_query($connection, $sql);
                if($gotResults)
                {
                  if(mysqli_num_rows($gotResults)>0)
                  {
                    while($row = mysqli_fetch_assoc($gotResults))
                    {
                      ?>
                      <form action="../process/process-edit.php" method="POST">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" name="firstname" class="form-control" placeholder=" First Name *" required value="<?php echo $row['firstname']; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="lastname" class="form-control" placeholder=" Last Name *" required value="<?php echo $row['lastname']; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder=" Email *" required value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="phone_number" class="form-control" placeholder=" Phone Number *" required value="<?php echo $row['phone_number']; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="qualification" class="form-control" placeholder=" Highest Qualification Highschool/ University Degree *" required value="<?php echo $row['qualification']; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="occupation" class="form-control" placeholder=" Current Occupation Student/Graduate *" required value="<?php echo $row['occupation']; ?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <textarea class="form-control input-lg" rows="4" placeholder="Describe yourself" name="about_me"><?php echo $row['about_me']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control input-lg" placeholder="Your Skills" rows="4" name="skills"><?php echo $row['skills']; ?></textarea>
                            </div>
                          </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="update" value="Update">
                      </form>
                      <?php
                    }
                  }
                  else {
                    $_SESSION['no-data'] = "";
                  }
                }
                ?>
                
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