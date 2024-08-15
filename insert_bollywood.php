<?php
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $releaseYear = $_POST['release_year'];
    $genre = $_POST['genre'];
    $ratings = $_POST['ratings'];
    $duration = $_POST['duration'];
    $director = $_POST['director'];
    $producer = $_POST['producer'];
    $songs = $_POST['songs'];
    $language = $_POST['language'];

    // Create table if it doesn't exist
    $createTableSql = "CREATE TABLE IF NOT EXISTS bollywood (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        releaseYear YEAR NOT NULL,
        genre VARCHAR(50) NOT NULL,
        ratings FLOAT,
        duration INT,
        director VARCHAR(255),
        producer VARCHAR(255),
        songs TEXT,
        language VARCHAR(50),
        type ENUM('bollywood') NOT NULL
    )";

    if ($conn->query($createTableSql) !== TRUE) {
        die("Error creating table: " . $conn->error);
    }

    // Prepare SQL to insert data
    $insertSql = "INSERT INTO bollywood (title, release_year, genre, ratings, duration, director, producer, songs, language, type) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'bollywood')";

    $stmt = $conn->prepare($insertSql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("ssisissss", $title, $releaseYear, $genre, $ratings, $duration, $director, $producer, $songs, $language);

    if ($stmt->execute()) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
