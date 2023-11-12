<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header('location: ..login.php');
    $_SESSION['must_login'] = "";
}

@require_once '../config/config.php';

if(isset($_POST['edit_portfolio']))
{
    $project_title = mysqli_real_escape_string($connection, $_POST['project_title']);
    $project_info = mysqli_real_escape_string($connection, $_POST['project_info']);
    $project_description = mysqli_real_escape_string($connection, $_POST['project_description']);
    $project_link = mysqli_real_escape_string($connection, $_POST['project_link']);
    $recordId = mysqli_real_escape_string($connection, $_GET['portfolio_id']);
    
    $currentUser = $_SESSION['user_id'];

    $sql = "UPDATE portfolio SET 
        project_title = '$project_title',
        project_info = '$project_info',
        project_description = '$project_description',
        project_link = '$project_link' 
        WHERE user_id = '$currentUser' AND portfolio_id = '$recordId'";
    
    $result = mysqli_query($connection, $sql);

    if($result)
    {
        $_SESSION['success'] = "Portfolio entry updated successfully.";
        header('location: ../users/create-portfolio.php');
    }
    else
    {
        $_SESSION['failed'] = "Error updating portfolio entry: " . mysqli_error($connection);
        header('location: ../users/edit-portfolio.php');
    }
}

?>
