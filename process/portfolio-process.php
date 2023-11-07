<?php
session_start();

require_once '../config/config.php';

if(isset($_POST['register']))
{
    $project_title = mysqli_real_escape_string($connection, $_POST['project_title']);
    $project_description = mysqli_real_escape_string($connection, $_POST['project_description']);
    $project_link = mysqli_real_escape_string($connection, $_POST['project_link']);

    // File upload
   /* $img_name = $_FILES['project_preview']['name'];
    $img_size = $_FILES['project_preview']['size'];
    $tmp_name = $_FILES['project_preview']['tmp_name'];
    $error = $_FILES['project_preview']['error'];

    if ($error === 0) {
        if ($img_size > 125000) 
        {
            $_SESSION['image_size'] = "Image size should be less than 125KB.";
            header('location: ../users/add-project.php');
        } 
        else 
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex, $allowed_exs)) 
            {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../uploads/profile/' . $new_img_name;

                if (move_uploaded_file($tmp_name, $img_upload_path)) 
                {
                    */
    $sql = "INSERT INTO portfolio (user_id, project_title, project_description, project_link, )
    VALUES('$_SESSION[user_id]', '$project_title', '$project_description', '$project_link')";

    $result = mysqli_query($connection, $sql);

    if($result)
    {
        $_SESSION['add_project'] = "";
        header('location: ../users/create-portfolio.php');
    }
    else 
    {
        $_SESSION['project_error'] = "";
        header('location: ../users/add-skill.php');
    }


                   /* if ($result = mysqli_query($connection, $sql)) 
                    {
                        $_SESSION['register_success'] = "Project added successfully.";
                        header('location: ../users/create-portfolio.php');
                    } 
                    else 
                    {
                        $_SESSION['upload_error'] = "Query failed: " . mysqli_error($connection);
                        header('location: ../users/add-project.php');
                    }
                } 
                else 
                {
                    $_SESSION['upload_error'] = "Error moving the uploaded file.";
                    header('location: ../users/add-project.php');
                }
            } 
            else 
            {
                $_SESSION['upload_error'] = "Invalid image format. Allowed formats: jpg, jpeg, png.";
                header('location: ../users/add-project.php');
            }
        }
    } 
    else 
    {
        $_SESSION['upload_error'] = "File upload error: $error";
        header('location: ../users/add-project.php');
    } */
}
?>
