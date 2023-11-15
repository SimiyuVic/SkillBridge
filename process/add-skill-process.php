<?php
session_start();

@require_once "../config/config.php";

if(isset($_POST['add_skill']) && isset($_FILES['profile']))
{
        $project_title = mysqli_real_escape_string($connection, $_POST['project_title']);
        $project_info = mysqli_real_escape_string($connection, $_POST['project_info']);
        $project_description = mysqli_real_escape_string($connection, $_POST['project_description']);
        $project_link = mysqli_real_escape_string($connection, $_POST['project_link']);

    
        //upload logo
        $img_name = $_FILES['profile']['name'];
        $img_size = $_FILES['profile']['img_size'];
        $tmp_name = $_FILES['profile']['tmp_name'];
        $error = $_FILES['profile']['error'];

        if($error === 0)
        {
            if($img_size > 125000)
            {
                $_SESSION['image_size']= "";
                header('location: ../users/add-skill.php');
            }
            else 
            {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if(in_array($img_ex, $allowed_exs))
                {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '../uploads/profile/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    
                    $sql = "INSERT INTO portfolio(user_id, project_title, project_info, project_description, project_link, profile) 
                    VALUES('$_SESSION[user_id]','$project_title', '$project_info', '$project_description', '$project_link', '$new_img_name')";
    
                    $result = mysqli_query($connection, $sql);
    
                    if(!$result)
                    {
                        $_SESSION['failed_register'] = "";
                        header('location: ../users/add-skill.php');
                    }
                    else
                    {
                        $_SESSION['add_project'] = ""; 
                        header('location: ../users/create-portfolio.php');
                    }

                }
            }
        }
        else
        {
            $_SESSION['upload_error'] = "";
            header('location: ../users/add-skill.php');
        }  
}

?>