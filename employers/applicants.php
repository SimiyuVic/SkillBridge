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
                    if(isset($_SESSION['job_under_review']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Job Status is Already Under Review !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['job_under_review']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['job_under_review_update']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application Status changed to Under Review !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['job_under_review_update']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['failed_change']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Failed to Change status, Try Again !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['failed_change']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['already_rejected']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application Status is Already Rejected !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['already_rejected']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['rejected']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application Status changed to Rejected !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['rejected']);
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
            <?php
                    // Check if the alert has already been shown
                    if (!isset($_SESSION['dash_info_shown'])) {
                        $_SESSION['dash_info'] = "";
                        ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Hello !</strong> Click on View Profile to know more about your Applicant
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        // Set the flag to indicate that the alert has been shown
                        $_SESSION['dash_info_shown'] = true;
                    }
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="text-center">
                            A list of Applicants on your Job Posts
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php
                            require_once '../config/config.php';
                            $sql = "SELECT users.user_id, users.firstname, users.lastname, 
                            job_post.jobpost_id, job_post.job_title, job_post.designation,
                            applied_jobs.status
                            FROM applied_jobs
                            JOIN users ON applied_jobs.user_id = users.user_id
                            JOIN job_post ON applied_jobs.jobpost_id = job_post.jobpost_id
                            WHERE applied_jobs.company_id = ?";

                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param("i", $_SESSION['company_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $_SESSION['no_applicants'] = true;

                            if($result->num_rows > 0)
                            {
                                unset($_SESSION['no_applicants']);
                                while($row = $result->fetch_assoc())
                                { ?>
                                    <div class="card mb-1">
                                        <div class="card-body bg-light">
                                            <div class="row">
                                                <div class="col-6 col-lg-4 mb-1">
                                                    <h5><?php echo $row['firstname']; ?>  <?php echo $row['lastname']; ?></h5>
                                                    <form action="applicant-profile.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                        <input type="submit" value="View Profile" class="btn btn-outline-dark">
                                                    </form>
                                                </div>
                                                <div class="col-6 col-lg-3">
                                                    <h5>Job Tittle</h5>
                                                    <h6><?php echo $row['job_title']; ?></h6>
                                                    <?php
                                                        $status = $row['status'];

                                                        if ($status === 0) {
                                                            $statusText = 'Rejected';
                                                            $statusClass = 'text-danger';
                                                        } elseif ($status === 1) {
                                                            $statusText = 'Under Review';
                                                            $statusClass = 'text-info';
                                                        } elseif ($status === 2) {
                                                            $statusText = 'Pending Review';
                                                            $statusClass = 'text-primary';
                                                        } else {
                                                            // Handle other status values if needed
                                                            $statusText = 'Unknown Status';
                                                            $statusClass = 'text-secondary';
                                                        }
                                                    ?>
                                                    <h6>Status <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span></h6>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-6 mb-1">
                                                            <form action="../process/application-status.php" method="POST">
                                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"> 
                                                                <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                                <input type="submit" name="under_review" value="Mark Under Review" class="btn btn-info">
                                                            </form>
                                                        </div>
                                                        <div class="col-6 col-lg-6">
                                                            <form action="../process/application-status.php" method="POST">
                                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"> 
                                                                <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                                <input type="submit" name="reject_application" value="Reject Application" class="btn btn-danger" onclick="return confirmDelete();">
                                                            </form>
                                                            <script>
                                                                function confirmDelete() {
                                                                    // Display a confirmation dialog
                                                                    var isConfirmed = confirm("Are you sure you want to reject this Application?");

                                                                    // If the user confirms, submit the form
                                                                    return isConfirmed;
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                <?php }
                            }
                            else
                            {
                                $_SESSION['no_applicants'];
                            }
                            $stmt->close();
                            $connection->close();
                        ?>
                        <?php
                                if(isset($_SESSION['no_applicants']))
                                { ?>
                                    <div class="alert alert-info" role="alert">
                                        Job Applicants will be visible here only after your job posts have been applied on,
                                         if none is displayed be patient.
                                    </div>
                               <?php }
                            ?>
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