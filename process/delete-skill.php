<?php

session_start();

@require_once "../config/config.php";

if (isset($_GET['id'])) {
    $currentUser = $_SESSION['user_id'];
    $recordId = mysqli_real_escape_string($connection, $_GET['id']);

    // Retrieve the image filename before deleting the portfolio entry
    $getImageFilenameQuery = "SELECT profile FROM portfolio WHERE user_id = '$currentUser' AND portfolio_id = '$recordId'";
    $imageResult = mysqli_query($connection, $getImageFilenameQuery);

    if ($imageResult) {
        $imageRow = mysqli_fetch_assoc($imageResult);
        $imageFilename = $imageRow['profile'];

        // Delete the portfolio entry
        $deleteQuery = "DELETE FROM portfolio WHERE user_id = '$currentUser' AND portfolio_id = '$recordId'";
        $deleteResult = mysqli_query($connection, $deleteQuery);

        if ($deleteResult) {
            // Delete the associated image file
            $imageFilePath = '../uploads/profile/' . $imageFilename;
            if (file_exists($imageFilePath)) {
                unlink($imageFilePath);
            }

            $_SESSION['deleted'] = "";
            header('location: ../users/create-portfolio.php');
        } else {
            $_SESSION['delete_failed'] = "" . mysqli_error($connection);
            header('location: ../users/create-portfolio.php');
        }
    } else {
        $_SESSION['delete_failed'] = "" . mysqli_error($connection);
        header('location: ../users/create-portfolio.php');
    }
} else {
    // Handle case where $_GET['id'] is not set
    $_SESSION['delete_failed'] = "";
    header('location: ../users/create-portfolio.php');
}

?>
