<?php
session_start();

if(isset($_SESSION['user_id']) || isset($_SESSION['company_id']))
{
  $_SESSION['account_exists'] = "";
  header('location: index.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       <style>
          .navbar-brand {
              font-family: 'Pacifico', cursive; /* Set the font-family to 'Pacifico' or your chosen curly font */
          }
      </style>

  </head>
  <body>
        <!---Navigatiob Bar Starts-->
        <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand fw-bold text-light" href="index.php">Skill-Bridge</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="#">Jobs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="login.php">Log In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="register.php">Sign Up</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!---Navbar Ends Here--->
      <div class="container my-2">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">CREATE YOUR COMPANY PROFILE</h4>
          </div>
          <div class="card-body">
            <form action="process/employer-register-process.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                        <?php
                            if(isset($_SESSION['email_error'])){
                                ?>

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hey ! </strong> Similar Email Already Exists !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            unset($_SESSION['email_error']);
                            }
                        ?>
                        <?php
                            if(isset($_SESSION['upload_error'])){
                                ?>

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops ! </strong> Error while uploading logo !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            unset($_SESSION['upload_error']);
                            }
                        ?>
                        <?php
                            if(isset($_SESSION['image_size'])){
                                ?>

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops ! </strong> Image size is too Large !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            unset($_SESSION['image_size']);
                            }
                        ?>
                  <div class="mb-3">
                    <input type="text" name="fullname" class="form-control" placeholder=" FullName *" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" name="company" class="form-control" placeholder=" Company Name *" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" name="website" class="form-control" placeholder=" Website *" required>
                  </div>
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder=" Email *" required>
                  </div>
                  <div class="mb-3">
                    <textarea name="about_company" class="form-control" id="about_company" cols="80" rows="4" placeholder="Brief info about Your Company"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder=" Password *" required>
                  </div>
                  <div class="mb-3">
                    <input type="number" name="phone_number" class="form-control" placeholder=" PhoneNumber *" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" name="county" class="form-control" placeholder=" County *" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" name="city" class="form-control" placeholder=" City *" required>
                  </div>
                  <div class="mb-3">
                    <label for="logo" class="mb-2 fw-bold">Company Logo</label>
                    <input type="file" name="logo" class="form-control" > 
                  </div>
                </div>
              </div>
              <input type="submit" value="Register" name="register" class="btn btn-outline-primary">
            </form>
          </div>
        </div>
      </div>


      <!---Footer Section--->
      <footer class="main-footer my-4" style="margin-left: 0px;">
    <div class="text-center  ">
      <strong>Copyright &copy; 2023 <a href="index.php">Skill-Bridge</a>.</strong> All rights
    reserved.
    </div>
  </footer>

<script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>