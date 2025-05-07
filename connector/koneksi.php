<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sk";

// Create connection
$kon = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$kon) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
