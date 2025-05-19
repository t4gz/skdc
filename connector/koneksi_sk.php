<?php
$servername = "sql105.infinityfree.com";
$username = "if0_38890797";
$password = "sehatikomputer";
$database = "if0_38890797_sk";

// Create connection
$kon = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$kon) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
