<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// echo "<br>i am in the movie class";
require_once 'Imovie.php';
class Movie implements IMovie
{
    protected $title;
    protected $releaseYear;
    protected $genre;
    protected $ratings;
    protected $duration;
    protected $director;
    protected $producer;
    protected $type;
    protected $conn;

    public function __construct($title=null, $releaseYear=null, $genre=null, $ratings=null, $duration=null, $director=null, $producer=null, $type=null,$conn=null)
    {
        $this->title = $title;
        $this->releaseYear = $releaseYear;
        $this->genre = $genre;
        $this->ratings = $ratings;
        $this->duration = $duration;
        $this->director = $director;
        $this->producer = $producer;
        $this->type = $type;
        $this->conn=$conn;
    }



    public function getDescription($attribute, $conn, $searchValue)
    {
        // Validate the attribute

    }
    public function saveToDatabase($conn) {}

    public function updateDetails($newDetails)
    {
        foreach ($newDetails as $key => $value) {
            if (!empty($value)) {
                $this->$key = $value;
            }
        }
    }
    public function searchMovies($attribute, $searchValue)
    {
        $validAttributes = ['title', 'releaseYear', 'genre', 'ratings', 'duration', 'director', 'producer', 'songs', 'language'];
        if (!in_array($attribute, $validAttributes)) {
            throw new Exception("Invalid search attribute.");
        }

        $sql = "SELECT * FROM bollywood WHERE $attribute LIKE ? UNION SELECT * FROM hollywood WHERE $attribute LIKE ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        $searchValue = "%$searchValue%";
        $stmt->bind_param("ss", $searchValue, $searchValue);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        return $result;
    }
}
