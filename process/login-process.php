<?php
session_start();

include('../config/config.php');

if(isset($_POST['login']))
{
    $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if( empty($user_name) || empty($password))
    {
        header('location: ../login.php');
        $_SESSION['details'] = "";
    }
    else 
    {
        $sql = "SELECT * FROM candidates WHERE user_name= '$user_name' AND  password = '$password'";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            header('location: ../home.php');
            $_SESSION['user_name'] = $user_name;
            $_SESSION['login_success'] = "";
        }
        else 
        {
            header('location: ../login.php');
            $_SESSION['login_error'] = "";
        }
    }
}


?>