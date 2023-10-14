<?php
session_start();

@require_once "../config/config.php";

if(!isset($_SESSION['email']))
{
  header('location: ../user-login.php');
  exit;
}



if(isset($_POST['update']))
{
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
    $qualification = mysqli_real_escape_string($connection, $_POST['qualification']);
    $occupation = mysqli_real_escape_string($connection, $_POST['occupation']);
    $about_me = mysqli_real_escape_string($connection, $_POST['about_me']);
    $skills = mysqli_real_escape_string($connection, $_POST['skills']);

    $sql = "UPDATE candidates SET firstname = '$firstname', lastname = '$lastname', phone_number = '$phone_number', qualification = '$qualification',
     occupation = '$occupation', about_me = '$about_me', skills = '$skills' WHERE firstname = '$firstname'";
    $result = mysqli_query($connection, $sql);

    if(!$result)
    {
        $_SESSION['update_error'] = "Update failed";
    }
    else
    {
        $_SESSION['update_success'] = "Update successful";
        header('location: ../users/index.php');
    }

    mysqli_close($connection);
}
?>
