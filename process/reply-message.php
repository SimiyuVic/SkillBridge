<?php
session_start();
if(!isset($_SESSION['company_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}
require_once '../config/config.php';

if(isset($_POST['reply_message']))
{
    $message_id = $_POST['message_id'];
    $user_id =  $_POST['user_id'];
    $company_id = $_SESSION['company_id'];
    $reply_message_content = $_POST['reply_message_content'];
    $sender = 'company';

    if(!empty($reply_message_content))
    {
        $sql = "INSERT INTO reply_messages(message_id, user_id, company_id, sender, reply_message_content) VALUES(?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iiiss", $message_id, $user_id, $company_id, $sender, $reply_message_content);
        if($stmt->execute())
        {
            $_SESSION['reply_sent'] = "";
            header('location: ../employers/read-message.php?message_id=' . $message_id); 
        }
        else
        {
            $_SESSION['failed_reply'] = "";
            header('location: ../employers/messages.php'); 
        }
    }
    else
    {
        $_SESSION['empty_reply'] = "";
        header('location: ../employers/messages.php');
    }
}
?>