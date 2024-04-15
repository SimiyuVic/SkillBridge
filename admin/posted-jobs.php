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
                    if ($currentHour >= 5 && $currentHour < 12) {
                        $greeting = "Good Morning";
                    } else if ($currentHour >= 12 && $currentHour < 17) {
                        $greeting = "Good Afternoon";
                    } else {
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
                    <!-- Search Form -->
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Company Name or Job Title" name="search">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Company</th>
                                <th scope="col">Job Title</th>
                                <th scope="col" class="d-none d-sm-table-cell">Designation</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            @require_once '../config/config.php';

                            // Pagination variables
                            $limit = 10; // Number of items per page
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $limit;

                            // Search Query
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            $searchParam = "%" . $search . "%";

                            $query = "SELECT employers.company_name, job_post.job_title, job_post.designation, job_post.jobpost_id
                                FROM job_post
                                INNER JOIN employers ON job_post.company_id = employers.company_id
                                WHERE employers.company_name LIKE ? OR job_post.job_title LIKE ?
                                LIMIT ?, ?";
                            $stmt = $connection->prepare($query);
                            $stmt->bind_param("ssii", $searchParam, $searchParam, $offset, $limit);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) { ?>
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
                    <!-- Pagination Links -->
                    <div class="pagination mt-3">
                        <?php
                        $query = "SELECT COUNT(*) as total FROM job_post";
                        $stmt = $connection->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();

                        $row = $result->fetch_assoc();
                        $total_pages = ceil($row['total'] / $limit);

                        if ($page > 1) {
                            echo '<a href="?page=' . ($page - 1) . '" class="btn btn-outline-secondary">&laquo; Previous</a>';
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo '<a href="?page=' . $i . '" class="btn btn-primary">' . $i . '</a>';
                            } else {
                                echo '<a href="?page=' . $i . '" class="btn btn-outline-primary">' . $i . '</a>';
                            }
                        }

                        if ($page < $total_pages) {
                            echo '<a href="?page=' . ($page + 1) . '" class="btn btn-outline-secondary">Next &raquo;</a>';
                        }
                        ?>
                    </div>
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
