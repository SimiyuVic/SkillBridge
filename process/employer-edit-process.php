<?php
session_start();

if(!isset($_SESSION['company_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}

require_once '../config/config.php';

if(isset($_POST['edit_employer']))
{
    $username = $_POST['username'];
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $website = $_POST['website'];
    $county = $_POST['county'];
    $city = $_POST['city'];
    $description = $_POST['description'];

    //Logic to update
    $sql = "UPDATE employers SET username = ?, company_name = ?, email = ?, phone_number = ?, website = ?, county = ?,
    city = ?, description = ? WHERE company_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssssi", $username, $company_name, $email, $phone_number, $website, $county, $city, $description, $_SESSION['company_id']);
    if($stmt->execute())
    {
        $_SESSION['edit_success'] = "";
        header('location: ../employers/edit-profile.php');
    }
    else
    {
        $_SESSION['edit_fail'] = "";
        header('location: ../employers/edit-profile.php');
    }
    $stmt->close();
}

$connection->close();
?>
