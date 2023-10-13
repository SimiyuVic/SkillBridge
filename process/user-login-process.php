<?php
session_start();

@require_once "../config/config.php";

// Define the getUserInfo function
function getUserInfo($email, $connection) {
    $email = mysqli_real_escape_string($connection, $email);

    $sql = "SELECT firstname, lastname FROM candidates WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $userInfo = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $userInfo;
    } else {
        return false; // User not found or error occurred
    }
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $password = base64_encode(strrev(md5($password)));

    $sql = "SELECT * FROM candidates WHERE email = '$email' && password = '$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $email;

        // Get the user's first name and last name using getUserInfo function
        $userInfo = getUserInfo($email, $connection);

        if ($userInfo) {
            $_SESSION['user_id'] = $userInfo['user_id'];
            $_SESSION['firstname'] = $userInfo['firstname'];
            $_SESSION['lastname'] = $userInfo['lastname'];
        }

        header('location: ../users/index.php');
        exit;
    } else {
        header('location: ../user-login.php');
        $_SESSION['login_error'] = "";
    }
}

mysqli_close($connection);
?>
