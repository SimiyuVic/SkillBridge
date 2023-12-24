<?php
session_start();

if (!isset($_SESSION['user_id'])) 
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
    exit();
}

require_once '../config/config.php';

if (isset($_POST['apply_job'])) 
{
    $company_id = isset($_POST['company_id']) ? $_POST['company_id'] : null;
    $jobpost_id = isset($_POST['jobpost_id']) ? $_POST['jobpost_id'] : null;

    $user_id = $_SESSION['user_id'];

    // Validate input (you can add more validation based on your requirements)
    if (!$user_id || !$company_id || !$jobpost_id) 
    {
        $_SESSION['apply_failed'] = "Invalid input.";
        header('location: ../view-job.php');
        exit();
    }

    // Check if the user has already applied for this job
    $checkSql = "SELECT * FROM applied_jobs WHERE user_id = ? AND company_id = ? AND jobpost_id = ?";
    $checkStmt = $connection->prepare($checkSql);

    if (!$checkStmt) 
    {
        die('Error in the prepared statement: ' . $connection->error); // Improve error handling
    }

    $checkStmt->bind_param("iii", $user_id, $company_id, $jobpost_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) 
    {
        $_SESSION['job_exists'] = "";
        header('location: ../jobs.php');
        exit();
    }

    // If not applied, proceed with the new application
    $insertSql = "INSERT INTO applied_jobs (user_id, company_id, jobpost_id) VALUES (?, ?, ?)";
    $insertStmt = $connection->prepare($insertSql);

    if (!$insertStmt) 
    {
        die('Error in the prepared statement: ' . $connection->error); // Improve error handling
    }

    $insertStmt->bind_param("iii", $user_id, $company_id, $jobpost_id);

    if ($insertStmt->execute()) 
    {
        $_SESSION['applied'] = "";
        header('location: ../users/applied-jobs.php');
        exit();
    } 
    else 
    {
        $_SESSION['apply_failed'] = "";
        header('location: ../view-job.php');
        exit();
    }
}
?>
