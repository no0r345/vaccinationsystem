<?php
$servername = "sql202.infinityfree.com"; // MySQL Host Name
$username = "if0_37271166";             // MySQL User Name
$password = "UYIqX5pmOM ";     // MySQL Password
$dbname = "if0_37271166_vaccinesystem"; // MySQL DB Name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 