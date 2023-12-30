<?php

session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Posted-Jobs</title>
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
                        <?php
                            if(isset($_SESSION['company_id']))
                            { ?>
                                <a class="nav-link" href="employers/index.php">Dashboard</a>
                           <?php }
                           elseif(isset($_SESSION['user_id']))
                           { ?>
                            <a class="nav-link" href="users/index.php">Dashboard</a>
                          <?php }
                          else
                          { ?>
                            <a class="nav-link" href="jobs.php">Jobs</a>
                         <?php }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
    <div class="container my-5">
        <div class="row">
        <?php
                    require_once 'config/config.php';
                    $jobpostId = isset($_POST['jobpost_id']) ? $_POST['jobpost_id'] : null;
                    $sql = "SELECT job_post.jobpost_id, job_post.company_id, job_post.job_title, job_post.job_description, job_post.designation, job_post.qualification,job_post.location, 
                    job_post.expected_salary, job_post.expiration_date, employers.company_logo 
                    FROM job_post 
                    JOIN employers ON job_post.company_id = employers.company_id WHERE job_post.jobpost_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("i", $jobpostId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0)
                    {
                        while ($row = $result->fetch_assoc())
                        { ?>
                            <div class="col-md-10 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                            <a href="index.php">
                                                <button class="btn btn-outline-primary">Back</button>
                                            </a>
                                        </div>
                                    <div class="card-body">
                                        <?php 
                                            if(!isset($_SESSION['user_id']))
                                            { ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>Hello !</strong> You Have to Log in to be able to apply to this job !
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php }
                                        ?>
                                        <h5 class="text-primary"><i class="fa-solid fa-briefcase fa-lg me-3"></i><?php echo $row['job_title']; ?> | <button class="btn btn-primary"><?php echo $row['designation']; ?></button> | <i class="fa-solid fa-location-dot fa-lg ms-2 me-3"></i><?php echo $row['location']; ?></h5>
                                        <p class="text-primary"><i class="fa-solid fa-user-graduate fa-lg me-3"></i><?php echo $row['qualification']; ?> |</p>
                                        <p class="text-primary"><i class="fa-solid fa-wallet fa-xl me-3"></i>KES. <?php echo $row['expected_salary']; ?> |</p>
                                        <p class="text-danger fw-bold">
                                            <i class="fa-solid fa-hourglass-half fa-xl me-3"></i>
                                            <?php
                                                $expirationDate = new DateTime($row['expiration_date']);
                                                $currentDate = new DateTime();
                                                $remainingDays = $currentDate->diff($expirationDate)->format('%a');
                                                echo 'Days Remaining : ' . $remainingDays;
                                            ?>
                                        </p>
                                        <p class="lead">
                                            <?php echo $row['job_description']; ?>
                                        </p>
                                        <?php
                                            if(isset($_SESSION['user_id']))
                                            { ?>
                                                <form action="process/apply-job.php" method="POST">
                                                    <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id'] ?>">
                                                    <input type="hidden" name="company_id" value="<?php echo $row['company_id'] ?>">
                                                    <input type="submit" name="apply_job" value="Apply Job" class="btn btn-outline-primary">
                                                </form>
                                           <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="card">
                                    <img src="uploads/company_logo/<?php echo $row['company_logo'];?>" class="img-thumbnail" alt="...">
                                </div>
                                <a href="" class="btn btn-outline-dark mt-3">Company Profile</a>
                            </div>
                       <?php }
                    }
                    else
                    {
                        //No job
                    }
                ?>
        </div>
    </div>
    <!----- Footer Section starts here----->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>