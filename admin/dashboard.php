<?php include 'header.php'; ?>
<div class="container my-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <?php include 'dashboard-greet.php'; ?>
                <?php include 'side-bar.html'; ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="container my-2">
                <div class="row">
                    <div class="col-md-6 mb-3">
                           <div class="card shadow">
                            <div class="card-body">
                                <h5>Active Companies</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-primary">
                                            <i class="fas fa-building fa-xl"></i>
                                        </h5>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h3>
                                            <?php
                                                @require_once '../config/config.php';
                                                $stmt = $connection->prepare("SELECT COUNT(*) as total_companies FROM employers WHERE status = 1");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0)
                                                {
                                                    $row = $result->fetch_assoc();
                                                    $totalCompanies = $row['total_companies'];
                                                    echo $totalCompanies;
                                                } 
                                                else 
                                                {
                                                    echo "No activated companies found";
                                                }
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                           </div>
                    </div>
                    <div class="col-md-6">
                           <div class="card shadow">
                            <div class="card-body">
                                    <h5>Pending Company Verification </h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="text-primary">
                                                <i class="fas fa-hand-holding-water fa-xl"></i>
                                            </h5>
                                        </div>
                                        <div class="col-6 text-center">
                                            <h3>
                                                <?php
                                                    @require_once '../config/config.php';
                                                    $stmt = $connection->prepare("SELECT COUNT(*) as total_companies FROM employers WHERE status = 0");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    if($result->num_rows > 0)
                                                    {
                                                        $row = $result->fetch_assoc();
                                                        $totalCompanies = $row['total_companies'];
                                                        echo $totalCompanies;
                                                    } 
                                                    else 
                                                    {
                                                        echo "No activated companies found";
                                                    }
                                                ?>
                                            </h3>
                                        </div>
                                    </div>
                            </div>
                           </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                           <div class="card shadow">
                            <div class="card-body">
                                <h5>Registered Candidates</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-primary">
                                            <i class="fas fa-user-check fa-xl"></i>
                                        </h5>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h3>
                                            <?php
                                                @require_once '../config/config.php';
                                                $stmt = $connection->prepare("SELECT COUNT(*) as total_users FROM users WHERE status = 1");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0)
                                                {
                                                    $row = $result->fetch_assoc();
                                                    $totalCompanies = $row['total_users'];
                                                    echo $totalCompanies;
                                                } 
                                                else 
                                                {
                                                    echo "No activated companies found";
                                                }
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                           </div>
                    </div>
                    <div class="col-md-6">
                           <div class="card shadow">
                            <div class="card-body">
                                    <h5>Pending Candidates Verification </h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="text-primary">
                                                <i class="fas fa-hand-holding-water fa-xl"></i>
                                            </h5>
                                        </div>
                                        <div class="col-6 text-center">
                                            <h3>
                                                <?php
                                                    @require_once '../config/config.php';
                                                    $stmt = $connection->prepare("SELECT COUNT(*) as total_users FROM users WHERE status = 0");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    if($result->num_rows > 0)
                                                    {
                                                        $row = $result->fetch_assoc();
                                                        $totalCompanies = $row['total_users'];
                                                        echo $totalCompanies;
                                                    } 
                                                    else 
                                                    {
                                                        echo "No activated companies found";
                                                    }
                                                ?>
                                            </h3>
                                        </div>
                                    </div>
                            </div>
                           </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                           <div class="card shadow">
                            <div class="card-body">
                                <h5>Total Job Posts</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-primary">
                                            <i class="fas fa-layer-group fa-xl"></i>
                                        </h5>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h3>
                                            <?php
                                                @require_once '../config/config.php';
                                                $stmt = $connection->prepare("SELECT COUNT(*) as total_jobs FROM job_post");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0)
                                                {
                                                    $row = $result->fetch_assoc();
                                                    $totalCompanies = $row['total_jobs'];
                                                    echo $totalCompanies;
                                                } 
                                                else 
                                                {
                                                    echo "No jobs found";
                                                }
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                           </div>
                    </div>
                    <div class="col-md-6">
                           <div class="card shadow">
                            <div class="card-body">
                                    <h5>Total Applications</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="text-primary">
                                                <i class="fas fa-search fa-xl"></i>
                                            </h5>
                                        </div>
                                        <div class="col-6 text-center">
                                            <h3>
                                                <?php
                                                    @require_once '../config/config.php';
                                                    $stmt = $connection->prepare("SELECT COUNT(*) as total_applications FROM applied_jobs");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    if($result->num_rows > 0)
                                                    {
                                                        $row = $result->fetch_assoc();
                                                        $totalCompanies = $row['total_applications'];
                                                        echo $totalCompanies;
                                                    } 
                                                    else 
                                                    {
                                                        echo "No applications found";
                                                    }
                                                ?>
                                            </h3>
                                        </div>
                                    </div>
                            </div>
                           </div>
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