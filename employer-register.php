
<?php
session_start();

if (isset($_SESSION['company_id'])) {
    $_SESSION['already_logged'] = true;
    header('location: employers/index.php');
} elseif (isset($_SESSION['user_id'])) {
    $_SESSION['already_logged'] = true;
    // You may redirect to a different location for users, e.g., 'users/index.php'
    header('location: users/index.php');
}
else
{ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Register</title>
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
            <a class="navbar-brand fw-bold" href="index.php">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <?php
                    if(isset($_SESSION['invalid_email']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Invalid Email Format
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['invalid_email']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['image_error']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Error while uploading Image
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['image_error']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['image_size']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Logo file is too large. Maximum size allowed: 2MB.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['image_size']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['extension_error']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Invalid logo format. Allowed formats: JPG, JPEG, PNG.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['extension_error']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['email_exists']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Your Email Already Exists.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['email_exists']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['register_fail']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed to Register, Try again !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['register_fail']);
                    }
                ?>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Register Here !</h4>
                </div>
                <div class="card-body">
                    <form action="process/employer-register-process.php" method="POST" enctype="multipart/form-data">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="User Name" required>
                                    <label for="floatingInput">User Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                                    <label for="floatingInput">Company Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Email" required>
                                    <label for="floatingInput">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" name="phone_number" class="form-control" placeholder="Phone" required>
                                    <label for="floatingInput">Phone Number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="website"  class="form-control" placeholder="Website" required>
                                    <label for="floatingInput">Company Website</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="county"  class="form-control" placeholder="County" required>
                                    <label for="floatingInput">County</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="city"  class="form-control" placeholder="City" required>
                                    <label for="floatingInput">City</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Study Level" required>
                                    <label for="floatingInput">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="description" placeholder="describe your company" id="floatingTextarea" style="height: 130px;" required></textarea>
                                    <label for="floatingTextarea">A Description of your Company . . .</label>
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label fw-bold">Company Logo</label>
                                    <input class="form-control" name="company_logo" type="file" required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="register" value="Register" class="btn btn-outline-primary">
                    </form>
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
<?php }
?>   