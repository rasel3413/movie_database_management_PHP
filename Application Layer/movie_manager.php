<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// echo "i am in the manager movie";
require_once '../Domain Layer/bollywood.php'; 
require_once '../Domain Layer/hollywood.php';
require_once '../Domain Layer/movie.php';
class MovieManager{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function addHollywood($postData) {
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
        public function addBollywood($postData) {
 
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
        public function searchMovies($attribute, $searchValue)
        {
            
            $movie=new Movie(conn:$this->conn);
            $result=$movie->searchMovies($attribute, $searchValue);
            return $result;
        }
        public function getAllMovies()
        {
            $query = "SELECT * FROM " . "bollywood" . " UNION SELECT * FROM  hollywood";
    
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result;
        }
        public function getAllBollywoodMovies()
        {
            $query = "SELECT * FROM bollywood";
    
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result;
        }
        public function getAllHollywoodMovies()
        {
            $query = "SELECT * FROM hollywood";
    
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            return $result;
        }

}
?>