<?php

$host = "YOUR_RDS_ENDPOINT";
$username = "admin";
$password = "YOUR_RDS_PASSWORD";
$database = "student_db";
$port = 3306;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
