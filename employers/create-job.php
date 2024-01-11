<?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    <body>
    <!----Main body content-----> 
    <div class="container my-3">
        <div class="row">
            <div class="col-md-3 mb-3">
                <?php
                    if(isset($_SESSION['empty_description']))
                    { 
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Job Descripton is Empty !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['empty_description']);
                    }
                ?>
                <?php
                    if(isset($_SESSION['create_fail']))
                    { 
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops !</strong> Failed to Create Job, Try again !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['create_fail']);
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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Create A Job Post</h5>
                    </div>
                    <form action="../process/create-job.php" method="POST">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="job_title" id="floatingInput" placeholder="Job tittle" required>
                                <label for="floatingInput">Job Tittle</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="job_description" placeholder="Job Description Here" id="floatingTextarea"></textarea>
                            </div>
                                <script>
                                    tinymce.init({
                                        selector: 'textarea',
                                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough |  align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                    });
                                </script>
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="designation" id="floatingInput" placeholder="Designation" required>
                                <label for="floatingInput">Job Designation (Entry-Level/Internship/Attachment)</label>
                            </div>
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="qualification" id="floatingInput" placeholder="Job tittle" required>
                                <label for="floatingInput">Qualification Level(Degree/Diploma)</label>
                            </div>
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="location" id="floatingInput" placeholder="Job location" required>
                                <label for="floatingInput">Location (County/ City)</label>
                            </div>
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="expected_salary" id="expectedSalary" placeholder="Enter expected salary" oninput="formatSalary(this)">
                                <label for="floatingInput">Salary</label>
                                <script>
                                    function formatSalary(input) {
                                        // Remove non-numeric characters
                                        let value = input.value.replace(/[^0-9]/g, '');

                                        // Add commas every three digits from the right
                                        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                                        // Set the formatted value back to the input
                                        input.value = value;
                                    }
                                </script>
                            </div>
                            <div class="form-floating my-3">
                                <input type="number" class="form-control" name="duration" min="1" id="floatingInput" placeholder="Duration" required>
                                <label for="floatingInput">Job Post Duration (in days):</label>
                            </div>
                            <input type="submit" value="Create Job" class="btn btn-outline-primary" name="create_job">
                        </div>
                    </form>
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
