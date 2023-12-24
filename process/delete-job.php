<?php
session_start();

if (!isset($_SESSION['company_id'])) {
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}

require_once '../config/config.php';

if(isset($_POST['delete']))
{
    $jobpost_id = isset($_GET['id']) ? $_GET['id'] : '';
    $company_id = $_SESSION['company_id'];
    
    if (!empty($jobpost_id) && is_numeric($jobpost_id))
    {
        $sql = "DELETE FROM job_post WHERE jobpost_id = ? AND company_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $jobpost_id, $company_id);
        if($stmt->execute())
        {
            $_SESSION['deleted'] = "";
            header('location: ../employers/posted-jobs.php');
        }
        else
        {
            $_SESSION['failed_delete'] = "";
            header('location: ../employers/posted-jobs.php');
        }
        $stmt->close();
    }
}
$connection->close();
?>