<?php
session_start();

if (empty($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/config.php';

if (isset($_GET)) {
    $jobpost_id = $_GET['id'];

    // Prepare a SQL statement to fetch job details
    $sql = "SELECT company_id FROM vacancies WHERE jobpost_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $jobpost_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $company_id = $row['company_id'];

        // Prepare a SQL statement to check if the user has already applied
        $sql1 = "SELECT * FROM apply_job_post WHERE user_id = ? AND jobpost_id = ?";
        $stmt1 = $connection->prepare($sql1);
        $stmt1->bind_param("ii", $_SESSION['user_id'], $jobpost_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $stmt1->close();

        if ($result1->num_rows == 0) {
            // Prepare a SQL statement to insert the application
            $sql2 = "INSERT INTO apply_job_post (jobpost_id, company_id, user_id) VALUES (?, ?, ?)";
            $stmt2 = $connection->prepare($sql2);
            $stmt2->bind_param("iii", $jobpost_id, $company_id, $_SESSION['user_id']);
            if ($stmt2->execute()) {
                $_SESSION['jobApplySuccess'] = true;
                $stmt2->close();
                header("Location: ../users/index.php");
                exit();
            } else {
                echo "Error: " . $stmt2->error;
                $stmt2->close();
            }
        } else {
            header("Location: ../jobs.php");
            $_SESSION['application_error_2'] = "You have already applied for this job.";
            exit();
        }
    } else {
        header("Location: ../jobs.php");
        $_SESSION['job_exists'] = "The job post does not exist.";
        exit();
    }
} else {
    header("Location: ../jobs.php");
    $_SESSION['application_error'] = "Invalid job application request.";
    exit();
}
