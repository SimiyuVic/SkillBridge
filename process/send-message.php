<?php
session_start();

if(!isset($_SESSION['company_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ..login.php');
}
require_once '../config/config.php';

if(isset($_POST['send_message']))
{
    $user_id = $_POST['user_id'];
    $company_id = $_SESSION['company_id'];
    $sender = 'company';
    $message_subject = $_POST['message_subject'];
    $message_content = $_POST['message_content'];

    if(!empty($message_content))
    {
        $stmt = $connection->prepare("INSERT INTO messages(user_id, company_id, sender, message_subject, message_content) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $user_id, $company_id, $sender, $message_subject, $message_content);
        if($stmt->execute())
        {
            $_SESSION['message_send'] = "";
            header('location: ../employers/messages.php');
        }
        else
        {
            $_SESSION['send_failed'] = "";
            header('location: ../employers/create-mail.php');
        }
    }
    else
    {
        $_SESSION['empty_content'] = "";
        header('location: ../employers/create-mail.php');
    }
}
?>
