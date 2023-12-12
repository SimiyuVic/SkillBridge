<?php

session_start();

@require_once '../config/config.php';

if(isset($_POST['login']))
{
    //Getting the User inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Check if the user inputs are empty
    if(empty($email) || empty($password))
    {
        $_SESSION['empty_details'] = "";
        header('location: ../user-login.php');
    }
    else 
    {
        //Prepare sql statement to check login details.
        $stmt = $connection->prepare("SELECT user_id, firstname, lastname, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        //Execute the statement
        $stmt->execute();

        //Bind Results
        $stmt->bind_result($user_id, $firstname, $lastname , $hashed_password);

        //Fetch Results
        $stmt->fetch();

        //Verify password
        if(password_verify($password, $hashed_password))
        {
            //Correct password, set sessions variables and redirect to login
            $_SESSION['user_id'] = $user_id;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;

            header('location: ../users/index.php');
            $_SESSION['login_success'] = "";
            exit();
        }
        else //Incorrect password
        {
            $_SESSION['wrong_details'] = "";
            header('location: ../user-login.php');
            exit();
        }

        //Good practice
        $stmt->close();
        $connection->close();
    }
}

?>