<?php

session_start();

//Check if user is logged in
if(!isset($_SESSION['company_id']))
{
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | My-Dashboard</title>
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
            <a class="navbar-brand fw-bold" href="../index.php">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">Jobs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
    <!----Main body content-----> 
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3">
            <?php
                    if(isset($_SESSION['login_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Welcome !</strong> <?php echo $_SESSION['username'];  ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['login_success']);
                    }
                ?>
                <div class="card">
                    <div class="card-header">
                    <?php
                        //Getting the current hour
                            $currentHour = date('G');
                        //Greeting based on time of the day.
                        if($currentHour >= 5 && $currentHour < 12)
                        {
                            $greeting = "Good Morning";
                        }
                        else if($currentHour >=12 && $currentHour < 17)
                        {
                            $greeting = "Good Afternoon";
                        }
                        else 
                        {
                            $greeting = "Good Evening";
                        }
                        ?>
                        <h5><?php echo $greeting . ', <i>' . $_SESSION['company_name'] . '</i>'; ?></h5>
                    </div>
                    <?php include 'side-bar.html'; ?> 
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">A glimpse on your Progress So Far</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <div class="card-body text-success">
                                        <div class="row">
                                            <div class="col-6">
                                                <?php
                                                    //To get number of poasted jobs.
                                                    $company_id = $_SESSION['company_id'];
                                                    require_once '../config/config.php';

                                                    //Query to count number of poasted jobs
                                                    $query_posted_jobs = "SELECT COUNT(*) AS postedJobs FROM job_post WHERE company_id = ?";
                                                    $stmt_posted_jobs = $connection->prepare($query_posted_jobs);
                                                    $stmt_posted_jobs->bind_param("i", $_SESSION['company_id']);
                                                    $stmt_posted_jobs->execute();
                                                    $stmt_posted_jobs->bind_result($postedJobs);
                                                    $stmt_posted_jobs->fetch();
                                                    $stmt_posted_jobs->close();

                                                ?>
                                                    <h5>Posted Jobs</h5>
                                                    <h5><i class="fas fa-folder-open fa-xl me-3"></i></h5>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-success"><?php echo $postedJobs; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <div class="card-body text-primary">
                                        <div class="row">
                                        <div class="col-6">
                                            <?php
                                                //To get number of Job Applications
                                                require_once '../config/config.php';

                                                //Query to count number of Job Applications
                                                $query_applications = "SELECT COUNT(*) AS jobApplications FROM applied_jobs WHERE company_id = ?";
                                                $stmt_job_applications = $connection->prepare($query_applications);
                                                $stmt_job_applications->bind_param("i", $_SESSION['company_id']);
                                                $stmt_job_applications->execute();
                                                $stmt_job_applications->bind_result($jobApplications);
                                                $stmt_job_applications->fetch();
                                                $stmt_job_applications->close();

                                            ?>
                                                <h5>Job Applications</h5>
                                                <h5><i class="fas fa-question-circle fa-xl"></i></h5>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-primary"><?php echo $jobApplications; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <div class="card-body text-warning">
                                        <?php
                                        //To get number of Open Jobs.
                                        require_once '../config/config.php';

                                        //Query to count number of Open Jobs
                                        $query_open_jobs = "SELECT COUNT(*) AS openJobs FROM job_post WHERE company_id = ? AND status = 2";
                                        $stmt_open_jobs = $connection->prepare($query_open_jobs);
                                        $stmt_open_jobs->bind_param("i", $_SESSION['company_id']);
                                        $stmt_open_jobs->execute();
                                        $stmt_open_jobs->bind_result($openJobs);
                                        $stmt_open_jobs->fetch();
                                        $stmt_open_jobs->close();
                                        ?>
                                        <h5> Open Job Posts</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="ms-2 mt-2"><i class="fas fa-lock-open fa-xl"></i></p>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-warning"><?php echo $openJobs; ?></h3>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <div class="card-body text-danger">
                                        <?php
                                        //To get number of Closed Jobs
                                        require_once '../config/config.php';

                                        //Query to count number of Closed Jobs
                                        $query_closed_jobs = "SELECT COUNT(*) AS closedJobs FROM job_post WHERE company_id = ? AND status = 1";
                                        $stmt_closed_jobs = $connection->prepare($query_closed_jobs);
                                        $stmt_closed_jobs->bind_param("i", $_SESSION['company_id']);
                                        $stmt_closed_jobs->execute();
                                        $stmt_closed_jobs->bind_result($closedJobs);
                                        $stmt_closed_jobs->fetch();
                                        $stmt_closed_jobs->close();
                                        ?>
                                        <h5> Closed Job Posts</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="ms-2 mt-2"><i class="fas fa-lock fa-xl"></i></p>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-danger"><?php echo $closedJobs; ?></h3>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
 <!----- Footer Section starts here----->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>