<?php
@require_once "../config/config.php";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $sql = "SELECT username FROM admin WHERE email = '$email' && password = '$password'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $email;

        $userInfo = mysqli_fetch_assoc($result); // Fetch the first name

        if ($userInfo) {
            $_SESSION['username'] = $userInfo['username']; // Store the first name in the session
        }

        header('location: ../dashboard.php');
        exit;
    } else {
        header('location: ../index.php');
        $_SESSION['login_error'] = "";
    }
}

mysqli_close($connection);
?>
