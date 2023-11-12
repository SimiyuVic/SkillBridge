<?php
session_start();

@require_once "../config/config.php";


if(isset($_POST['update']))
{
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $company = mysqli_real_escape_string($connection, $_POST['company']);
    $website = mysqli_real_escape_string($connection, $_POST['website']);
    $about_company = mysqli_real_escape_string($connection, $_POST['about_company']);
    $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
    $county = mysqli_real_escape_string($connection, $_POST['county']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);

    $sql = "UPDATE employers SET fullname = '$fullname', company = '$company', website = '$website', about_company = '$about_company',
    phone_number = '$phone_number', county = '$county', city = '$city' WHERE fullname = '$fullname'";
    $result = mysqli_query($connection, $sql);

    if(!$result)
    {
        $_SESSION['update_error'] = "Update failed";
    }
    else
    {
        $_SESSION['update_success'] = "Update successful";
        header('location: ../employers/index.php');
    }

    mysqli_close($connection);
}
?>
