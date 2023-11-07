<?php
session_start();

@require_once 'config/config.php';

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
              <?php if(empty($_SESSION['user_id']) && empty($_SESSION['company_id'])){

                ?>
                  <li class="nav-item ">
                    <a class="nav-link active fw-bold text-light" aria-current="page" href="login.php">Login</a>
                  </li>
                 <li class="nav-item ">
                   <a class="nav-link active fw-bold text-light" aria-current="page" href="register.php">Sign-Up</a>
                </li>
                <?php

              } else { 
                if(isset($_SESSION['user_id'])){
                  ?>

                  <li class="nav-item ">
                   <a class="nav-link active fw-bold text-light" aria-current="page" href="users/index.php">Dashboard</a>
                  </li>

                  <?php
                } elseif(isset($_SESSION['company_id'])){
                  ?>
                    <li class="nav-item ">
                      <a class="nav-link active fw-bold text-light" aria-current="page" href="employers/index.php">Dashboard</a>
                    </li>
                  
                <?php }

              }
               ?>
              
            </ul>
          </div>
        </div>
      </nav>


    <!---Navigation Bar Ends Here-->

    <!----Job section starts here--->
    <div>
        <?php
            $sql = "SELECT * FROM vacancies INNER JOIN employers ON vacancies.company_id=employers.company_id WHERE jobpost_id='$_GET[id]'";
            $result = mysqli_query($connection, $sql);

            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_assoc($result))
                { ?>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-9 bg-light">
                            <div class="border-bottom" style="display: flex; justify-content: space-between;">
                                <h4 class="my-5"><i><?php echo $row['job_title']; ?></i></h4>
                                <div class="btn btn-secondary text-light my-5"><a href="index.php" style="text-decoration: none;" class="text-white"><i class="fa-solid fa-arrow-left fa-xl"></i><span> Back</span></a></div>
                            </div>
                            <div class="mt-3">
                                <p>
                                    <span class="fw-bold text-primary">
                                        <i class="fa-regular fa-circle-check fa-xl"></i> <?php echo $row['designation']; ?> |
                                        <i class="fa-solid fa-location-dot fa-xl"></i> <?php echo $row['county']; ?> |
                                        <i class="fa-solid fa-calendar-check fa-xl"></i> <?php echo date("d-M-Y", strtotime($row['created_at'])); ?> |

                                    </span>
                                </p>
                                <p>
                                    <span class="fw-bold text-primary">
                                        <i class="fa-solid fa-clipboard-question fa-xl"></i> <?php echo $row['qualification']; ?> |
                                    </span>
                                </p>
                                <p>
                                    <span class="fw-bold text-primary">
                                        <i class="fa-solid fa-wallet fa-lg"></i> KES. <?php echo $row['salary']; ?> |
                                    </span>
                                </p>
                            </div>
                            <div>
                             <?php echo stripcslashes($row['job_description']); ?>
                            </div>
                            <?php
                                if(isset($_SESSION['user_id']) && empty($_SESSION['company_id']))
                                { ?>
                                    <div>
                                        <a href="process/apply-job-process.php?=<?php echo $row['jobpost_id']; ?>" class="btn btn-outline-primary">Apply Job</a>
                                    </div>
                              <?php  }
                            ?>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow" style="width: 18rem;">
                                <img src="uploads/logo/<?php echo $row['logo']; ?>" alt="">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4 class="text-center"><?php echo $row['company'];?></h4>
                                        <style>
                                            .center {
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                    }
                                        </style>
                                        <div class="center">
                                        <a href="#" class="btn btn-outline-secondary text-center">View Company</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
               <?php }
            }
        ?>
    </div>
    <!----Job section ends here--->

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