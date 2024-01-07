<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}
require_once '../config/config.php';

if(isset($_POST['user_reply_message']))
{
    $message_id = $_POST['message_id'];
    $company_id = $_POST['company_id'];
    $user_id = $_SESSION['user_id'];
    $reply_message_content = $_POST['reply_message_content'];
    $sender = 'user'; 

    if(!empty($reply_message_content))
    {
        $sql = "INSERT INTO reply_messages(message_id, user_id, company_id, sender, reply_message_content) VALUES(?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iiiss", $message_id, $user_id, $company_id, $sender, $reply_message_content);
        if($stmt->execute())
        {
            $_SESSION['reply_sent'] = "";
            header('location: ../users/messages.php'); 
        }
        else
        {
            $_SESSION['failed_reply'] = "";
            header('location: ../users/messages.php'); 
        }
    }
    else
    {
        $_SESSION['empty_reply'] = "";
        header('location: ../users/messages.php');
    }
}
?>