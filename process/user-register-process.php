<?php

session_start();

@require_once '../config/config.php';

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $occupation = $_POST['occupation'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $study = $_POST['study'];
    $description = $_POST['description'];
    $skills = $_POST['skills'];

    // Check for empty details
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone_number) || empty($occupation) || empty($password) || empty($study) || empty($description) || empty($skills)) {
        $_SESSION['empty_details'] = "";
        header('location: ../user-register.php');
    } 
    else 
    {
        // Check if email already exists
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $result = $connection->prepare($sql);

        if ($result) 
        {
            $result->bind_param("s", $email);
            $result->execute();
            $result->bind_result($count);
            $result->fetch();

            // Close the result set before proceeding with a new query
            $result->close();
            
            // Check count of rows
            if ($count > 0) 
            {
                $_SESSION['email_exists'] = "";
                header('location: ../user-register.php');
            } 
            else 
            {
                // Proceed with registration
                $query = "INSERT INTO users (firstname, lastname, email, phone_number, occupation, password, study, description, skills) VALUES(?, ?, ?, ? ,? ,? ,? ,?, ?)";
                $stmt = $connection->prepare($query);

                if ($stmt) 
                {
                    // Bind the parameters and execute the statement
                    $stmt->bind_param("sssssssss", $firstname, $lastname, $email, $phone_number, $occupation, $password, $study, $description, $skills);

                    if ($stmt->execute()) 
                    {
                        $_SESSION['register_success'] = "";
                        header('location: ../user-login.php');
                    } 
                    else 
                    {
                        $_SESSION['register_failed'] = "";
                        header('location: ../user-register.php');
                    }
                    // Close the statement
                    $stmt->close();
                } 
                else 
                {
                    $_SESSION['error_statement'] = "";
                    header('location: ../user-register.php');
                }
            }
        }
    }
}

// Close database connection
$connection->close();
?>
