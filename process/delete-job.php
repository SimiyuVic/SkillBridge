<?php
session_start();

if (!isset($_SESSION['company_id'])) {
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}

require_once '../config/config.php';

if (isset($_POST['delete'])) {
    $jobpost_id = $_POST['jobpost_id'];
    $company_id = $_SESSION['company_id'];

    if (!empty($jobpost_id) && is_numeric($jobpost_id)) {
        // Start a transaction
        $connection->begin_transaction();

        try {
            // Delete from applied_jobs
            $deleteAppliedJobsSql = "DELETE FROM applied_jobs WHERE jobpost_id = ? AND company_id = ?";
            $deleteAppliedJobsStmt = $connection->prepare($deleteAppliedJobsSql);
            $deleteAppliedJobsStmt->bind_param("ii", $jobpost_id, $company_id);
            $deleteAppliedJobsStmt->execute();

            // Delete from job_post
            $deleteJobPostSql = "DELETE FROM job_post WHERE jobpost_id = ? AND company_id = ?";
            $deleteJobPostStmt = $connection->prepare($deleteJobPostSql);
            $deleteJobPostStmt->bind_param("ii", $jobpost_id, $company_id);
            $deleteJobPostStmt->execute();

            // Commit the transaction
            $connection->commit();

            $_SESSION['deleted'] = "";
            header('location: ../employers/posted-jobs.php');
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $connection->rollback();
            $_SESSION['failed_delete'] = "";
            header('location: ../employers/posted-jobs.php');
        } finally {
            // Close the connection
            $connection->close();
        }
    }
}
?>
