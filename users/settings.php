    <!-----Navbar starts here----->
    <?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    
    <body>
    <!----Main body content-----> 
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4">
                <?php
                    if(isset($_SESSION['change_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hurray !</strong> You Have Changed Your Password.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['change_success']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['change_fail']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed To Change Password !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['change_fail']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['wrong_password']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Your Old Password Does not Match !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['wrong_password']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['same_password']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> New Password Cannot Be same as Old Password !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['same_password']);
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Here you can Change Password or Deactivate Account</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5>Change Password</h5>
                                        <form action="../process/change-password-process.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input type="password" name="old_password" class="form-control" placeholder="Old Password" required>
                                                <label for="floatingInput">Enter Your Old Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
                                                <label for="floatingInput">Enter New Password</label>
                                            </div>
                                            <input type="submit" name="change_password" value="Change Password" class="btn btn-outline-info">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5>Deactivate Account</h5>
                                        <form action="">
                                            <div class="form-floating mb-3">
                                                <input type="password" name="study" class="form-control" placeholder="Study Level">
                                                <label for="floatingInput">Enter Your Email</label>
                                            </div>
                                            <input type="submit" value="Deactivate Account" name="deactivate" class="btn btn-outline-danger">
                                        </form>
                                    </div>
                                </div>
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
