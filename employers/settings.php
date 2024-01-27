<?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    <body>
    <!----Main body content-----> 
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3">
            <?php
                    if(isset($_SESSION['login_success']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Welcome !</strong> <?php echo $_SESSION['username'];  ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['login_success']);
                    }
                ?>
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
                <div class="alert alert-warning" role="alert">
                    You can choose to Update your Password, or Change logo or De-activate your Account !
                </div>
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5>Change Password</h5>
                                <form action="../process/employerChangePassword.php" method="POST" class="mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="old_password" class="form-control" placeholder="Password">
                                        <label for="floatingInput">Old Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="new_password" class="form-control" placeholder="Password">
                                        <label for="floatingInput">New Password</label>
                                    </div>
                                    <input type="submit" value="Change Password" name="change_password" class="btn btn-outline-primary">
                                </form>
                                <?php
                                    require_once '../config/config.php';
                                    $sql = "SELECT company_logo FROM employers WHERE company_id = ?";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("i", $_SESSION['company_id']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if($row = $result->fetch_assoc())
                                    { ?>
                                        <div class="card-body">
                                            <img src="../uploads/company_logo/<?php echo $row['company_logo']; ?>" class="img-thumbnail rounded-circle" alt="Company Logo" style="width: 200px; height: 200px;">
                                        </div>
                                        <h5>Edit Logo</h5>
                                        <form action="" method="POST">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Select New Logo</label>
                                                <input class="form-control" type="file" id="formFile">
                                            </div>
                                            <input type="submit" value="Upload" name="upload_pic" class="btn btn-outline-warning">
                                        </form>
                                   <?php }
                                    else
                                    { ?>
                                        <div class="alert alert-warning" role="alert">
                                            No company Logo to display !
                                        </div>
                                    <?php }
                                    $stmt->close();
                                    $connection->close();
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5>Deactivate Account</h5>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <label for="floatingInput">Enter Email</label>
                                </div>
                                <input type="submit" value="Deactivate Account" name="deactivate" class="btn btn-outline-danger">
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