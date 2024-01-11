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
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">
                            Search Through a list of your Applicants
                        </h5>
                    </div>
                    <div class="card-body">
                        <!------Search function with filter by name or Job title----->
                        <div class="container">
                            <input class="form-control mb-4" id="tableSearch" type="text" placeholder="Search by Applicant Name / Email or Job title . . .">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Applicant Name</th>
                                        <th scope="col">Job Title</th>
                                        <th scope="col">Applicant Name</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php 
                                        require_once '../config/config.php';
                                        $sql = "SELECT users.user_id, users.firstname, users.lastname,users.email, 
                                        job_post.jobpost_id, job_post.job_title, job_post.designation,
                                        applied_jobs.status
                                        FROM applied_jobs
                                        JOIN users ON applied_jobs.user_id = users.user_id
                                        JOIN job_post ON applied_jobs.jobpost_id = job_post.jobpost_id
                                        WHERE applied_jobs.company_id = ? AND applied_jobs.status = 1";

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
                                            <tr>
                                                <th scope="row">
                                                    <i class="fas fa-chevron-right fa-lg"></i>
                                                </th>
                                                <td>
                                                    <h6 class="text-primary"><?php echo $row['firstname']; ?>  <?php echo $row['lastname']; ?></h6>
                                                    <form action="applicant-profile.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                        <input type="submit" value="View Profile" class="btn btn-outline-dark">
                                                    </form>
                                                </td>
                                                <td>
                                                    <h6 class="text-primary"><?php echo $row['job_title']; ?></h6>
                                                </td>
                                                <td>
                                                    <h6 class="text-primary"><?php echo $row['email']; ?></h6>
                                                </td>
                                            </tr>
                                            <?php }
                                        }
                                        else
                                        { 
                                           $_SESSION['no_applicants'];
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Info message for no results -->
                            <div id="noResults" class="alert alert-warning" role="alert" style="display: none;">
                                No results found.
                            </div>
                            <?php
                                if(isset($_SESSION['no_applicants']))
                                { ?>
                                    <div class="alert alert-info" role="alert">
                                        Only Job Applications with status Under Review will be visible here !
                                        To do that click on View Applicants and select your preffered candidates
                                    </div>
                               <?php }
                            ?>
                            <!-- Add the JavaScript code here -->
                            <script>
                                $(document).ready(function(){
                                    $("#tableSearch").on("keyup", function() {
                                        var value = $(this).val().toLowerCase();
                                        var found = false;

                                        $("#myTable tr").filter(function() {
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
        </div>
    </div>
    </body>
 <!----- Footer Section starts here----->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html> 