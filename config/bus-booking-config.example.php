<?php
// Copy this file to /var/www/bus-booking-config.php on EC2.
// Never commit the real password to GitHub.

$db_host = "YOUR_RDS_ENDPOINT";
$db_name = "bus_booking";
$db_user = "admin";
$db_pass = "YOUR_RDS_PASSWORD";

$conn = new mysqli($db_host,$db_user,$db_pass,$db_name);
if($conn->connect_error){die("Database connection failed");}
$conn->set_charset("utf8mb4");
?>