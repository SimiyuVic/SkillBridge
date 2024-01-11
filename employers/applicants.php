<?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    <body>
    <!----Main body content-----> 
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3">
            <?php
                    if(isset($_SESSION['job_under_review']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Job Status is Already Under Review !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['job_under_review']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['job_under_review_update']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application Status changed to Under Review !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['job_under_review_update']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['failed_change']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Failed to Change status, Try Again !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['failed_change']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['already_rejected']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application Status is Already Rejected !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['already_rejected']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['rejected']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Application Status changed to Rejected !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['rejected']);
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
            <?php
                    // Check if the alert has already been shown
                    if (!isset($_SESSION['dash_info_shown'])) {
                        $_SESSION['dash_info'] = "";
                        ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Hello !</strong> Click on View Profile to know more about your Applicant
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        // Set the flag to indicate that the alert has been shown
                        $_SESSION['dash_info_shown'] = true;
                    }
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="text-center">
                            A list of Applicants on your Job Posts
                        </h5>
                        <input class="form-control mb-4" id="cardSearch" type="text" placeholder="Search by Applicant Name / Job title e.g Intern . . .">
                    </div>
                    <div class="card-body" id="myCard">
                        <?php
                            require_once '../config/config.php';
                            $sql = "SELECT users.user_id, users.firstname, users.lastname, 
                            job_post.jobpost_id, job_post.job_title, job_post.designation,
                            applied_jobs.status
                            FROM applied_jobs
                            JOIN users ON applied_jobs.user_id = users.user_id
                            JOIN job_post ON applied_jobs.jobpost_id = job_post.jobpost_id
                            WHERE applied_jobs.company_id = ?";

                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param("i", $_SESSION['company_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $_SESSION['no_applicants'] = true;

                            if($result->num_rows > 0)
                            {
                                unset($_SESSION['no_applicants']);
                                while($row = $result->fetch_assoc())
                                { ?>
                                    <div class="card mb-1">
                                        <div class="card-body bg-light">
                                            <div class="row">
                                                <div class="col-6 col-lg-4 mb-1">
                                                    <h5><?php echo $row['firstname']; ?>  <?php echo $row['lastname']; ?></h5>
                                                    <form action="applicant-profile.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                        <input type="submit" value="View Profile" class="btn btn-outline-dark">
                                                    </form>
                                                </div>
                                                <div class="col-6 col-lg-3">
                                                    <h5>Job Tittle</h5>
                                                    <h6><?php echo $row['job_title']; ?></h6>
                                                    <?php
                                                        $status = $row['status'];

                                                        if ($status === 0) {
                                                            $statusText = 'Rejected';
                                                            $statusClass = 'text-danger';
                                                        } elseif ($status === 1) {
                                                            $statusText = 'Under Review';
                                                            $statusClass = 'text-info';
                                                        } elseif ($status === 2) {
                                                            $statusText = 'Pending Review';
                                                            $statusClass = 'text-primary';
                                                        } else {
                                                            // Handle other status values if needed
                                                            $statusText = 'Unknown Status';
                                                            $statusClass = 'text-secondary';
                                                        }
                                                    ?>
                                                    <h6>Status <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span></h6>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-6 mb-1">
                                                            <form action="../process/application-status.php" method="POST">
                                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"> 
                                                                <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                                <input type="submit" name="under_review" value="Mark Under Review" class="btn btn-info">
                                                            </form>
                                                        </div>
                                                        <div class="col-6 col-lg-6">
                                                            <form action="../process/application-status.php" method="POST">
                                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"> 
                                                                <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                                <input type="submit" name="reject_application" value="Reject Application" class="btn btn-danger" onclick="return confirmDelete();">
                                                            </form>
                                                            <script>
                                                                function confirmDelete() {
                                                                    // Display a confirmation dialog
                                                                    var isConfirmed = confirm("Are you sure you want to reject this Application?");

                                                                    // If the user confirms, submit the form
                                                                    return isConfirmed;
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                    <!-----No Results---->
                                    <div id="noResults" class="alert alert-warning" role="alert" style="display: none;">
                                        No results found.
                                    </div>
                                <?php }
                            }
                            else
                            {
                                $_SESSION['no_applicants'];
                            }
                            $stmt->close();
                            $connection->close();
                        ?>
                        <?php
                                if(isset($_SESSION['no_applicants']))
                                { ?>
                                    <div class="alert alert-info" role="alert">
                                        Job Applicants will be visible here only after your job posts have been applied on,
                                         if none is displayed be patient.
                                    </div>
                               <?php }
                            ?>
                    </div>
                            <script>
                                $(document).ready(function(){
                                    $("#cardSearch").on("keyup", function() {
                                        var value = $(this).val().toLowerCase();
                                        var found = false;

                                        $("#myCard .card").filter(function() {
                                            var rowText = $(this).text().toLowerCase();
                                            var isRowVisible = rowText.indexOf(value) > -1;
                                            $(this).toggle(isRowVisible);

                                            if (isRowVisible) {
                                                found = true;
                                            }
                                        });

                                        // Display or hide the info message based on search results
                                        $("#noResults").toggle(!found);
                                    });
                                });
                            </script>
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