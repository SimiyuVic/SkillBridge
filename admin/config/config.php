<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "skill_bridge";

$connection = mysqli_connect($servername, $username, $password, $database);
if(!$connection)
{
    die("Connection Failed : " . mysqli_error());
}

?>
