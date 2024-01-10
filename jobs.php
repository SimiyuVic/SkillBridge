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
    .card:hover 
    {
      transform: scale(1.035);
      transition: transform 0.7s ease-in-out;
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
                    <?php
                    if(isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users/index.php">Dashboard</a>
                        </li>
                    <?php } elseif(isset($_SESSION['company_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="employers/index.php">Dashboard</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sign-up.php">Sign Up</a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
        <div class="container-fluid mt-3">
            <?php
                if(isset($_SESSION['job_exists']))
                { 
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey !</strong> You Already Applied to this Job, here is More to choose from !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['job_exists']);
                }
            ?>
            <?php
                if(isset($_SESSION['apply_failed']))
                { 
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Hey !</strong> Job Application Failed 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['apply_failed']);
                }
            ?>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="ms-2">
                        <h5 class="text-muted">
                            Latest jobs abd Vacancies for Students, recent Graduates and Entry level trainees
                        </h5>
                        <p class="lead">
                            We have a wide range of employers seeking bright and amazing talent, make sure your portfolio 
                            is well set, your information is correct and continue learning to increase your chance of success.
                            We offer a platform but you are the controller.
                        </p>
                        <div class="card-body">
                            <input class="form-control mb-4" id="containerSearch" type="text" placeholder="Search By Job Title">
                            <input class="form-control mb-4" id="containerSearch" type="text" placeholder="Search By Location">
                            <input class="form-control mb-4" id="containerSearch" type="text" placeholder="Search By Qualification /Field of Study">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <section id="jobs">
                        <?php
                            function displayRemainingTime($row) 
                            {
                                $expirationDate = new DateTime($row['expiration_date']);
                                $currentDate = new DateTime();
                                $interval = $currentDate->diff($expirationDate);
        
                                if ($interval->days < 1) {
                                    if ($interval->h >= 1) {
                                        return 'Hours Remaining: ' . $interval->h;
                                    } elseif ($interval->i >= 1) {
                                        return 'Minutes Remaining: ' . $interval->i;
                                    } else {
                                        // If the duration is completed, remove silently
                                        return '';
                                    }
                                } else {
                                    return 'Days Remaining: ' . $interval->days;
                                }
                            }
                            require_once 'config/config.php';
                            $sql = "SELECT e.company_logo,
                            jp.jobpost_id, jp.job_title, jp.job_description, jp.designation, jp.location, 
                            jp.expected_salary, jp.status, jp.expiration_date
                            FROM job_post AS jp
                            JOIN employers AS e ON jp.company_id = e.company_id
                            WHERE jp.status = '2'
                            ORDER BY jp.created_at DESC";
                            $result = $connection->query($sql);
                            if(!$result)
                            {
                                //No jobs
                            }
                            else
                            {
                                while($row = $result->fetch_assoc())
                                { ?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="uploads/company_logo/<?php echo $row['company_logo']; ?>" class="rounded mx-auto d-block img-fluid" alt="...">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <h5 class="text-success mt-2"><i class="fas fa-info-circle fa-lg me-1"></i><?php echo $row['designation']; ?></h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form action="view-job.php" method="POST">
                                                                <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                                <input type="submit" value="View Job" class="btn btn-outline-warning">
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <h5><span class="text-primary"><i class="far fa-check-circle fa-lg me-1"></i><?php echo $row['job_title']; ?></span></h5>
                                                    <div class="bg-light">
                                                        <div class="card-body">
                                                            <?php $jobDescription = substr($row['job_description'], 0, 250); ?>
                                                            <p class="text-muted"><?php echo $jobDescription; ?> . . .</p>
                                                        </div>
                                                    </div>
                                                    <span class="mt-1 text-primary"><i class="fa-solid fa-location-dot me-2"></i><?php echo $row['location']; ?> | </span>
                                                    <span class="mt-1 text-danger"><i class="fa-solid fa-hourglass-end me-2"></i><?php echo displayRemainingTime($row); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               <?php }
                            }
                     
                        ?>
                    </section>
                </div>
            </div>

  
        </div>
        <?php include 'footer.php'; ?>