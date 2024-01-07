    
    <!-----Navbar starts here----->
    <?php include 'header.php'; ?>
    <!-----Navbar ends here----->

    <body>
    <!----Main body content-----> 
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4">
                <?php
                    if(isset($_SESSION['update_fail']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Profile could not be Updated
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['update_fail']);
                    }
                ?>
                <div class="card">
                    <div class="card-header text-center">
                        <?php
                        date_default_timezone_set('Africa/Nairobi');
                        //Getting the current hour
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
            <?php
                @require_once '../config/config.php';

                $sql = "SELECT firstname, lastname, email, phone_number, occupation, study, description, skills FROM users WHERE user_id = ?";
                $stmt = $connection->prepare($sql);
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
                    <div class="col-12 col-lg-9">
                    <form action="../process/edit-profile-process.php" method="POST">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5 class="text-muted">Edit Your Profile Here</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $row['firstname']; ?>" required>
                                            <label for="floatingInput">FirstName</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname']; ?>" required>
                                            <label for="floatingInput">lastname</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                                            <label for="floatingInput">Email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" value="<?php echo $row['phone_number']; ?>" required>
                                            <label for="floatingInput">Phone Number</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="occupation" class="form-control" placeholder="Occupation" value="<?php echo $row['occupation']; ?>" required>
                                            <label for="floatingInput">Occupation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                            <input type="text" name="study" class="form-control" placeholder="Study" value="<?php echo $row['study']; ?>" required>
                                            <label for="floatingInput">Level of Study</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea" style="height: 130px;" required><?php echo $row['description']; ?></textarea>
                                            <label for="floatingTextarea">Describe Yourself . . . </label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="skills" placeholder="Leave a comment here" id="floatingTextarea" style="height: 130px;" required><?php echo $row['skills']; ?></textarea>
                                            <label for="floatingTextarea">What Are your Skills . . . </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="Edit" value="Update" class="btn btn-outline-primary">
                            </div>
                        </div>
                    </form>
                </div>
            <?php }
            }
            $stmt->close();
            $connection->close();
            ?>
            
        </div>
    </div>   

    </body>
 <!----- Footer Section starts here----->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>    
