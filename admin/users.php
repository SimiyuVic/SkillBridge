<?php include 'header.php'; ?>
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
            <?php
                if(isset($_SESSION['activated']))
                { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Done !</strong> User Account Activated!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['activated']);
                 }
            ?>
            <?php
                if(isset($_SESSION['de-activated']))
                { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops !</strong> User Account  Deactivated!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php  unset($_SESSION['de-activated']);
                }
            ?>
            <div class="card">
                <?php include 'dashboard-greet.php'; ?>
                <?php include 'side-bar.html'; ?>
            </div>
        </div>
        <div class="col-md-9 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">List Of Registered Users</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by User Name" name="search">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User-Name</th>
                                <th scope="col" class="d-none d-sm-table-cell">Email</th>
                                <th scope="col" class="d-none d-sm-table-cell">Occupation</th>
                                <th scope="col" class="d-none d-sm-table-cell">Status</th>
                                <th scope="col">Profile</th>
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
                            $query = "SELECT user_id, firstname, lastname, email, occupation, status FROM users 
                                WHERE CONCAT(firstname, ' ', lastname) LIKE ? LIMIT ?, ?";
                            $stmt = $connection->prepare($query);
                            $searchParam = "%" . $search . "%";
                            $stmt->bind_param("sii", $searchParam, $offset, $limit);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt->close();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <th scope="row"><i class="fa-solid fa-chevron-right fa-lg"></i></th>
                                        <td>
                                            <?php echo $row['firstname'] .' '.  $row['lastname']; ?>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <?php echo $row['email']; ?>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <?php echo $row['occupation']; ?>
                                        </td>
                                        <td class="fw-bold d-none d-sm-table-cell">
                                            <?php
                                            $status = $row['status'];
                                            $textColorClass = ($status == '0') ? 'text-danger' : 'text-success';
                                            $statusText = ($status == '1') ? 'Activated' : 'Pending';
                                            ?>
                                            <p class="<?php echo $textColorClass; ?>"><?php echo $statusText; ?></p>
                                        </td>
                                        <td>
                                            <form action="applicant-profile.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
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
                        $query = "SELECT COUNT(*) as total FROM users";
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
