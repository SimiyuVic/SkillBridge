<?php
session_start();

//Check if user is logged in
$userLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['company_id']) || isset($_SESSION['admin_id']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
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
    /* Custom CSS for the hover effect */
    .card:hover 
    {
      transform: scale(1.035);
      transition: transform 0.3s ease-in-out;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
  </style>
  <!-----Navbar starts here----->
  <nav class="navbar navbar-expand-lg  bg-warning">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#candidates">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#employers">Employers</a>
                    </li>
                    <?php
                     if(!$userLoggedIn)
                     { ?>
                        <li class="nav-item">
                             <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sign-up.php">Sign Up</a>
                        </li>
                     <?php }
                    ?>
                    
                    <li class="nav-item">
                        <a class="btn bg-success text-light fw-bold" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
    <!-----Home page section----->
    <section id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                <?php
if (isset($_SESSION['contact_success'])) {
    ?>
    <div id="warning-alert" class="alert alert-primary mt-3" role="alert">
        Hello, Message successfully sent, You will be contacted shortly !
    </div>
    <script>
        // JavaScript code to fade out the alert after 5 seconds
        setTimeout(function() {
            document.getElementById('warning-alert').style.transition = "opacity 3s";
            document.getElementById('warning-alert').style.opacity = 0;
        }, 5000);

        // Unset the session variable to prevent the message from showing again
        setTimeout(function() {
            <?php // unset($_SESSION['contact_success']); ?>
        }, 5000);
    </script>
    <?php
}
?>

                    <h3 class="display-5 mt-5">
                        Looking For an Internship or Attachment in your Area of Qualification?
                    </h3>
                    <h3 class=" display-5">
                        Do you need top talent for your Organization?
                    </h3>
                    <p class="lead">
                        Then you came to the right place, we offer a wide pool of jobs for students <br> and fresh graduates as 
                        well as do a good filtering for the best talent to be <br>recruited by prospective employers.
                    </p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <?php
                            if (isset($_SESSION['user_id'])) {
                                // Regular user is logged in
                                ?>
                                <a href="users/index.php" class="btn btn-warning btn-lg w-100" role="button">View Profile</a>
                                <?php
                            } elseif (isset($_SESSION['company_id'])) {
                                // Company is logged in
                                ?>
                                <a href="employers/index.php" class="btn btn-warning btn-lg w-100" role="button">View Profile</a>
                                <?php
                            } elseif (isset($_SESSION['admin_id'])) {
                                // Admin is logged in
                                ?>
                                <a href="admin/dashboard.php" class="btn btn-warning btn-lg w-100" role="button">Admin Dashboard</a>
                                <?php
                            } else {
                                // No user is logged in
                                ?>
                                <a href="sign-up.php" class="btn btn-outline-warning btn-lg w-100" role="button">Get Started</a>
                                <?php
                            }
                        ?>


                        </div>
                        <div class="col-md-6">
                            <a href="jobs.php" class="btn btn-outline-primary btn-lg w-100" role="button">Available Jobs</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/bg-home.png" class="img-fluid" alt="...">
                </div>
            </div>
            
        </div>
    </section>

    <!-----Jobs sections starts here----->
    <div class="container my-5">
        <h3 class="text-center text-light mb-3 bg-warning rounded-pill p-2">Available Jobs</h3>
        <div class="row text-center mt-3">
            <div class="col-md-6">
                <h3 class="text-center text-warning">Recent Jobs</h3>
                <?php
                    require_once 'config/config.php';

                    function displayRemainingDays($row) 
                    {
                        $expirationDate = new DateTime($row['expiration_date']);
                        $currentDate = new DateTime();
                        $interval = $currentDate->diff($expirationDate);

                        if ($interval->days < 1) {
                            // If the duration is less than a day, return 0 days
                            return 'Days Remaining: 0';
                        } else {
                            return 'Days Remaining: ' . $interval->days;
                        }
                    }

                    $sql = "SELECT company_id, jobpost_id, job_title, designation, expiration_date, status
                            FROM job_post 
                            WHERE status = 2
                            ORDER BY expiration_date DESC";

                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
                            $currentDate = new DateTime();
                            $expirationDate = new DateTime($row['expiration_date']);
                            $interval = $currentDate->diff($expirationDate);

                            if ($interval->days >= 5) {
                                // Display the card structure for jobs with more than 5 days duration
                                ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <span class="text-light bg-warning rounded-pill p-1">NEW-JOBS</span>
                                                <h6 class="text-success mt-2"><i class="fas fa-info-circle fa-lg me-1"></i><?php echo $row['designation']; ?></h6>
                                                <h6 class="text-warning"><?php echo displayRemainingTime($row); ?></h6>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <h6><span class="text-primary"><i class="far fa-check-circle fa-lg me-1"></i><?php echo $row['job_title']; ?></span></h6>
                                                <form action="view-job.php" method="POST">
                                                    <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                    <input type="submit" value="View Job" class="btn btn-warning">
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <?php
                            }
                        }
                    } 
                    else { ?>
                        <div class="alert alert-warning" role="alert">
                            No Recently posted jobs, check <a href="jobs.php" class="">Jobs </a> section for updated list !
                        </div>
                   <?php }
                    ?>
            </div>
            <!----
            <div class="col-md-4">
                <h3 class="text-center text-primary">Trending Jobs</h3>
            </div>
            ----->
            <div class="col-md-6">
                <h3 class="text-center  text-danger">Closing Soon</h3>
                <?php
                    require_once 'config/config.php';

                    function updateJobStatus($connection, $jobId) 
                    {
                        $updateQuery = "UPDATE job_post SET status = 1 WHERE jobpost_id = ?";
                        $updateStmt = $connection->prepare($updateQuery);
                        $updateStmt->bind_param('i', $jobId);
                        $updateStmt->execute();

                        $updateStmt->close();
                    }

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

                    $sql = "SELECT company_id, jobpost_id, job_title, designation, expiration_date, status
                            FROM job_post 
                            WHERE expiration_date <= DATE_ADD(NOW(), INTERVAL 5 DAY) 
                            ORDER BY expiration_date";

                    $stmt = $connection->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
                            if ($row['status'] == 2) 
                            {
                                $currentDate = new DateTime();
                                $expirationDate = new DateTime($row['expiration_date']);

                                if ($currentDate >= $expirationDate) 
                                {
                                    updateJobStatus($connection, $row['jobpost_id']);
                                    continue;
                                }
                                // Display the card structure
                                ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-1">
                                                    <span class="text-light bg-danger  rounded-pill p-1">CLOSING-SOON</span>
                                                     <h6 class="text-success mt-2"><i class="fas fa-info-circle fa-lg me-1"></i><?php echo $row['designation']; ?></h6>
                                                    <h6 class="text-danger"><?php echo displayRemainingTime($row); ?></h6>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <h6><span class="text-primary"><i class="far fa-check-circle fa-lg me-1"></i><?php echo $row['job_title']; ?></span></h6>
                                                    <form action="view-job.php" method="POST">
                                                        <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                        <input type="submit" value="View Job" class="btn btn-danger">
                                                    </form>  
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                <?php
                            }
                        }
                    } 
                    else 
                    { ?>
                        <div class="alert alert-danger" role="alert">
                            No Jobs closing soon, check <a href="jobs.php"> Jobs </a> section for updated list !
                        </div>
                   <?php }
                    ?>

            </div>
        </div>
    </div>
    <!-----Candidates Catalogue starts here----->
    <section id="candidates">
        <div class="container my-5">
            <h3 class="text-center text-muted my-5">
                Looking for a job or a way to Polish your Skills . . .
            </h3>
            <div class="row ms-4">
               <div class="col-md-3 mb-3">
                    <div class="card shadow text-center bg-success">
                        <div class="card-body">
                            <h3 class="card-title mb-2"><i class="fas fa-hourglass-half fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                Looking for a job can be so daunting and time consuming sometimes, and we understand.
                            </p>
                        </div>
                    </div>
               </div>
               <div class="col-md-3 mb-3">
                    <div class="card shadow text-center bg-info">
                        <div class="card-body">
                            <h3><i class="fas fa-paper-plane fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                Send an application to our wide catalogue of jobs Available, in a few easy steps.
                            </p>
                        </div>
                    </div>
               </div>
               <div class="col-md-3 mb-3">
                    <div class="card shadow text-center bg-secondary">
                        <div class="card-body">
                            <h3><i class="fas fa-handshake fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                Get selected, schedule an interview and meet your prospective employee.
                            </p>
                        </div>
                    </div>
               </div>
               <div class="col-md-3 mb-3">
                    <div class="card shadow text-center bg-warning">
                        <div class="card-body">
                            <h3><i class="fas fa-seedling fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                Hurray ! Get the job , grow your career in your respective field of interest.
                            </p>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </section>

    <!-----Employers Catalogue starts here----->
    <section id="employers">
        <div class="container my-5">
            <h3 class="text-center my-5">
                In need of some fresh Talent to help Grow your Organization . . .
            </h3>
            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3><i class="fas fa-user-graduate fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                Looking for the best talent in the market, ambitious and goal oriented young persons?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3><i class="fas fa-user-edit fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                Post jobs and manage your applications in a seamless way, filtering the best you can get.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3><i class="fas fa-book-reader fa-lg"></i></h3> 
                            <p class="card-text text-muted">
                                View applicants portfolio and decide on how to proceed with interviews to get the best for your organization.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3><i class="fas fa-user-check fa-lg"></i></h3>
                            <p class="card-text text-muted">
                                 Recruit the best applicants for your organization, we are certain of the talent at Skill-Bridge 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!------Testimonials Section---->
    <!------Testimonials Section Ends Here---->
    <!-----Contact & About US Section starts here----->
    <section id="contact">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-muted">
                        About-Us
                    </h3>
                    <p>
                    Welcome to <i class="text-warning fw-bold">Skill-Bridge</i>, where we are dedicated to transforming your academic journey into
                     a dynamic professional adventure. At <i class="text-warning fw-bold">Skill-Bridge</i>, we recognize the pivotal role internships
                      play in shaping careers, and our platform is meticulously crafted to be your compass in 
                      navigating the landscape of attachment opportunities. We take pride in curating a diverse 
                      array of experiences from esteemed organizations, ensuring each opportunity is a stepping 
                      stone for your growth. Our user-friendly interface simplifies the search and application
                      process, putting the focus on what matters most - your development. <i class="text-warning fw-bold">Skill-Bridge</i> is more 
                      than a platform; it's a supportive community where students, professionals, and mentors 
                      converge to share insights and propel each other forward. Join <i class="text-warning fw-bold">Skill-Bridge</i> today and 
                      embark on a transformative journey that bridges the gap between your potential and the 
                      possibilities that lie ahead.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="text-muted">
                        Contact Us
                    </h3>
                    <p class="text-muted">
                        Send us a Message.
                    </p>
                    <form action="process/contact-form-process.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" name="sender_name" class="form-control" id="floatingInput" placeholder="Enter your Name" required>
                            <label for="floatingInput">Enter Your Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="sender_email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="sender_query" placeholder="Leave a comment here" id="floatingTextarea" required></textarea>
                            <label for="floatingTextarea">Enter Comments or query . . .</label>
                        </div>
                        <input type="submit" name="contact" class="btn btn-outline-primary mb-5">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-----Contact & About US Section ends here----->

    <?php include 'footer.php'; ?>