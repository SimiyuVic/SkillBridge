<?php

session_start();

if(isset($_SESSION['user_id']))
{
    $_SESSION['must_login'] = "";
    header('location: ../login.php');
}

require_once('../config/config.php');

if(isset($_POST['add_skill']) && isset($_FILES['project_image']))
{
    $project_title = $_POST['project_title'];
    $project_link = $_POST['project_link'];
    $project_info = $_POST['project_info'];
    $project_description = $_POST['project_description'];

    //File upload
    $img_name = $_FILES['project_image']['name'];
    $img_size = $_FILES['project_image']['img_size'];
    $tmp_name = $_FILES['project_image']['tmp_name'];
    $error    = $_FILES['project_image']['error'];

    if($error == 0)
    {
        if($img_size > 125000)
        {
            $_SESSION['image_size'] = "";
            header('location: ../users/portfolio.php');
        }
        else
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            //Allowed formats
            $allowed_exs = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_exs))
            {
                $new_img_name = uniqid("IMG-", true) .'.'. $img_ex_lc;
                $target_directory = '../uploads/portfolio/' .$new_img_name;
                move_uploaded_file($tmp_name, $target_directory);

                //Prepare sql statements
                $sql = "INSERT INTO portfolio(user_id, project_title, project_link, project_info, project_description, project_image)
                VALUES(?, ?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($sql);
                
                if($stmt)
                {
                   //Bind parameters 
                   $stmt->bind_param("isssss", $_SESSION['user_id'], $project_title, $project_link, $project_info, $project_description, $new_img_name);

                   if($stmt->execute())
                   {
                    $_SESSION['skill_added'] = "";
                    header('location: ../users/portfolio.php');
                   }
                   else 
                   {
                    $_SESSION['skill_not_added'] = "";
                    header('location: ../users/portfolio.php');
                   }
                   $stmt-close();
                }
                else 
                {
                    $_SESSION['error_statement'] = "";
                    header('location: ../users/portfolio.php');
                }
            }
            else 
            {
                $_SESSION['allowed_extension'] = "";
                header('location: ../users/portfolio.php');
            }
        }
    }
    else 
    {
        $_SESSION['image_error'] = "";
        header('location: ../users/portfolio.php');
    }
}
$connection-close();
?>