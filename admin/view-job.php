<?php
ob_start();
session_start();

//Check if user is logged in
if(!isset($_SESSION['admin_id']))
{
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}
ob_end_flush();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | View-Job</title>
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
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
    <!----Main body content-----> 
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3">
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
                        <h5><?php echo $greeting . ', <i>' .$_SESSION['username']. '</i>'; ?></h5>
                    </div>
                    <?php include 'side-bar.html'; ?> 
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header ">
                        <a href="posted-jobs.php" class="btn btn-outline-primary ml-auto">Back</a>
                    </div>
                    <div class="card-body">
                        <?php
                            require_once '../config/config.php';

                            $jobpostId = isset($_POST['jobpost_id']) ? $_POST['jobpost_id'] : null;

                            $sql = "SELECT * FROM job_post WHERE jobpost_id = ?";
                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param("i", $jobpostId);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if($result->num_rows > 0)
                            {
                                while ($row = $result->fetch_assoc())
                                {
                                 ?>
                                    <h5 class="text-primary">
                                        <i class="fa-solid fa-briefcase fa-lg me-3"></i><?php echo $row['job_title']; ?> | <button class="btn btn-primary text-light"><?php echo $row['designation']; ?></button> | <?php echo $row['location']; ?>
                                    </h5>
                                    <p class="text-primary">
                                        <i class="fa-solid fa-graduation-cap fa-lg me-3"></i><?php echo $row['qualification']; ?> |
                                    </p>
                                    <p class="text-primary">
                                        <i class="fa-solid fa-money-check fa-lg me-3"></i>KES.  <?php echo $row['expected_salary']; ?> |
                                    </p>
                                    <p class="text-warning"> 
                                    <i class="fa-solid fa-thumbtack fa-lg me-3"></i>
                                        Job status |
                                        <?php
                                        $status = $row['status'];
                                        $textColorClass = ($status == 2) ? 'text-warning' : 'text-danger';
                                        echo '<span class="' . $textColorClass . '">';
                                        echo ($status == 2) ? 'Open' : 'Closed';
                                        echo '</span>';
                                        ?>
                                    </p>
                                    <?php
                                        if($row['status'] != 1)
                                        { ?>
                                        <p class="text-danger fw-bold">
                                            <i class="fa-solid fa-hourglass-half fa-lg me-3"></i>
                                            <?php
                                            // Assuming $row['expiration_date'] contains the expiration date
                                            $expirationDate = new DateTime($row['expiration_date']);
                                            $currentDate = new DateTime();
                                            
                                            $interval = $currentDate->diff($expirationDate);
                                            $daysRemaining = $interval->days;
                                            $hoursRemaining = $interval->h;

                                            echo '<span class="text-danger">';
                                            
                                            if ($daysRemaining >= 1) {
                                                echo 'Days Remaining: ' . $daysRemaining;
                                            } elseif ($hoursRemaining >= 1) {
                                                echo 'Hours Remaining: ' . $hoursRemaining;
                                            } else {
                                                // If neither days nor hours are greater than or equal to 1, display minutes
                                                echo 'Minutes Remaining: ' . $interval->i;
                                            }
                                            
                                            echo '</span>';
                                            ?>
                                        </p>
                                        <p>
                                            <form action="../process/close-jobpost.php" method="POST" onsubmit="return confirmCloseJob()">
                                                <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                <input type="submit" name="close_job" value="Close Application" class="btn btn-outline-danger">
                                            </form>
                                            <script>
                                                function confirmCloseJob() {
                                                    return confirm("Are you sure you want to close this job application?");
                                                }
                                            </script>
                                        </p>
                                        <?php }
                                    ?>
                                    <p class="lead">
                                        <?php echo $row['job_description']; ?>
                                    </p>
                               <?php }
                            }
                            
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