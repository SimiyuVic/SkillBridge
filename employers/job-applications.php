<?php

session_start();

if(!isset($_SESSION['company_id']))
{
  header('location: ../employer-login.php');
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
                    <h4>Welcome, <?php echo $_SESSION['company']; ?>!</h4>
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
                            <a href="index.php">
                            <i class="fa-solid fa-gauge-high fa-lg"></i> Dashboard
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="edit-company.php">
                            <i class="fa-solid fa-building fa-lg"></i> My Company
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="create-job.php">
                            <i class="fa-solid fa-file-pen fa-lg"></i> Create Job Post
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="job-post.php">
                            <i class="fa-solid fa-book-open-reader fa-lg"></i>My Job Post
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="job-applications.php">
                            <i class="fa-solid fa-person-circle-question fa-lg"></i> Job Applications
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="mailbox.php">
                            <i class="fa fa-envelope"></i> MailBox
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="settings.php">
                            <i class="fa-solid fa-gear fa-lg"></i> Settings
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="resume-db.php">
                            <i class="fa-solid fa-database fa-lg"></i> Resume Database
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
                    if(isset($_SESSION['update_success'])){
                        ?>

                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Hurray ! </strong> Profile Updated Successfully .!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['update_success']);
                    }
                ?>
                <!-- Display user information here -->
                <div class="card">
                  <div class="card-header">
                    <h4>Recent Applications</h4>
                    <p class="lead">Below you will find your recently applied jobs</p>
                  </div>
                  <div class="card-body">
                    <?php
                     @require_once '../config/config.php';
                      $sql = "SELECT * FROM vacancies INNER JOIN apply_job_post ON vacancies.jobpost_id=apply_job_post.jobpost_id  INNER JOIN candidates ON candidates.user_id=apply_job_post.user_id WHERE apply_job_post.company_id='$_SESSION[company_id]'";
                      $result = mysqli_query($connection, $sql);
                      
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row = mysqli_fetch_assoc($result))
                        { ?>
                          <!-----HTML CODE---->
                          <div class="card my-1 shadow bg-light">
                            <div class="row">
                              <div class="col-md-8 my-1">
                                <h4 class="lead ms-2 fw-bold"><a href="user-details.php?id=<?php echo $row['user_id']; ?>&jobpost_id=<?php echo $row['jobpost_id']; ?>" style="text-decoration: none;"><?php echo $row['job_title'] ?> | <span class="text-success"><?php echo $row['firstname'] ?>   <?php echo $row['lastname'] ?></span></a></h4>
                                <p class="lead ms-2 text-danger"><?php echo $row['created_at']; ?></p>
                              </div>
                              <div class="col-md-4 my-1">
                                <?php
                                 if($row['status'] == 0)
                                 { ?>
                                  <p class="text-warning my-4 fw-bold">Pending</p>
                                 <?php } else if($row['status'] == 1)
                                 { ?>
                                  <p class="text-danger my-4 fw-bold">Rejected</p>
                                <?php } else if($row['status'] == 2)
                                { ?>
                                  <p class="text-success my-4 fw-bold">Under Review</p>
                               <?php }
                                ?>
                              </div>
                            </div>
                          </div>
                       <?php }
                      }
                    ?>
                  </div>
                </div>
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