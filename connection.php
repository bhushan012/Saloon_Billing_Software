<?php
$servername = "localhost";
$username = "u298126064_parlour";
$password = "F6[2H50>i";
//$dbname = "panchayat";
$dbname = "u298126064_parlour";
// Create connection
//global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>