<?php

session_start();

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
            <a class="navbar-brand fw-bold" href="index.php">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <li class="nav-item">
                    <?php
                    if(isset($_SESSION['user_id'])) { ?>
                        <a class="nav-link" href="users/index.php">Dashboard</a>
                    <?php } elseif(isset($_SESSION['company_id'])) { ?>
                        <a class="nav-link" href="employers/index.php">Dashboard</a>
                    <?php } else { ?>
                        <a class="nav-link" href="sign-up.php">Sign Up</a>
                    <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
        <div class="container-fluid mt-3">
            <?php
                if(isset($_SESSION['job_exists']))
                { 
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey !</strong> You Already Applied to this Job, here is More to choose from !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['job_exists']);
                }
            ?>
            <?php
                if(isset($_SESSION['apply_failed']))
                { 
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Hey !</strong> Job Application Failed 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['apply_failed']);
                }
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="ms-2">
                        <h5 class="text-muted">
                            Latest jobs abd Vacancies for Students, recent Graduates and Entry level trainees
                        </h5>
                        <p class="lead">
                            We have a wide range of employers seeking bright and amazing talent, make sure your portfolio 
                            is well set, your information is correct and continue learning to increase your chance of success.
                            We offer a platform but you are the controller.
                        </p>
                        <div class="card">
                            <div class="card-body">
                                <input class="form-control mb-4" id="containerSearch" type="text" placeholder="Search By Job Title">
                                <input class="form-control mb-4" id="containerSearch" type="text" placeholder="Search By Location">
                                <input class="form-control mb-4" id="containerSearch" type="text" placeholder="Search By Qualification /Field of Study">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <section>
                        <?php
                            $sql = "SELECT employers.company_name, employers.description, employers.company_logo,
                            job_post.job_title, job_post."
                        ?>
                    </section>
                </div>
            </div>

  
        </div>
    <!----- Footer Section starts here----->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>