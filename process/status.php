<?php
session_start();

require_once '../config/config.php';


    // Check if the form was submitted with the correct field
    if (isset($_POST["status"]) && $_POST["status"] == "Change Status" && isset($_POST["jobpost_id"])) {
        // Retrieve the jobpost_id from the form
        $jobpost_id = $_POST["jobpost_id"];

        // Fetch the current status from the database
        $query = "SELECT status FROM job_post WHERE jobpost_id = $jobpost_id";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            // Update the status
            $newStatus = ($row['status'] == 2) ? 1 : 2; // Change 2 to the value representing 'Closed' in your database

            // Update the status in the database
            $updateQuery = "UPDATE job_post SET status = $newStatus WHERE jobpost_id = $jobpost_id";
            $updateResult = mysqli_query($connection, $updateQuery);

            if ($updateResult) {
                $_SESSION['status_success'] = "";
                header('location: ../employers/posted-jobs.php');
            } else {
                echo "Error updating status: " . mysqli_error($connection);
            }
        } else {
            echo "Error fetching current status: " . mysqli_error($connection);
        }
    }

?>
