<?php
$servername = "localhost";
$username = "root"; // Change as necessary
$password = ""; // Change as necessary
$dbname = "c_blogpost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}