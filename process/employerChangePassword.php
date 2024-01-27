<?php
session_start();

if(!isset($_SESSION['company_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}

require_once '../config/config.php';

if(isset($_POST['change_password']))
{
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    //Prepare statement to check the old password
    $sql = "SELECT password FROM employers WHERE company_id = ?";
    $stmt = $connection->prepare($sql);
    //Bind the parameters
    $stmt->bind_param("i",$_SESSION['company_id']);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if(password_verify($old_password, $hashed_password))
    {
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            if($old_password == $new_password)
            {
                $_SESSION['same_password'] = "";
                header('location: ../employers/settings.php');
            }
            else
            {

            

                //Update Password
                $sql_update = "UPDATE employers SET password = ? WHERE company_id = ?";
                $stmt_update = $connection->prepare($sql_update);
                $stmt_update->bind_param("si", $hashed_new_password, $_SESSION['company_id']);

                if($stmt_update->execute())
                {
                    $_SESSION['change_success'] = "";
                    header('location: ../employers/settings.php');
                }
                else
                {
                    $_SESSION['change_fail'] = "";
                    header('location: ../employers/settings.php'); 
                }
            }    
    }
    else
    {
        $_SESSION['wrong_password'] = "";
        header('location: ../employers/settings.php');
    }
}

?>