<?php

require_once '../Domain Layer/bollywood.php'; 

class AddBollywoodMovieHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleRequest($postData) {
 
        $title = $postData['title'];
        $releaseYear = $postData['releaseYear'];
        $genre = $postData['genre'];
        $ratings = $postData['ratings'];
        $duration = $postData['duration'];
        $director = $postData['director'];
        $producer = $postData['producer'];
        $songs = $postData['songs'];
        $language = $postData['language'];

    
        $movie = new BollywoodMovie($title, $releaseYear, $genre, $ratings, $duration, $director, $producer, $songs, $language);

     
        $movie->saveToDatabase($this->conn);

        echo "Movie added successfully!";
    }
}
?>
