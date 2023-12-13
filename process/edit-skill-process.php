<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}

require_once '../config/config.php';

if(isset($_POST['edit_project']) && isset($_POST['id']))
{
    
    $project_title = $_POST['project_title'];
    $project_link = $_POST['project_link'];
    $project_info = $_POST['project_info'];
    $project_description = $_POST['project_description'];

    $portfolio_id = $_POST['id'];

    //Prepare statement
    $sql = "UPDATE portfolio SET project_title = ?, project_link = ?, project_info = ?, project_description = ? WHERE user_id = ? AND portfolio_id = ?";
    $stmt = $connection->prepare($sql);
    //Bind Parameters.
    $stmt->bind_param("ssssii", $project_title, $project_link, $project_info, $project_description, $_SESSION['user_id'], $portfolio_id);
    if($stmt->execute())
    {
        $_SESSION['update_success'] = "";
        header('location: ../users/portfolio.php');
    }
    else 
    {
        $_SESSION['update_fail'] = "";
        header('location: ../users/edit-project.php');
    }
    $stmt->close();
    $connection->close();
}

?>