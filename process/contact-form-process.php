<?php
require_once '../config/config.php';

if(isset($_POST['contact']))
{
    $sender_name  = $_POST['sender_name'];
    $sender_email = $_POST['sender_email'];
    $sender_query = $_POST['sender_query'];

    //Inserting to database
    $sql = "INSERT INTO contact_form(sender_name, sender_email, sender_query) VALUES(?, ?, ?)";
    $stmt = $connection->prepare($sql);
    if($stmt)
    {
        $stmt->bind_param("sss", $sender_name, $sender_email, $sender_query);
        if($stmt->execute())
        {
            $_SESSION['contact_success'] = "";
            header('location: ../index.php');
        }
        else
        {
            //Could not send message.
            $_SESSION['contact_failed'] = "";
            header('location: ../index.php');
        }
    }
    else
    {
        // Log the error or handle it appropriately
        echo "Error preparing the SQL statement.";
    }
}
?>