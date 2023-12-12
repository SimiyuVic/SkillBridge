<?php

session_start();

@include_once '../config/config.php';

if(isset($_POST['Edit']))
{
    //Getting the user input
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone_number = $_POST['phone_number'];
    $occupation = $_POST['occupation'];
    $study = $_POST['study'];
    $description = $_POST['description'];
    $skills = $_POST['skills'];

    //Usage of prepared statements to prevent sql injection
    $stmt = $connection->prepare("UPDATE users SET firstname = ?, lastname = ?, phone_number = ?, occupation = ?,
    study = ?, description = ?, skills = ? WHERE user_id = ? ");
    $stmt->bind_param("sssssssi", $firstname, $lastname, $phone_number, $occupation, $study, $description, $skills, $_SESSION['user_id']);

    if($stmt->execute())
    {
        $_SESSION['update_success'] = "";
        header('location: ../users/index.php');
    }
    else 
    {
        $_SESSION['update_fail'] = "";
        header('location: ../users/edit-profile.php');
    }
    $stmt->close();
    $connection->close();
}


?>