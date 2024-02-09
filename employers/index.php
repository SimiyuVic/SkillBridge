<?php include 'header.php'; ?>
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
                <?php
                    if (isset($_SESSION['already_logged'])) { 
                ?>
                    <div id="login-alert" class="alert alert-danger" role="alert">
                        <strong>Hey !</strong> <?php echo $_SESSION['username'];  ?> You can not perform this operation while Logged in !
                    </div>

                    <script>
                        // JavaScript code to fade out the alert after 5 seconds
                        document.addEventListener('DOMContentLoaded', function() {
                            var loginAlert = document.getElementById('login-alert');

                            // Add 'fade' class after a short delay to trigger the fade effect
                            setTimeout(function() {
                                loginAlert.style.transition = 'opacity 3s';
                                loginAlert.style.opacity = 0;
                            }, 5000);

                            // Remove the alert after the animation duration (1000 milliseconds in this example)
                            setTimeout(function() {
                                loginAlert.style.display = 'none';
                            }, 6000); // 5000 (fade out duration) + 1000 (initial delay)
                        });
                    </script>
                <?php 
                        unset($_SESSION['already_logged']);
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
                                    <a href="open-jobs.php" style="text-decoration: none;">
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
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <a href="applicants.php" style="text-decoration: none;">
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
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <a href="open-jobs.php" style="text-decoration: none;">
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
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <a href="closed-jobs.php"  style="text-decoration: none;">
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
                                    </a>
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
  <!----- Footer Section starts here----->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>