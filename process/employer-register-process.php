<?php
session_start();

@require_once "../config/config.php";

if(isset($_POST['register']) && isset($_FILES['logo']))
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
        //upload logo
        $img_name = $_FILES['logo']['name'];
        $img_size = $_FILES['logo']['img_size'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        $error = $_FILES['logo']['error'];

        if($error === 0)
        {
            if($img_size > 125000)
            {
                $_SESSION['image_size']= "";
                header('location: ../employer-register.php');
            }
            else 
            {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if(in_array($img_ex, $allowed_exs))
                {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '../uploads/logo/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    
                    $sql = "INSERT INTO employers(fullname, company, website, email, about_company, password, phone_number, county, city, logo) 
                    VALUES('$fullname', '$company', '$website', '$email', '$about_company', '$password', '$phone_number', '$county', '$city', '$new_img_name')";
    
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
        }
        else
        {
            $_SESSION['upload_error'] = "";
            header('location: ../employer-register.php');
        }
        
        
    }
   
}

?>