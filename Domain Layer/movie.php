<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'Imovie.php';
class Movie implements IMovie
{
    protected $title;
    protected $releaseYear;
    protected $genre;
    protected $ratings;
    protected $duration;
    protected $director;
    protected $producer;
    protected $awards = [];
    protected $actors = [];
    protected $type;

    public function __construct($title, $releaseYear, $genre, $ratings, $duration, $director, $producer, $type)
    {
        $this->title = $title;
        $this->releaseYear = $releaseYear;
        $this->genre = $genre;
        $this->ratings = $ratings;
        $this->duration = $duration;
        $this->director = $director;
        $this->producer = $producer;
        $this->type = $type;
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
}
