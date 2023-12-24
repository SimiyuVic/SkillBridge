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
            <div class="col-md-3 mb-3">
                <?php
                    if(isset($_SESSION['create_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Job Created Successfully !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['create_success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['no_job']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Job Does not Exists
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['no_job']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['unauthorized']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Not Authorized to view Selected Job
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['unauthorized']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['deleted']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Job Post Deleted !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['deleted']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['failed_delete']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Could not Delete Job Post !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['deleted']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['status_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Job Status Updated
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['status_success']);
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
                        <ul class="list-group list-group-flush">
                            <a href="index.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                <i class="fas fa-tachometer-alt fa-lg me-3"></i> Dashboard
                                </li>
                            </a>
                            <a href="edit-profile.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                    <i class="fas fa-user-edit fa-lg me-3"></i> Edit Profile
                                </li>
                            </a>
                            <a href="posted-jobs.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                <i class="fas fa-folder-open fa-lg me-3"></i> Posted Jobs
                                </li>
                            </a>
                            <a href="create-job.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                <i class="fas fa-folder-plus fa-lg me-3"></i> Create Job
                                </li>
                            </a>
                            <a href="applicants.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                    <i class="fas fa-users fa-lg me-3"></i> View Applicants
                                </li>
                            </a>
                            <a href="messages.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                    <i class="fas fa-comments fa-lg me-3"></i>Messages
                                </li>
                            </a>
                            <a href="settings.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                    <i class="fas fa-cog fa-lg me-3"></i> Settings
                                </li>
                            </a>
                            <a href="../process/log-out.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                    <i class="fas fa-sign-out-alt fa-lg me-3"></i> Log Out
                                </li>
                            </a>
                        </ul> 
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Job Tittle</th>
                                    <th scope="col">View Job</th>
                                    <th scope="col">Job Status</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once '../config/config.php';
                                $companyId = $_SESSION['company_id'];
                                $sql = "SELECT jobpost_id, company_id, job_title, status FROM job_post WHERE company_id = ?";
                                $stmt = $connection->prepare($sql);
                                $stmt->bind_param("i", $companyId);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc())
                                    { ?>
                                        <tr>
                                            <th scope="row">
                                                <i class="fa-solid fa-chevron-right fa-lg"></i>
                                            </th>
                                            <td class="text-info">
                                                <h6><?php echo $row['job_title']; ?></h6>
                                            </td>
                                            <td>
                                                <a href="view-job.php?id=<?php echo $row['jobpost_id']; ?>">
                                                    <i class="fa-solid fa-eye fa-lg ms-3"></i>
                                                </a>
                                            </td>
                                            <td class="fw-bold">
                                                <?php
                                                $status = $row['status'];
                                                $textColorClass = ($status == 2) ? 'text-warning' : 'text-danger';
                                                ?>
                                                <p class="<?php echo $textColorClass; ?>"><?php echo ($status == 2) ? 'Open' : 'Closed'; ?></p>
                                            </td>
                                            <td>
                                            <form id="deleteForm" action="../process/delete-job.php?id=<?php echo $row['jobpost_id']; ?>" method="POST">
                                                <input type="submit" name="delete" value="Delete" class="btn btn-outline-danger" onclick="return confirmDelete();">
                                            </form>

                                            <script>
                                                function confirmDelete() {
                                                    // Display a confirmation dialog
                                                    var isConfirmed = confirm("Are you sure you want to delete this Job?");

                                                    // If the user confirms, submit the form
                                                    return isConfirmed;
                                                }
                                            </script>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                else
                                {
                                    $_SESSION['no_jobs'] = "";
                                    
                                }
                                
                                ?>
                            </tbody>
                        </table>
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