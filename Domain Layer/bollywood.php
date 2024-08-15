<?php 
include 'movie.php';
class BollywoodMovie extends Movie {
    private $songs;
    private $language;

    public function __construct($title, $releaseYear, $genre, $ratings, $duration, $director, $producer, $songs, $language) {
        parent::__construct($title, $releaseYear, $genre, $ratings, $duration, $director, $producer, "bollywood");
        $this->songs = $songs;
        $this->language = $language;
    }

    public function saveToDatabase($conn) {
      
    
        $result = $conn->query("SHOW TABLES LIKE 'bollywood'");
        if ($result->num_rows == 0) {
       
            $createTableSql = "CREATE TABLE bollywood (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                releaseYear YEAR NOT NULL,
                genre VARCHAR(255) NOT NULL,
                ratings FLOAT NOT NULL,
                duration INT NOT NULL,
                director VARCHAR(255) NOT NULL,
                producer VARCHAR(255) NOT NULL,
                songs TEXT,
                language VARCHAR(50),
                type ENUM('bollywood') NOT NULL
            )";
            $conn->query($createTableSql);
        }

        echo "i am here in the databsse";
    $insertSql = "INSERT INTO bollywood (title, releaseYear, genre, ratings, duration, director, producer, songs, language, type) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'bollywood')";

    $stmt = $conn->prepare($insertSql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssissss", $this->title, $this->releaseYear, $this->genre, $this->ratings, $this->duration, $this->director, $this->producer, $this->songs, $this->language);

    if ($stmt->execute()) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    }
}

?>