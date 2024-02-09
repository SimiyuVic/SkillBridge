<?php
session_start();

require_once '../config/config.php';

if(isset($_POST['login']))
{
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $sql = "SELECT admin_id , admin_name, admin_password FROM admin WHERE admin_email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->bind_result($admin_id, $admin_name, $hashed_password);
    $stmt->fetch();

    if(password_verify($admin_password, $hashed_password))
    {
        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['login_success'] = "";
        header('location: ../admin/home.php');
    }
    else
    {
        $_SESSION['wrong_password'] = "";
        header('location: ../admin/index.php');
    }

}
?>