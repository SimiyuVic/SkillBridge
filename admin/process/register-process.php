<?php

session_start();


include('../config/config.php'); 

if(isset($_POST['register']))
{
  $username = mysqli_real_escape_string($connection, $_POST['username']); 
  $email = mysqli_real_escape_string($connection, $_POST['email']);  
  $password = mysqli_real_escape_string($connection, $_POST['password']);
    
  if(empty($username) || empty($email) || empty($password)) 
  {
    header('location:  ../register.php');
    $_SESSION['error_message_one'] = "";
  }
  else
  {
  
      $sql_username = "SELECT * FROM admin WHERE username = '$username' ";
      $result_username = mysqli_query($connection, $sql_username);

      $sql_email = "SELECT * FROM admin WHERE email = '$email'";
      $result_email = mysqli_query($connection, $sql_email);

      if(mysqli_num_rows($result_username) > 0)
      {
        $_SESSION['username_error'] = "";
        header('location: ../register.php');
      }
      elseif(mysqli_num_rows($result_email) > 0)
      {
        $_SESSION['email_error'] = "";
        header('location: ../register.php');
      }
      else 
      {
        $sql = "INSERT INTO admin (username, email, password) VALUES('$username', '$email', '$password')";
        $result = mysqli_query($connection, $sql);

        if(!$result)
        {
            die("Registration Failed : " . mysqli_error());
        }
        else 
        {
            header('location: ../index.php');
            $_SESSION['success_message'] = "";
        }
      }
    }

  }
?>