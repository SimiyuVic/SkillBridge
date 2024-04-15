<?php
session_start();

// Include database connection
require_once 'config/config.php';

// Function to display remaining time
function displayRemainingTime($row) {
    $expirationDate = new DateTime($row['expiration_date']);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($expirationDate);

    if ($interval->days < 1) {
        if ($interval->h >= 1) {
            return 'Hours Remaining: ' . $interval->h;
        } elseif ($interval->i >= 1) {
            return 'Minutes Remaining: ' . $interval->i;
        } else {
            // If the duration is completed, remove silently
            return '';
        }
    } else {
        return 'Days Remaining: ' . $interval->days;
    }
}

// Fetch jobs based on search criteria
if (isset($_POST['search'])) {
    $jobTitle = $_POST['job_title'];
    $location = $_POST['location'];
    $qualification = $_POST['qualification'];

    $sql = "SELECT e.company_logo,
            jp.jobpost_id, jp.job_title, jp.job_description, jp.designation, jp.location, 
            jp.expected_salary, jp.status, jp.expiration_date
            FROM job_post AS jp
            JOIN employers AS e ON jp.company_id = e.company_id
            WHERE jp.status = '2'";

    // Add search conditions
    if (!empty($jobTitle)) {
        $sql .= " AND jp.job_title LIKE '%$jobTitle%'";
    }
    if (!empty($location)) {
        $sql .= " AND jp.location LIKE '%$location%'";
    }
    if (!empty($qualification)) {
        $sql .= " AND jp.qualification LIKE '%$qualification%'";
    }

    $sql .= " ORDER BY jp.created_at DESC";

    $result = $connection->query($sql);
} else {
    // Default query without search
    $sql = "SELECT e.company_logo,
            jp.jobpost_id, jp.job_title, jp.job_description, jp.designation, jp.location, 
            jp.expected_salary, jp.status, jp.expiration_date
            FROM job_post AS jp
            JOIN employers AS e ON jp.company_id = e.company_id
            WHERE jp.status = '2'
            ORDER BY jp.created_at DESC";

    $result = $connection->query($sql);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Jobs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-mQ93GR66o7D/EVEqUp0BqL45PQa24a6LZQ2Hb4cZ2z0x0vfFSzBvKv0ATs2DSh9efIt2uc5bBO1RoQ1HhehD5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        .navbar-nav .nav-link {
            color: white !important;
        }
        .navbar-brand {
            font-size: 29px;
            font-family: 'caveat', sans-serif;
            color: white !important;
        }
        .card:hover {
            transform: scale(1.035);
            transition: transform 0.7s ease-in-out;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        } 
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-warning">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <?php
                    if(isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users/index.php">Dashboard</a>
                        </li>
                    <?php } elseif(isset($_SESSION['company_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="employers/index.php">Dashboard</a>
                        </li>
                        <?php } elseif(isset($_SESSION['admin_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/dashboard.php">Dashboard</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sign-up.php">Sign Up</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
        <!-- Search Form -->
        <form method="POST" class="mb-4">
            <div class="card-body">
                <input class="form-control mb-2" name="job_title" type="text" placeholder="Search By Job Title">
                <input class="form-control mb-2" name="location" type="text" placeholder="Search By Location">
                <input class="form-control mb-2" name="qualification" type="text" placeholder="Search By Qualification / Field of Study">
                <button type="submit" name="search" class="btn btn-primary">Search</button>
            </div>
        </form>
        </div>
        <!-- Display Search Results -->
        
            <div class="col-md-9">
                <section id="jobs">
                    <?php
                    if (!$result || $result->num_rows === 0) { ?>
                        <div class="alert alert-danger" role="alert">
                            Your search returned no results, try inputs like Nairobi, Accountant or Degree jobs
                        </div>
                  <?php  } else {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <!-- Job Card -->
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="uploads/company_logo/<?php echo $row['company_logo']; ?>" class="rounded mx-auto d-block img-fluid" alt="Company Logo">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="text-success mt-2"><i class="fas fa-info-circle fa-lg me-1"></i><?php echo $row['designation']; ?></h6>
                                                </div>
                                                <div class="col-md-6">
                                                    <form action="view-job.php" method="POST">
                                                        <input type="hidden" name="jobpost_id" value="<?php echo $row['jobpost_id']; ?>">
                                                        <input type="submit" value="View Job" class="btn btn-outline-warning mb-2">
                                                    </form>
                                                </div>
                                            </div>
                                            <h6><span class="text-primary"><i class="far fa-check-circle fa-lg me-1"></i><?php echo $row['job_title']; ?></span></h5>
                                            <div class="bg-light">
                                                <div class="card-body">
                                                    <?php $jobDescription = substr($row['job_description'], 0, 250); ?>
                                                    <p class="text-muted"><?php echo $jobDescription; ?> . . .</p>
                                                </div>
                                            </div>
                                            <span class="mt-1 text-primary"><i class="fa-solid fa-location-dot me-2"></i><?php echo $row['location']; ?> | </span>
                                            <span class="mt-1 text-danger"><i class="fa-solid fa-hourglass-end me-2"></i><?php echo displayRemainingTime($row); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-dfbkcruXVt69jE7xfgT7WL2Pw5VuOyv40F8+nXo6tL9JUGKl0IBJdEn8NMJQ6d/6" crossorigin="anonymous"></script>
</body>
</html>
