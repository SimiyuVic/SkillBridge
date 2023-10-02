<?php
session_start();

include('../config/config.php');

if(isset($_POST['register']))
{
    $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $sql_username = "SELECT * FROM candidates WHERE user_name = '$user_name'";
    $result_username = mysqli_query($connection, $sql_username);

    $sql_email = "SELECT * FROM candidates WHERE email = '$email'";
    $result_email = mysqli_query($connection, $sql_email);

    if(empty($user_name) || empty($email) || empty($phone) || empty($password))
    {
        header('location: ../register.php');
        $_SESSION['details'] = "";
    }
    else{

        if(mysqli_num_rows($result_username) > 0)
        {
            header('location: ../register.php');
            $_SESSION['username'] = "";
        }
        elseif(mysqli_num_rows($result_email) > 0)
        {
            header('location: ../register.php');
            $_SESSION['email'] = "";
        }
        else
        {
            $sql = "INSERT INTO candidates (user_name, email, phone, password) VALUES('$user_name', '$email', '$phone', '$password')";
            $result = mysqli_query($connection, $sql);

            if(!$result)
            {
                die("Connection failed : " . mysqli_error());
            }
            else
            {
                header('location: ../login.php');
                $_SESSION['register'] = "";
            }
        }
    }    
}

?>