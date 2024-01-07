    <!-----Navbar starts here----->
    <?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    
    <body>
    <!----Main body content-----> 
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4">
            <?php
                    if(isset($_SESSION['applied']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application was Successful
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['applied']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['no_job']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> You have not applied yet 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['no_job']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['failed_delete']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Could not Delete Job Post !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['deleted']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['deleted']))
                    { 
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Job Post Deleted !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['deleted']);
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
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">
                            Here are your Applied Jobs
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Job Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once '../config/config.php';
                                    $user_id = $_SESSION['user_id'];
                                    $sql = "SELECT employers.company_name, job_post.job_title, applied_jobs.appliedjobs_id, applied_jobs.status
                                    FROM applied_jobs
                                    JOIN employers ON applied_jobs.company_id = employers.company_id
                                    JOIN job_post ON applied_jobs.jobpost_id = job_post.jobpost_id
                                    WHERE applied_jobs.user_id = ?"; 
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("i", $user_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if($result->num_rows > 0)
                                    {
                                        while ($row = $result->fetch_assoc())
                                        { ?>
                                            <tr>
                                                <th scope="row">
                                                    <i class="fas fa-chevron-right fa-lg"></i>
                                                </th>
                                                <td class="text-info">
                                                    <?php echo $row['company_name']; ?>
                                                </td>
                                                <td class="text-primary">
                                                    <?php echo $row['job_title']; ?>
                                                </td>
                                                <td class="fw-bold">
                                                    <?php
                                                    $status = $row['status'];
                                                    $textColorClass = ($status == 2) ? 'text-info' : (($status == 1) ? 'text-warning' : 'text-danger');
                                                    $statusText = ($status == 2) ? 'Pending' : (($status == 1) ? 'Under Review' : 'Rejected');
                                                    ?>
                                                    <p class="<?php echo $textColorClass; ?>"><?php echo $statusText; ?></p>
                                                </td>
                                                <!--------
                                                <td>
                                                    <form id="deleteForm" action="../process/delete-applied-job.php" method="POST">
                                                        <input type="hidden" name="aplliedjobs_id" value="<?php //echo $row['aplliedjobs_id']; ?>">
                                                        <input type="submit" name="delete" value="Delete" class="btn btn-outline-danger" onclick="return confirmDelete();">
                                                    </form>
                                                    <script>
                                                        function confirmDelete() {
                                                            // Display a confirmation dialog
                                                            var isConfirmed = confirm("Are you sure you want to delete this Job?");

                                                            // If the user confirms, submit the form
                                                            return isConfirmed;
                                                        }
                                                    </script>
                                                </td>
                                                ----->
                                            </tr>
                                       <?php }
                                    }
                                    else
                                    {
                                        $_SESSION['no_job'] = "";
                                        
                                    }
                                ?>
                            </tbody>
                        </table>
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
