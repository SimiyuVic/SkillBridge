<?php
// Database configuration
$servername = 'localhost'; 
$dbname = 'skill_bridge'; 
$username = 'root'; 
$password = ''; 

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
