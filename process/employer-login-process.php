<?php
session_start();

@require_once "../config/config.php";


if (isset($_POST['login'])) {

    if(empty($_POST['email']) || empty($_POST['password']))
    {
        $_SESSION['empty_details'] = "";
        header('location: ../employer-login.php');
    }
    else
    {

        //Escape Special Characters in String
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        //Encrypt Password
        //$password = base64_encode(strrev(md5($password)));

        $sql = "SELECT * FROM employers WHERE email = '$email' && password = '$password'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $_SESSION['company'] = $row['company'];
                $_SESSION['company_id'] = $row['company_id'];

                header('location: ../employers/index.php');
                $_SESSION['login_success'] = "";
            }
        } 
        else 
        {
            header('location: ../employer-login.php');
            $_SESSION['login_error'] = "";
        }
    }    
}

mysqli_close($connection);
?>
