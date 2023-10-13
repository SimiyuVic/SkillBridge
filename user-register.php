<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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


    <!---Navigatiob Bar Ends Here-->
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">
                CREATE YOUR PROFILE  
            </h3>
        </div>
            <div class="card-body">
                <form action="process/user-register-process.php" method="POST">
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
                            <div class="mb-3">
                                <input type="text" name="firstname" class="form-control" placeholder=" First Name *" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="lastname" class="form-control" placeholder=" Last Name *" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder=" Email *" required>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="phone_number" class="form-control" placeholder=" Phone Number">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder=" Password *" required>
                            </div>  
                            <div class="mb-3 form-group checkbox">
                                <label >
                                    <input type="checkbox" required>
                                        I accept Terms and Conditions
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text" name="qualification" class="form-control" placeholder=" Highest Qualification *" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="occupation" class="form-control" placeholder=" Current Occupation Student/ Graduate">
                            </div>
                            <div class="mb-3">
                                <textarea name="about_me" class="form-control" id="about_me" cols="80" rows="4" required placeholder="Brief description about you *"></textarea>
                            </div>
                            <div class="mb-3">
                                <textarea name="skills" class="form-control" id="skills" cols="80" rows="4" placeholder="Skills"></textarea>
                            </div>
                        </div>  
                    </div>
                        <input type="submit" class="btn btn-primary" name="register" value="Register">
                    </div>
                </form>
            </div>
    </div>
</div>


<footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center  ">
      <strong>Copyright &copy; 2023 <a href="index.php">Skill-Bridge</a>.</strong> All rights
    reserved.
    </div>
  </footer>

<script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>




                           