<?php

session_start();

if(!isset($_SESSION['company_id']))
{
  header('location: ../employer-login.php');
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Create-Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/oyox4lvrma6uzyriloy2t3ljls4asn3ce7fg90wdu2uups41/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  </head>
  <body>
    <!---Navigatiob Bar Starts-->
      <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold text-light" href="#">Skill-Bridge</a>
          
        </div>
      </nav>


    <!---Navigatiob Bar Ends Here-->
    <!-- Other dashboard content goes here -->
    <div class="container my-3">
        <div class="row">   
            <!-- User Dashboard -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    <h4>Welcome, <?php echo $_SESSION['company']; ?>!</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <style>
                            /* Style the links */
                            .list-group-item a {
                                text-decoration: none; /* Remove text underline */
                                color: darkslategray; /* Set text color to dark */
                            }

                            /* Style the icons */
                            .list-group-item a i {
                                color: darkslategray; /* Set icon color to dark */
                                margin-right: 5px; /* Add margin between icons and text */
                            }
                        </style>

                        <!-- Edit Profile -->
                        <li class="list-group-item">
                            <a href="index.php">
                            <i class="fa-solid fa-gauge-high fa-lg"></i> Dashboard
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="edit-company.php">
                            <i class="fa-solid fa-building fa-lg"></i> My Company
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="create-job.php">
                            <i class="fa-solid fa-file-pen fa-lg"></i> Create Job Post
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="job-post.php">
                            <i class="fa-solid fa-book-open-reader fa-lg"></i>My Job Post
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="job-applications.php">
                            <i class="fa-solid fa-person-circle-question fa-lg"></i> Job Applications
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="mailbox.php">
                            <i class="fa fa-envelope"></i> MailBox
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="settings.php">
                            <i class="fa-solid fa-gear fa-lg"></i> Settings
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="resume-db.php">
                            <i class="fa-solid fa-database fa-lg"></i> Resume Database
                            </a>
                        </li>
                        <!-- Logout -->
                        <li class="list-group-item">
                            <a href="../log-out.php">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Create a Job -->
            <div class="col-md-8">
                <?php
                    if(isset($_SESSION['post_error_2'])){
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops ! </strong> Company id error
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['post_error_2']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['post_error'])){
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops ! </strong> Could Not Create A Job !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION['post_error']);
                    }
                ?>
                <!-- Display user information here -->
                <div class="card">
                  <div class="card-header">
                    <h4>Create Job Post</h4>
                  </div>
                  <div class="card-body">
                    <form action="../process/create-job-process.php" method="POST">
                      <div class="mb-3">
                        <input type="text" name="job_title" class="form-control" placeholder=" Job Title *" required>
                      </div>
                      <div class="mb-3">
                        <textarea name="job_description" class="form-control" id="job_description" cols="80" rows="4"></textarea>
                          <script>
                            tinymce.init({
                              selector: 'textarea',
                              plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                              tinycomments_mode: 'embedded',
                              tinycomments_author: 'Author name',
                              mergetags_list: [
                                { value: 'First.Name', title: 'First Name' },
                                { value: 'Email', title: 'Email' },
                              ],
                              ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                            });
                          </script>
                      </div>
                      <div class="mb-3">
                        <input type="number" name="salary" class="form-control" placeholder=" Salary " >
                      </div>
                      <div class="mb-3">
                        <input type="text" name="designation" class="form-control" placeholder=" Attachment or Internship *" required>
                      </div>
                      <div class="mb-3">
                        <input type="text" name="qualification" class="form-control" placeholder=" Minimum Qualification Required *" required>
                      </div>
                      <input type="submit" value="Post" name="post_job" class="btn btn-outline-primary">
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!----Footer Section--->
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