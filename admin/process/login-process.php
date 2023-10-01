<?php
session_start();

include('../config/config.php');

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if( empty($username) || empty($password))
    {
        header('location: ../index.php');
        $_SESSION['login'] = "";
    }
    else 
    {
        $sql = "SELECT * FROM admin WHERE username= '$username' AND  password = '$password'";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            header('location: ../home.php');
            $_SESSION['username'] = $username;
            $_SESSION['login_success'] = "";
        }
        else 
        {
            header('location: ../index.php');
            $_SESSION['login_error'] = "";
        }
    }
}


?>