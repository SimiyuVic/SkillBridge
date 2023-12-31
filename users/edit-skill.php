<?php

session_start();

//Check if user is logged in
if(!isset($_SESSION['user_id']))
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
    <div class="container my-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <?php
                    if(isset($_SESSION['update_fail']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed To Update !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['update_fail']);
                    }
                ?>
                <div class="card">
                    <div class="card-header text-center">
                        <?php
                        //Getting the current hour
                            $currentHour = date('G');
                        //Greeting based on time of the day.
                        if($currentHour >= 5 && $currentHour < 12)
                        {
                            $greeting = "Good Morning";
                        }
                        else if($currentHour >=12 && $currentHour < 18)
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
                        <a href="applied-jobs.php" style="text-decoration: none;">
                            <li class="list-group-item">
                            <i class="fas fa-folder-open fa-lg me-3"></i> Applied Jobs
                            </li>
                        </a>
                        <a href="portfolio.php" style="text-decoration: none;">
                            <li class="list-group-item">
                                <i class="fab fa-pagelines fa-lg me-3"></i> Portfolio
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
            <?php
                @require_once '../config/config.php';
                $portfolio_id = $_GET['id'];

                $sql = "SELECT *  FROM portfolio WHERE user_id = ? AND portfolio_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("ii", $_SESSION['user_id'], $portfolio_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if(!$result)
                {
                    die("Error executing the query: " . mysqli_error($connection));
                }
                else
                {
                    while($row = mysqli_fetch_assoc($result))
                    { ?>
                    <div class="col-md-6">
                    <form action="../process/edit-skill-process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['portfolio_id']; ?>">
                            <div class="card-header text-center">
                                <h5 class="text-muted">Edit Your Project Here</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="project_title" class="form-control" placeholder="Project Title" value="<?php echo $row['project_title']; ?>" required>
                                            <label for="floatingInput">Project Title</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="project_link" class="form-control" placeholder="Project Link" value="<?php echo $row['project_link']; ?>" required>
                                            <label for="floatingInput">Project Link</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="project_info" class="form-control" placeholder="Project info" value="<?php echo $row['project_info']; ?>" required>
                                            <label for="floatingInput">One Sentence Description</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="project_description" placeholder="describe your skills" id="floatingTextarea" style="height: 130px;" required><?php echo $row['project_description']; ?></textarea>
                                            <label for="floatingTextarea">What Skills do you have ? . . .</label>
                                        </div>
                                        <div>
                                             <img src="../uploads/portfolio/<?php echo $row['project_image']; ?>" class="img-fluid rounded mb-3"  alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                                <input type="submit" name="edit_project" value="Update" class="btn btn-outline-primary">
                            </div>
                        </div>
                    </form>
                </div>
            <?php }
            }
            $stmt->close();
            $connection->close();
            ?>
            
        </div>
    </div>   

    </body>
 <!----- Footer Section starts here----->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>    
