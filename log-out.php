<?php
// Start the session
session_start();

unset($_SESSION['username']);

// Destroy the session data
session_destroy();

// Redirect the user to the login page 
header("location: home.php"); 
exit;
?>
