<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}

require_once '../config/config.php';

if(isset($_POST['delete']))
{
    $aplliedjobs_id = $_POST['aplliedjobs_id'];
    $user_id = $_SESSION['user_id'];
    
    if (!empty($aplliedjobs_id) && is_numeric($aplliedjobs_id))
    {
        $sql = "DELETE FROM applied_jobs WHERE aplliedjobs_id = ? AND user_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $aplliedjobs_id, $user_id);
        if($stmt->execute())
        {
            $_SESSION['deleted'] = "";
            header('location: ../users/applied-jobs.php');
        }
        else
        {
            $_SESSION['failed_delete'] = "";
            header('location: ../users/applied-jobs.php');
        }
        $stmt->close();
    }
}
$connection->close();
?>