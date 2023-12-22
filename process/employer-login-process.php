<?php
session_start();

require_once '../config/config.php';

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT company_id, username, company_name, password FROM employers WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($company_id, $username, $company_name, $hashed_password);
    $stmt->fetch();
    if(password_verify($password, $hashed_password))
    {
        $_SESSION['company_id'] = $company_id;
        $_SESSION['username'] = $username;
        $_SESSION['company_name'] = $company_name;
        $_SESSION['login_success'] = "";
        header('location: ../employers/index.php');
        
    }
    else
    {
        $_SESSION['wrong_details'] = "";
        header('location: ../employer-login.php');
    }
}

?>