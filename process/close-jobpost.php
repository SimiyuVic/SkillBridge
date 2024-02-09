<?php
session_start();

if(!isset($_SESSION['company_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}

require_once '../config/config.php';

if(isset($_POST['close_job']))
{
    $jobpost_id = $_POST['jobpost_id'];
    //Check current status 
    $sql_check_status = "SELECT status FROM job_post WHERE jobpost_id = ?";
    $stmt_check_status = $connection->prepare($sql_check_status);
    $stmt_check_status->bind_param("i", $jobpost_id);
    $stmt_check_status->execute();
    $stmt_check_status->bind_result($current_status);
    $stmt_check_status->fetch();
    $stmt_check_status->close();
    //Check if job is closed 
    if($current_status == 1)
    {
        $_SESSION['job_closed'] = "";
        header('location: ../employers/posted-jobs.php');
    }
    elseif($current_status == 2)
    {
        $stmt_update_status = $connection->prepare("UPDATE job_post SET status = 1 WHERE jobpost_id = ?");
        $stmt_update_status->bind_param("i", $jobpost_id);
        if($stmt_update_status->execute())
        {
            $_SESSION['status_update'] = "";
            header('location: ../employers/closed-jobs.php');
        }
        else
        {
            $_SESSION['status_update_fail'] = "";
            header('location: ../employers/open-jobs.php');
        }
        $stmt_update_status->close();
    }
    else
    {
        //invalid job status
    }

}
$connection->close();
?>