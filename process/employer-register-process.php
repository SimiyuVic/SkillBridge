<?php
session_start();

require_once '../config/config.php';

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $website = $_POST['website'];
    $county = $_POST['county'];
    $city = $_POST['city'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $description = $_POST['description'];


    //Check if email exists
    $stmt = $connection->prepare("SELECT * FROM employers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        //Email exists
        $_SESSION['email_exists'] = "";
        header('location: ../employer-register.php');
    }
    else
    {
        
            $img_name = $_FILES['company_logo']['name'];
            $img_size = $_FILES['company_logo']['size'];
            $tmp_name = $_FILES['company_logo']['tmp_name'];
            $error = $_FILES['company_logo']['error'];

            if($error == 0)
            {
                if($img_size > 125000)
                {
                    $_SESSION['image_size'] = "";
                    header('location: ../employer-register.php');
                }
                else
                {
                  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                  $img_ex_lc = strtolower($img_ex);
                  
                  $allowed_exs = array("jpg", "jpeg", "png");

                  if(in_array($img_ex_lc, $allowed_exs))
                  {
                    $new_img_name = uniqid("IMG-", true). '.' .$img_ex_lc;
                    $uploadDirectory = '../uploads/company_logo/' .$new_img_name;
                    move_uploaded_file($tmp_name, $uploadDirectory);

                    //SQL statement to register
                    $sql = "INSERT INTO employers(username, company_name, email, phone_number, website, county, city, password, description, company_logo)
                    VALUES(?,?,?,?,?,?,?,?,?,?)";
                    $stmt = $connection->prepare($sql);
                    if($stmt)
                    {
                        $stmt->bind_param("ssssssssss", $username, $company_name, $email, $phone_number, $website, $county, $city, $password, $description, $new_img_name);

                        if($stmt->execute())
                        {
                            $_SESSION['register_success'] = "";
                            header('location: ../employer-login.php');  
                        }
                        else
                        {
                            $_SESSION['register_fail'] = "";
                            header('location: ../employer-register.php');
                        }
                    }
                    else
                    {
                        $_SESSION['extension_error'] = "";
                        header('location: ../employer-register.php');
                    }  
                  }
                  else
                  {
                    $_SESSION['extension_error'] = "";
                    header('location: ../employer-register.php');
                  }
                }
            }
            else
            {
                $_SESSION['image_error'] = "";
                header('location: ../employer-register.php');
            }
        
    }
    $stmt->close();
}
$connection->close();
?>