<?php
// echo "i am in the hollywood movie";
require_once 'movie.php';
class HollyWoodMovie extends Movie
{
    private $boxOffice;
    private $language;

    public function __construct(
        $title = null,
        $releaseYear = null,
        $genre = null,
        $ratings = null,
        $duration = null,
        $director = null,
        $producer = null,
        $boxOffice = null,
        $language = null
    ) {
        parent::__construct($title, $releaseYear, $genre, $ratings, $duration, $director, $producer, "hollywood");
        $this->boxOffice = $boxOffice;
        $this->language = $language;
    }

    public function getDescription($attribute, $conn, $searchValue) {}

    public function saveToDatabase($conn)
    {
        $result = $conn->query("SHOW TABLES LIKE 'hollywood'");
        if ($result->num_rows == 0) {

            $createTableSql = "CREATE TABLE hollywood (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                releaseYear YEAR NOT NULL,
                genre VARCHAR(255) NOT NULL,
                ratings FLOAT NOT NULL,
                duration INT NOT NULL,
                director VARCHAR(255) NOT NULL,
                producer VARCHAR(255) NOT NULL,
                boxOffice FLOAT,
                language VARCHAR(50),
                type VARCHAR(250) NOT NULL
            )";
            $conn->query($createTableSql);
        }


        $insertSql = "INSERT INTO hollywood (title, releaseYear, genre, ratings, duration, director, producer, boxOffice, language, type) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'hollywood')";

        $stmt = $conn->prepare($insertSql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }


        $stmt->bind_param("ssssissss", $this->title, $this->releaseYear, $this->genre, $this->ratings, $this->duration, $this->director, $this->producer, $this->boxOffice, $this->language);

        if ($stmt->execute()) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
