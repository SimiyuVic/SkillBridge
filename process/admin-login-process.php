<?php
session_start();

require_once '../config/config.php';

if(isset($_POST['Login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Prepate statement
    $stmt = $connection->prepare("SELECT admin_id, username, password FROM administrator WHERE email = ?");
    $stmt->bind_param("s", $email);
    //execute
    $stmt->execute();
    //Bind results
    $stmt->bind_result($admin_id, $username, $hashed_password);
    //Fetch results
    $stmt->fetch();
    //Verify password
    if(password_verify($password, $hashed_password))
    {
        //Correct password
        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['username'] = $username;

        header('Location: ../admin/dashboard.php');
        $_SESSION['login_success'] = "";
        exit();
    }
    else 
    {
        //Incorrect password
        header('Location: ../admin/index.php');
        $_SESSION['wrong_details'] = "";
        exit();
    }
    $stmt->close();
    $connection->close();
}
?>