<?php
session_start();

@require_once "../config/config.php";

if (isset($_POST['post_job'])) 
{
    $job_title = mysqli_real_escape_string($connection, $_POST['job_title']);
    $job_description = mysqli_real_escape_string($connection, $_POST['job_description']);
    $salary = mysqli_real_escape_string($connection, $_POST['salary']);
    $designation = mysqli_real_escape_string($connection, $_POST['designation']);
    $qualification = mysqli_real_escape_string($connection, $_POST['qualification']);


        $sql = "INSERT INTO job_post (job_title, job_description, salary, designation, qualification) 
                VALUES ('$job_title', '$job_description', '$salary', '$designation', '$qualification') ";
        
        $result = mysqli_query($connection, $sql);

        if ($result) 
        {
            $_SESSION['post_success'] = "Job posted successfully.";
            header('location: ../employers/index.php');
        } 
        else 
        {
            $_SESSION['post_error'] = "";
            header('location: ../employers/create-job.php');
        }
    
}
?>
