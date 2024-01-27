<?php
require_once 'config/config.php';

// Retrieve search parameters from the form
$jobTitle = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';
$qualification = isset($_POST['qualification']) ? $_POST['qualification'] : '';

// Build the SQL query based on the search parameters
$sql = "SELECT e.company_logo,
        jp.jobpost_id, jp.job_title, jp.job_description, jp.designation, jp.location, 
        jp.expected_salary, jp.status, jp.expiration_date
        FROM job_post AS jp
        JOIN employers AS e ON jp.company_id = e.company_id
        WHERE jp.status = '2'";

if (!empty($jobTitle)) {
    $sql .= " AND jp.job_title LIKE '%$jobTitle%'";
}

if (!empty($location)) {
    $sql .= " AND jp.location LIKE '%$location%'";
}

if (!empty($qualification)) {
    $sql .= " AND jp.qualification LIKE '%$qualification%'";
}

$sql .= " ORDER BY jp.created_at DESC";

// Execute the query and display the results
$result = $connection->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Display the job details as before
        // ...
    }
} else {
    // Handle the case where no jobs match the search criteria
    echo "No jobs found.";
}

// Close the database connection
$connection->close();
?>
