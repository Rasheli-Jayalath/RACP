<?php
$host = "localhost";
$userName = "root";
$password = "SJ_Smec@egc_2012";
$dbName = "teesstt";
// Create database connection
$conn = new mysqli($host, $userName, $password, $dbName);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>
