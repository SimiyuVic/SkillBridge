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
                    <h5 class="text-center">Messages From Contact Form</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form action="" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Sender Name or Email" name="search">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    <?php
                    @require_once '../config/config.php';

                    // Pagination variables
                    $limit = 10; // Number of items per page
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Search Query
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $searchParam = "%" . $search . "%";

                    $query = "SELECT * FROM contact_form
                              WHERE sender_name LIKE ? OR sender_email LIKE ?
                              LIMIT ?, ?";
                    $stmt = $connection->prepare($query);
                    $stmt->bind_param("ssii", $searchParam, $searchParam, $offset, $limit);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="card bg-light my-1">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="my-3 ms-1"><i class="far fa-user fa-lg me-2"></i><?php echo $row['sender_name']; ?></h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="my-3 ms-1"><i class="fas fa-envelope fa-lg me-2"></i><?php echo $row['sender_email']; ?></h6>
                                    </div>
                                    <div class="col-md-5">
                                        <!-- Button trigger collapse -->
                                        <button class="btn btn-outline-primary mt-2 ms-2 my-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $row['message_id']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['sender_query']; ?>">
                                            Show Query
                                        </button>

                                        <!-- Collapsible content -->
                                        <div class="collapse" id="collapse-<?php echo $row['message_id']; ?>">
                                            <div class="card card-body my-3 me-2 ms-2">
                                                <?php echo $row['sender_query']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo "<p>No messages found.</p>";
                    }

                    // Pagination Links
                    $queryCount = "SELECT COUNT(*) as total FROM contact_form";
                    $stmtCount = $connection->prepare($queryCount);
                    $stmtCount->execute();
                    $resultCount = $stmtCount->get_result();
                    $stmtCount->close();

                    $row = $resultCount->fetch_assoc();
                    $total_pages = ceil($row['total'] / $limit);

                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '&search=' . $search . '" class="btn btn-outline-secondary">&laquo; Previous</a>';
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                            echo '<a href="?page=' . $i . '&search=' . $search . '" class="btn btn-primary">' . $i . '</a>';
                        } else {
                            echo '<a href="?page=' . $i . '&search=' . $search . '" class="btn btn-outline-primary">' . $i . '</a>';
                        }
                    }

                    if ($page < $total_pages) {
                        echo '<a href="?page=' . ($page + 1) . '&search=' . $search . '" class="btn btn-outline-secondary">Next &raquo;</a>';
                    }
                    ?>
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
