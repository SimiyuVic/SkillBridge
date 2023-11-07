<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['user_id'])) {
	header("Location: ../index.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once '../config/config.php';

//If user Actually clicked apply button
if(isset($_GET)) {

	$sql = "SELECT * FROM vacancies WHERE jobpost_id='$_GET[id]'";
	  $result = $connection->query($sql); 
	  if($result->num_rows > 0) 
	  {
	    	$row = $result->fetch_assoc();
	    	$company_id = $row['company_id'];
	   }

	//Check if user has applied to job post or not. If not then add his details to apply_job_post table.
	$sql1 = "SELECT * FROM apply_job_post WHERE user_id='$_SESSION[user_id]' AND jobpost_id='$row[jobpost_id]'";
    $result1 = $connection->query($sql1);
    if($result1->num_rows == 0) 
    {  
    	
    	$sql = "INSERT INTO apply_job_post(jobpost_id, company_id, user_id) VALUES ('$_GET[id]', '$company_id', '$_SESSION[user_id]')";

		if($connection->query($sql)===TRUE)
        {
			$_SESSION['jobApplySuccess'] = true;
			header("Location: ../users/index.php");
			exit();
		} 
        else 
        {
			echo "Error " . $sql . "<br>" . $connection->error;
		}

		$connection->close();

    }  
    else 
    {
		header("Location: ../jobs.php");
		exit();
	}
	

} else {
	header("Location: ../jobs.php");
	exit();
}