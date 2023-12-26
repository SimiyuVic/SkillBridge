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
                <?php
                    if(isset($_SESSION['edit_success']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hurray !</strong> Profile Updated Successfully
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['edit_success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['edit_fail']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed to Update Profile
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['edit_fail']);
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
                            <a href="manage-applications.php" style="text-decoration: none;">
                                <li class="list-group-item">
                                <i class="fa-solid fa-people-roof fa-xl me-3"></i> Manage Applications
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
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Edit Your Profile</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        require_once '../config/config.php';
                         $sql = "SELECT username, company_name, email, phone_number, website, county, city, description, company_logo FROM employers WHERE company_id = ?";
                         $stmt = $connection->prepare($sql);
                         $stmt->bind_param("i", $_SESSION['company_id']);
                         $stmt->execute();
                         $result = $stmt->get_result();

                         if(!$result)
                         {
                            $_SESSION['no_data'] = "";
                            header('location: edit-profile.php');
                         }
                         else
                         {
                            while($row = mysqli_fetch_assoc($result))
                            { ?>
                                <form action="../process/employer-edit-process.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" value="<?php echo $row['username']; ?>" required>
                                                    <label for="floatingInput">UserName</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="company_name" id="floatingInput" placeholder="Company Name" value="<?php echo $row['company_name']; ?>" required>
                                                    <label for="floatingInput">Company Name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                                                    <label for="floatingInput">Email</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" name="phone_number" id="floatingInput" placeholder="Phone Number" value="<?php echo $row['phone_number']; ?>" required>
                                                    <label for="floatingInput">Phone Number</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="url" class="form-control" id="floatingInput" name="website" placeholder="Website" value="<?php echo $row['website']; ?>" pattern="^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$" required>
                                                    <label for="floatingInput">Website (e.g https://www.example.com)</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="county" id="floatingInput" placeholder="County" value="<?php echo $row['county']; ?>" required>
                                                    <label for="floatingInput">County</label>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="city" id="floatingInput" placeholder="City" value="<?php echo $row['city']; ?>" required>
                                                <label for="floatingInput">City</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea" style="height: 130px;" required><?php echo $row['description']; ?></textarea>
                                                <label for="floatingTextarea">Describe your company in less than 200 words . . . </label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="floatingTextarea" class="form-label text-muted fw-bold">Company Logo</label><br>
                                                <img src="../uploads/company_logo/<?php echo $row['company_logo']; ?>" alt="Image" class="img-fluid">  
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" value="Edit Profile" class="btn btn-outline-primary " name="edit_employer">
                                </form>
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