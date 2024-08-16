<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "movid_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the database.";

    // header("Location:index.php");
}
