<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['company_id'])) {
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}

require_once '../config/config.php';

if (isset($_POST['create_job'])) 
{
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];
    $designation = $_POST['designation'];
    $qualification = $_POST['qualification'];
    $location = $_POST['location'];
    $expected_salary = $_POST['expected_salary'];
    $duration = $_POST['duration'];

    if (empty($job_description)) 
    {
        $_SESSION['empty_description'] = "";
        header('location: ../employers/create-job.php');
    } 
    else 
    {
        // Calculate expiration date
        $currentDate = date('Y-m-d H:i:s');
        $expirationDate = date('Y-m-d H:i:s', strtotime($currentDate . " +$duration days"));

        $sql = "INSERT INTO job_post(company_id, job_title, job_description, designation, qualification, location, expected_salary, expiration_date) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);

        if ($stmt) 
        {
            $stmt->bind_param("isssssss", $_SESSION['company_id'], $job_title, $job_description, $designation,  $qualification, $location, $expected_salary, $expirationDate);
            
            if ($stmt->execute()) 
            {
                $_SESSION['create_success'] = "";
                header('location: ../employers/posted-jobs.php');
            } 
            else 
            {
                $_SESSION['create_fail'] = "";
                header('location: ../employers/create-job.php');
            }
            
            $stmt->close();
        } 
        else 
        {
            // Log the error or handle it appropriately
            echo "Error preparing the SQL statement.";
        }
    }
}

$connection->close();
?>
