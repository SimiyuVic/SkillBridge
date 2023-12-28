<?php
session_start();

if(!isset($_SESSION['company_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}
require_once '../config/config.php';


//Change job status to under Review
if(isset($_POST['under_review']))
{
    $user_id = $_POST['user_id'];
    $company_id = $_SESSION['company_id'];
    $jobpost_id = $_POST['jobpost_id'];

    $sql_check_status = "SELECT status FROM applied_jobs WHERE user_id = ? AND company_id = ? AND jobpost_id = ?";
    $stmt_check_status = $connection->prepare($sql_check_status);
    $stmt_check_status->bind_param("iii", $user_id, $company_id, $jobpost_id);
    $stmt_check_status->execute();
    $stmt_check_status->bind_result($current_status);
    $stmt_check_status->fetch();
    $stmt_check_status->close();
    if($current_status == 1)
    {
        $_SESSION['job_under_review'] = "";
        header('location: ../employers/applicants.php');
    }
    elseif($current_status == 2 || $current_status == 0)
    {
        $stmt_update_status = $connection->prepare("UPDATE applied_jobs SET status = 1 WHERE user_id = ? AND company_id = ? AND jobpost_id = ?");
        $stmt_update_status->bind_param("iii", $user_id, $company_id, $jobpost_id);
        if($stmt_update_status->execute())
        {
            $_SESSION['job_under_review_update'] = "";
            header('location: ../employers/applicants.php');
        }
        else
        {
            $_SESSION['failed_change'] = "";
            header('location: ../employers/applicants.php');
        }
    }
}

//Changed job application status to Rejected
if(isset($_POST['reject_application']))
{
    $user_id = $_POST['user_id'];
    $company_id = $_SESSION['company_id'];
    $jobpost_id = $_POST['jobpost_id'];

    $sql_check_status = "SELECT status FROM applied_jobs WHERE user_id = ? AND company_id = ? AND jobpost_id = ?";
    $stmt_check_status = $connection->prepare($sql_check_status);
    $stmt_check_status->bind_param("iii", $user_id, $company_id, $jobpost_id);
    $stmt_check_status->execute();
    $stmt_check_status->bind_result($current_status);
    $stmt_check_status->fetch();
    $stmt_check_status->close();
    if($current_status == 0)
    {
        $_SESSION['already_rejected'] = "";
        header('location: ../employers/applicants.php');
    }
    elseif($current_status == 2 || $current_status = 1 )
    {
        $stmt_update_status = $connection->prepare("UPDATE applied_jobs SET status = 0 WHERE user_id = ? AND company_id = ? AND jobpost_id = ?");
        $stmt_update_status->bind_param("iii", $user_id, $company_id, $jobpost_id);
        if($stmt_update_status->execute())
        {
            $_SESSION['rejected'] = "";
            header('location: ../employers/applicants.php');
        }
        else
        {
            $_SESSION['failed_change'] = "";
            header('location: ../employers/applicants.php');
        }
    }
}
?>