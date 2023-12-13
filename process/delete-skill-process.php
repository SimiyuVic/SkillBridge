<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    $_SESSION['must_login'] = "";
    hedaer('location: ../login.php');
}

require_once '../config/config.php';

if(isset($_POST['delete_skill']) && isset($_POST['id']))
{
    $portfolio_id = $_POST['id'];

    //Fetching the desired portfolio data
    $sql_fetch = "SELECT * FROM portfolio WHERE user_id = ? AND portfolio_id = ?";
    $stmt_fetch = $connection->prepare($sql_fetch);
    //Bind parameters
    $stmt_fetch->bind_param("ii", $_SESSION['user_id'], $portfolio_id);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $portfolioData = $result->fetch_assoc();

    if($portfolioData)
    {
        //Delete the image from server
        $imageFilePath = '../uploads/portfolio/' . $portfolioData['project_image'];
        if(file_exists($imageFilePath))
        {
            unlink($imageFilePath); //Delete the File
        }
        //Now delete the skill
        $sql_delete = "DELETE  FROM portfolio WHERE user_id = ? AND portfolio_id = ?";
        $stmt_delete = $connection->prepare($sql_delete);
        //Bind delete parameters
        $stmt_delete->bind_param("ii", $_SESSION['user_id'], $portfolio_id);
        if($stmt_delete->execute())
        {
            $_SESSION['deleted'] = "";
            header('location: ../users/portfolio.php');
            exit();
        }
    }
    else
    {
        $_SESSION['entry_not_found'] = "";
        header('location: ../users/portfolio.php');
    }
}   
else
{
    $_SESSION['entry_not_found'] = "";
    header('location: ../users/portfolio.php');
}

?>