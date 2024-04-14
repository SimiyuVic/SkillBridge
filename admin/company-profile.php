<?php

session_start();

//Check if user is logged in
if(!isset($_SESSION['admin_id']))
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
    <title>Skill-Bridge | Applicant-Profile</title>
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
                        <h5><?php echo $greeting . ', <i>' . $_SESSION['username'] . '</i>'; ?></h5>
                    </div>
                     <?php include 'side-bar.html'; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <!--------Basic user Info-------->
                <?php
                    require_once '../config/config.php';
                    $company_id = $_POST['company_id'];

                    $sql = "SELECT username, company_name, email, phone_number, website, county, company_logo, description
                    FROM employers WHERE company_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("i", $company_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        { ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <a href="employers.php">
                                        <button class="btn btn-outline-primary">Back</button>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fas fa-building fa-xl me-3"></i><?php echo $row['company_name']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fa-solid fa-user-pen fa-lg me-3"></i><?php echo $row['username']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fas fa-phone-alt fa-lg me-3"></i><?php echo $row['phone_number']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fa-solid fa-globe fa-lg me-3"></i><?php echo $row['website']; ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>About</h5>
                                        <p class="text-muted"><?php echo $row['description']; ?></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingTextarea" class="form-label text-muted fw-bold">Company Logo</label><br>
                                        <img src="../uploads/company_logo/<?php echo $row['company_logo']; ?>" class="img-thumbnail rounded-circle" alt="Company Logo" style="width: 200px; height: 200px;">
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                    else 
                    {
                        //no profile
                    }
                    
                ?>
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