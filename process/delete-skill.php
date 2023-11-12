<?php

session_start();

if(!isset($_SESSION['user_id']))
{
  header('location: ../user-login.php');
  $_SESSION['must_login'] = "";
  exit;
}

@require_once '../config/config.php';

if(isset($_GET))
{
    $currentUser = $_SESSION['user_id'];

    $recordId = $_GET['id'];

    $sql = "DELETE  FROM portfolio WHERE user_id = '$currentUser' AND portfolio_id = '$recordId'";

    $result = mysqli_query($connection, $sql);

    if($result)
    {
        $_SESSION['deleted'] = "";
        header('location: ../users/create-portfolio.php');
    }
    else 
    {
        $_SESSION['delete_failed'] = "";
        header('location: ../users/create-portfolio.php');
    }
}
?>