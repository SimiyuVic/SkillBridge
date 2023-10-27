<?php
session_start();

if(empty($_SESSION['company_id'])) {
    header("Location: ../index.php");
    exit();
  }
@require_once "../config/config.php";

if (isset($_POST['post_job'])) 
{
    $stmt = $connection->prepare("INSERT INTO vacancies(company_id, job_title, job_description,  salary, designation, qualification) VALUES (?,?, ?, ?, ?, ?)");

	$stmt->bind_param("isssss", $_SESSION['company_id'], $job_title, $job_description,  $salary, $designation, $qualification);

	$job_title = mysqli_real_escape_string($connection, $_POST['job_title']);
	$job_description = mysqli_real_escape_string($connection, $_POST['job_description']);
	$salary = mysqli_real_escape_string($connection, $_POST['salary']);
	$designation = mysqli_real_escape_string($connection, $_POST['designation']);
	$qualification = mysqli_real_escape_string($connection, $_POST['qualification']);


	if($stmt->execute()) {
		//If data Inserted successfully then redirect to dashboard
		$_SESSION['post_success'] = "";
		header("Location: ../employers");
		exit();
	} 
    else 
    {
		//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
		echo "Error ";
	}

	$stmt->close();
}
?>
