<?php
$servername = "192.168.0.164";
$username = "ehosxp";
$password = "wanorn";
$dbname = "hosxp";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

?> 
