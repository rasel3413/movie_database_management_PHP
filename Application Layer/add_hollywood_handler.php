<?php
// echo "i am here in add bollywood handler";
// require_once '/path/to/your/Data/MovieRepository.php'; 
require_once '../Domain Layer/hollywood.php';
class AddHollywoodMovieHandler {
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
    $boxOffice = $postData['boxOffice'];
    $language = $postData['language'];

    $movie = new HollyWoodMovie($title, $releaseYear, $genre, $ratings, $duration, $director, $producer, $boxOffice, $language);

    $movie->saveToDatabase($this->conn);

    echo "Movie added successfully!";
    }
}
?>