    <!-----Navbar starts here----->
    <?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    
    <body>
    <!----Main body content-----> 
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4">
            <?php
                    if(isset($_SESSION['deleted']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Well !</strong> Hope you Add one More Soon.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['deleted']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['update_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hurray !</strong> Update Was Successfull.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['update_success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['entry_not_found']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hey !</strong> No entry Was Found.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['entry_not_found']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['image_size']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hey !</strong> File Size Too Big !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['image_size']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['data_failure']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed to Retrieve data
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['data_failure']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['image_error']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Ooops !</strong> Error While Uploading Image
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['image_error']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['allowed_extension']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Ooops !</strong> You can only upload JPEG, JPG or PNG file formats.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['allowed_extension']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['skill_added']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Congratulations !</strong> One More Achievement.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['skill_added']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['skill_not_added']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed to Add Skill, Try again
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['skill_not_added']);
                    }
                ?>
                <div class="card">
                    <div class="card-header text-center">
                        <?php
                        //Getting the current hour
                        date_default_timezone_set('Africa/Nairobi');
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
                    <?php include 'side-bar.html'; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="text-center">This is what We have on You .</h5>
                    </div>
                    <div class="card-body">
                        <?php
                         @require_once '../config/config.php';
                         $stmt = $connection->prepare("SELECT email, phone_number, occupation, study, description, skills FROM users WHERE user_id = ?");
                         $stmt->bind_param("i", $_SESSION['user_id']);
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
                                <h5>About You</h5>
                                <p class="text-muted"><?php echo $row['description']; ?></p>
                            </div>
                            <div>
                                <h5>Your Skills</h5>
                                <p class="text-muted"><?php echo $row['skills']; ?></p>
                            </div>
                            
                           <?php }
                         }
                        ?>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="card">
                        <div class="card-header">
                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                                Add Project
                            </button>
                        </div>
                        <div class="card-body">
                            <?php
                             require_once '../config/config.php';
                             $stmt = $connection->prepare("SELECT * FROM portfolio WHERE user_id = ?");
                             $stmt->bind_param("i", $_SESSION['user_id']);
                             $stmt->execute();
                             $result = $stmt->get_result();
                             if(!$result)
                             {
                                $_SESSION['data_failure'] = "";
                             }
                             else 
                             {
                                while($row = mysqli_fetch_assoc($result))
                                { ?>
                                    <div class="card shadow mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5 class="text-center"><?php echo $row['project_title']; ?></h5>
                                                    <a href="" style="text-decoration: none;"><p class="text-center"><i class="fas fa-globe fa-xl me-3"></i><br><?php echo $row['project_link']; ?></p></a>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <form action="edit-skill.php" method="GET">
                                                                <input type="hidden" name="id" value="<?php echo $row['portfolio_id']; ?>">
                                                                <input type="submit" value="Edit" class="btn btn-outline-primary">
                                                            </form> 
                                                        </div>
                                                        <div class="col-6">
                                                            <form id="deleteForm" action="../process/delete-skill-process.php" method="POST" onsubmit="return confirmDelete()">
                                                                <input type="hidden" name="id" value="<?php echo $row['portfolio_id']; ?>">
                                                                <input type="submit" name="delete_skill" value="Delete" class="btn btn-outline-danger">
                                                            </form>
                                                        </div>

                                                        <script>
                                                            function confirmDelete() {
                                                                // Display a confirmation dialog
                                                                var confirmation = confirm("Are you sure you want to delete ?");
                                                                
                                                                // If the user clicks "OK," the form will be submitted. If they click "Cancel," the form submission will be canceled.
                                                                return confirmation;
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5><?php echo $row['project_info']; ?></h5>
                                                    <p class="text-muted"> <?php echo $row['project_description']; ?> </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p>
                                                        <img src="../uploads/portfolio/<?php echo $row['project_image']; ?>" class="img-fluid rounded"  alt="">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               <?php }
                             }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Bootstrap Modal for Add Skill Form -->
                <div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="addSkillModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSkillModalLabel">Add Skill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Your form goes here -->
                                <form action="../process/add-skill-process.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="project_title"  class="form-control" placeholder="Occupation" required>
                                        <label for="floatingInput">Project Title</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="project_link"  class="form-control" placeholder="Occupation" required>
                                        <label for="floatingInput">Project Link</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="project_info"  class="form-control" placeholder="Occupation" required>
                                        <label for="floatingInput">One Sentence Description</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="textarea" name="project_description" placeholder="describe your Project" required id="floatingTextarea" style="height: 130px;" oninput="countWords()"></textarea>
                                        <label for="floatingTextarea">Description of your Project max-100 words . . .</label>
                                        <p id="wordCount" class="fw-bold text-success">Words remaining: <span id="count">70</span></p>
                                    </div>

                                    <script>
                                        function countWords() {
                                            const textarea = document.getElementById('textarea');
                                            const wordCount = document.getElementById('count');
                                            const maxWords = 70;

                                            const words = textarea.value.split(/\s+/).filter(function(word) {
                                                return word.length > 0;
                                            });

                                            wordCount.textContent = maxWords - words.length;

                                            if (words.length > maxWords) {
                                                wordCount.classList.remove('text-success');
                                                wordCount.classList.add('text-danger');
                                            } else {
                                                wordCount.classList.remove('text-danger');
                                                wordCount.classList.add('text-success');
                                            }
                                        }
                                    </script>
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Screenshot-Image Of Your Project</label>
                                        <input class="form-control" name="project_image" type="file" required id="formFileMultiple" multiple>
                                    </div>
                                    <button type="submit" name="add_skill" class="btn btn-primary">Save Skill</button>
                                </form>
                            </div>
                        </div>
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
