    <!-----Navbar starts here----->
    <?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    
    <body>
    <!----Main body content-----> 
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4">
                <?php
                    if(isset($_SESSION['update_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hurray !</strong> Profile Updated Successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['update_success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['login_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Welcome !</strong> <?php echo $_SESSION['firstname']  . '   ' .  $_SESSION['lastname'];  ?>
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
                        <strong>Hey !</strong> <?php echo $_SESSION['lastname'];  ?> You can not perform this operation while Logged in !
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
                    <div class="card-header text-center">
                        <?php
                        date_default_timezone_set('Africa/Nairobi');
                        //Getting the current hour
                            $currentHour = date('G');   
                        //Greeting based on time of the day.
                        if($currentHour >= 5 && $currentHour < 12)
                        {
                            $greeting = "Good Morning";
                        }
                        elseif($currentHour >= 13 && $currentHour < 18)
                        {
                            $greeting = "Good Afternoon";
                        }
                        else 
                        {
                            $greeting = "Good Evening";
                        }
                        ?>    
                        <h5><?php echo $greeting . ', <i>' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</i>'; ?></h5>
                    </div>
                    <?php include 'side-bar.html'; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Here is how you have been Fairing</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2">
                                <div class="card shadow" style="height: 100x;">
                                    <div class="card-body text-primary">
                                        <?php
                                        //To get number of jobs applied.
                                        require_once '../config/config.php';

                                        //Query to count number of jobs applied
                                        $query = "SELECT COUNT(*) AS jobCount FROM applied_jobs WHERE user_id = ?";
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param("i", $_SESSION['user_id']);
                                        $stmt->execute();
                                        $stmt->bind_result($jobCount);
                                        $stmt->fetch();
                                        $stmt->close();

                                        ?>
                                        <h5> Applied Jobs</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="ms-2 mt-2"><i class="fas fa-briefcase fa-xl"></i></p>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-primary"><?php echo $jobCount; ?></h3>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow" style="height: 100x;">
                                <a href="portfolio.php" style="text-decoration: none;">
                                    <div class="card-body text-success">
                                            <?php
                                            //To get number of skills added.
                                            require_once '../config/config.php';

                                            //Query to count number of skills added
                                            $query = "SELECT COUNT(*) AS skillcount FROM portfolio WHERE user_id = ?";
                                            $stmt = $connection->prepare($query);
                                            $stmt->bind_param("i", $_SESSION['user_id']);
                                            $stmt->execute();
                                            $stmt->bind_result($skillCount);
                                            $stmt->fetch();
                                            $stmt->close();

                                            ?>
                                            <h5> Skills Added</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="ms-2 mt-2"><i class="fas fa-folder-plus fa-xl"></i></p>
                                                </div>
                                                <div class="col-6">
                                                    <h3 class="text-success"><?php echo $skillCount; ?></h3>
                                                </div>
                                            </div>  
                                        </div>
                                </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="card shadow" style="height: 100x;">
                                    <div class="card-body text-warning">
                                        <?php
                                        // Get the number of jobs with status 1 under Review
                                        require_once '../config/config.php';

                                        // Query to count the number of jobs with status 1 (pending)
                                        $queryReview = "SELECT COUNT(*) AS underReview FROM applied_jobs WHERE user_id = ? AND status = 1";
                                        $stmtReview = $connection->prepare($queryReview);
                                        $stmtReview->bind_param("i", $_SESSION['user_id']);
                                        $stmtReview->execute();
                                        $stmtReview->bind_result($underReview);
                                        $stmtReview->fetch();
                                        $stmtReview->close();
                                        ?>
                                        <h5>Under Reviews</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="ms-2 mt-2"><i class="fas fa-smile-wink fa-xl"></i></p>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-warning"><?php echo $underReview; ?></h3>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="card shadow" style="height: 100x;">
                                    <div class="card-body text-info">
                                        <?php
                                        // Get the number of jobs with status 2 (Pending)
                                        require_once '../config/config.php';

                                        // Query to count the number of jobs with status 2 (Pending)
                                        $queryPending = "SELECT COUNT(*) AS declinedCount FROM applied_jobs WHERE user_id = ? AND status = 2";
                                        $stmtPending = $connection->prepare($queryPending);
                                        $stmtPending->bind_param("i", $_SESSION['user_id']);
                                        $stmtPending->execute();
                                        $stmtPending->bind_result($declinedCount);
                                        $stmtPending->fetch();
                                        $stmtPending->close();
                                        ?>
                                        <h5>Pending Review</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="ms-2 mt-2"><i class="fas fa-hourglass-half fa-xl"></i></p>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-info"><?php echo $declinedCount; ?></h3>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="card shadow" style="height: 100x;">
                                    <div class="card-body text-danger">
                                        <?php
                                        // Get the number of jobs with status 0 (declined)
                                        require_once '../config/config.php';

                                        // Query to count the number of jobs with status 1 (pending)
                                        $queryDeclined = "SELECT COUNT(*) AS declinedCount FROM applied_jobs WHERE user_id = ? AND status = 0";
                                        $stmtDeclined = $connection->prepare($queryDeclined);
                                        $stmtDeclined->bind_param("i", $_SESSION['user_id']);
                                        $stmtDeclined->execute();
                                        $stmtDeclined->bind_result($declinedCount);
                                        $stmtDeclined->fetch();
                                        $stmtDeclined->close();
                                        ?>
                                        <h5>Declined Applications</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="ms-2 mt-2"><i class="fas fa-sad-tear fa-xl"></i></p>
                                            </div>
                                            <div class="col-6">
                                                <h3 class="text-danger"><?php echo $declinedCount; ?></h3>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!------To add something else Later----->
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
