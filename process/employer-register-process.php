<?php
session_start();

@require_once "../config/config.php";

if(isset($_POST['register']))
{
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $company = mysqli_real_escape_string($connection, $_POST['company']);
    $website = mysqli_real_escape_string($connection, $_POST['website']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $about_company = mysqli_real_escape_string($connection, $_POST['about_company']);
    $password = base64_encode(strrev(md5($password)));
    $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
    $county = mysqli_real_escape_string($connection, $_POST['county']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);

    $sql = "SELECT * FROM employers WHERE email = '$email'";

    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['email_error'] = "";
        header('location: ../employer-register.php');
    }
    else
    {
       
           $sql = "INSERT INTO employers(fullname, company, website, email, about_company, password, phone_number, county, city) 
           VALUES('$fullname', '$company', '$website', '$email', '$about_company', '$password', '$phone_number', '$county', '$city')";
    
            $result = mysqli_query($connection, $sql);
    
            if(!$result)
            {
                die("Query Failed : " . mysqli_error());
            }
            else
            {
                $_SESSION['register_success'] = "";
                header('location: ../employer-login.php');
            }
        
    }
   
}

?>