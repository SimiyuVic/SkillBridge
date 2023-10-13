<?php
// Start the session
session_start();

unset($_SESSION['fullname']);

// Destroy the session data
session_destroy();

// Redirect the user to the login page 
header("location: index.php"); 
exit;
?>
