<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "skill-bridge";

// Create a connection
$connection = new mysqli($servername, $username, $password, $database);

// Check Connection
if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

// Set the character set to UTF-8 (if needed)
$connection->set_charset("utf8");

?>
