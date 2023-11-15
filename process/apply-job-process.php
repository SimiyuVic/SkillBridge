<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../user-login.php');
    exit();
}

@require_once '../config/config.php';

if(isset($_GET['jobpost_id']))
{
    $jobpost_id = $_GET['jobpost_id'];
    //Fetching job details
    $sql = "SELECT company_id FROM vacancies WHERE jobpost_id = '$_GET[jobpost_id]'";
    $result = mysqli_query($connection, $sql);

    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $company_id = $row['company_id'];

        //Checking if user has already applied 
        $sql1 = "SELECT * FROM apply_job_post WHERE user_id = '$_SESSION[user_id]' AND jobpost_id = '$jobpost_id'";
        $result1 = mysqli_query($connection, $sql1);

        if(mysqli_num_rows($result1)==0)
        {
            $sql2 = "INSERT INTO apply_job_post(jobpost_id, company_id, user_id) VALUES('$jobpost_id', '$company_id', '$_SESSION[user_id]')";
            $result2 = mysqli_query($connection, $sql2);

            if($result)
            {
                //If successfully applied
                $_SESSION['applied_success'] = "";
                header('location: ../users/index.php');
            }
            else
            {
                $_SESSION['apply_fail'] = "";
                header('location: ../jobs.php');
            }
        }
        else //if job application exists
        {
            $_SESSION['application_exists']="";
            header('location: ../jobs.php');
        }


    }
    else
    {
        //Job does not exist
        $_SESSION['application_exists']="";
        header('location: ../index.php');
    }
}
else 
{
    $_SESSION['apply_failed'] = "";
    header('location: ../jobs.php');
}

?>