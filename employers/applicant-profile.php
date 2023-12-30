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
                     <?php include 'side-bar.html'; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <!--------Basic user Info-------->
                <?php
                    require_once '../config/config.php';
                    $user_id = $_POST['user_id'];

                    $sql = "SELECT firstname, lastname, email, phone_number,occupation,study,description, skills
                    FROM users WHERE user_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        { ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <a href="applicants.php">
                                        <button class="btn btn-outline-primary">Back</button>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fas fa-envelope fa-lg me-3"></i><?php echo $row['email']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fas fa-phone-alt fa-lg me-3"></i><?php echo $row['phone_number']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fas fa-laptop-house fa-xl me-3"></i><?php echo $row['occupation']; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted"><i class="fas fa-user-graduate fa-xl me-3"></i><?php echo $row['study']; ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>About</h5>
                                        <p class="text-muted"><?php echo $row['description']; ?></p>
                                    </div>
                                    <div>
                                        <h5>Skills</h5>
                                        <p class="text-muted"><?php echo $row['skills']; ?></p>
                                    </div>
                                    <form action="" method="POST">
                                        <input type="submit" value="Download Resume" class="btn btn-warning">
                                    </form>
                                </div>
                            </div>
                        <?php }
                    }
                    else 
                    {
                        //no profile
                    }
                    
                ?>
                <!--------Skills Added by user------>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Projects / Skills added . . .</h5>
                    </div>
                    <div class="card-body">
                    <?php
                        require_once '../config/config.php';
                        $user_id = $_POST['user_id'];
                        
                        $stmt_get_skills = $connection->prepare("SELECT project_title, project_link, project_info, project_description, project_image 
                        FROM portfolio WHERE user_id = ?");
                        $stmt_get_skills->bind_param("i", $user_id);
                        $stmt_get_skills->execute();
                        $skills_result = $stmt_get_skills->get_result();
                        if($skills_result->num_rows > 0)
                        {
                            while($row = $skills_result->fetch_assoc())
                            { ?>
                            <div class="card mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5><?php echo $row['project_title']; ?></h5>
                                            <h6><?php echo $row['project_info']; ?></h6>
                                            <!-- Add a span to wrap the project link and an icon for copy -->
                                        <p class="text-primary project-link-container">
                                            <?php echo $row['project_link']; ?>
                                            <i class="fa-regular fa-copy fa-lg ms-2 copy-icon"></i>
                                        </p>
                                        <!-- Message to display when link is copied -->
                                        <div id="copyMessage" class="text-success d-none">Copied Link</div>

                                        <!-- Add the following script to enable copy functionality -->
                                        <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Get the project link container, copy icon, and message element
                                            var projectLinkContainer = document.querySelector('.project-link-container');
                                            var copyIcon = document.querySelector('.copy-icon');
                                            var copyMessage = document.getElementById('copyMessage');

                                            // Add a click event listener to the project link container
                                            projectLinkContainer.addEventListener('click', function() {
                                                // Create a temporary input element
                                                var tempInput = document.createElement('input');
                                                tempInput.value = projectLinkContainer.textContent;
                                                document.body.appendChild(tempInput);

                                                // Select the text in the input
                                                tempInput.select();
                                                tempInput.setSelectionRange(0, 99999); /*For mobile devices*/

                                                // Copy the text to the clipboard
                                                document.execCommand('copy');

                                                // Remove the temporary input element
                                                document.body.removeChild(tempInput);

                                                // Display the "Copied Link" message
                                                copyMessage.classList.remove('d-none');

                                                // Optionally, provide some visual feedback to the user
                                                copyIcon.classList.add('text-success'); // Change color to indicate success
                                                setTimeout(function() {
                                                    copyIcon.classList.remove('text-success'); // Reset the color after 2 seconds
                                                    copyMessage.classList.add('d-none'); // Hide the message after 2 seconds
                                                }, 2000);
                                            });
                                        });
                                        </script>

                                            <img src="../uploads/portfolio/<?php echo $row['project_image'];?>" class="img-thumbnail rounded mx-auto d-block" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <p class="text-success"><?php echo $row['project_description'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        }
                        else
                        { ?>
                            <div class="alert alert-info" role="alert">
                                Applicant has not added a Skill or a Project yet, when it is done it will be displayed Here.
                            </div>
                        <?php }
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