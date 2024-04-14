<?php include 'header.php'; ?>
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
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
                        <h5><?php echo $greeting . ', <i>' . $_SESSION['username'] . '</i>'; ?></h5>
                </div>
                <?php include 'side-bar.html'; ?>
            </div>
        </div>
        <div class="col-md-9 mt-3">
            <div class="card">
            <div class="card-header">
                    <h5 class="text-center">List Of Posted Jobs</h5>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Company</th>
                                <th scope="col">Job </th>
                                <th scope="col" class="d-none d-sm-table-cell">Designation</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                @require_once '../config/config.php';
                                $query = "SELECT employers.company_name, job_post.job_title, job_post.designation, job_post.jobpost_id
                                FROM job_post
                                INNER JOIN employers ON job_post.company_id = employers.company_id";
                                $stmt = $connection->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0)
                                {
                                    while ($row = $result->fetch_assoc())
                                    { ?>
                                        <tr>
                                            <th scope="row"><i class="fa-solid fa-chevron-right fa-lg"></i></th>
                                            <td>
                                                <?php echo $row['company_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['job_title']; ?>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                <?php echo $row['designation']; ?>
                                            </td>
                                            <td>
                                                <form action="view-job.php" method="POST">
                                                    <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                    <input type="submit" value="Open" class="btn btn-outline-primary">
                                                </form>
                                            </td>
                                        </tr>
                                <?php }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>  
            </div> 
        </div>
    </div>
</div>
<!----- Footer Section starts here----->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>