<?php
session_start();

@require_once "../config/config.php";


if (isset($_POST['login'])) {

    if(empty($_POST['email']) || empty($_POST['password']))
    {
        $_SESSION['empty_details'] = "";
        header('location: ../user-login.php');
    }
    else
    {

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $sql = "SELECT * FROM candidates WHERE email = '$email' && password = '$password'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];

                header('location: ../users/index.php');
                $_SESSION['login_success'] = "";
            }
        } 
        else 
        {
            header('location: ../user-login.php');
            $_SESSION['login_error'] = "";
        }
    }    
}

mysqli_close($connection);
?>
