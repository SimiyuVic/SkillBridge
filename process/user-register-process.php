<?php
session_start();

@require_once "../config/config.php";

if(isset($_POST['register']))
{
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $password = base64_encode(strrev(md5($password)));
    $qualification = mysqli_real_escape_string($connection, $_POST['qualification']);
    $occupation = mysqli_real_escape_string($connection, $_POST['occupation']);
    $about_me = mysqli_real_escape_string($connection, $_POST['about_me']);
    $skills = mysqli_real_escape_string($connection, $_POST['skills']);

    $sql = "SELECT * FROM candidates WHERE email = '$email'";

    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['email_error'] = "";
        header('location: ../user-register.php');
    }
    else
    {
       
            $sql = "INSERT INTO candidates(firstname, lastname, email, phone_number, password, qualification, occupation, about_me, skills)
            VALUES('$firstname', '$lastname', '$email', '$phone_number', '$password', '$qualification', '$occupation', '$about_me', '$skills')";
    
            $result = mysqli_query($connection, $sql);
    
            if(!$result)
            {
                die("Query Failed : " . mysqli_error());
            }
            else
            {
                $_SESSION['register_success'] = "";
                header('location: ../user-login.php');
            }
        
    }
   
}

?>