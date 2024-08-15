<?php

class SearchMovieHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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
        $query = "SELECT * FROM " . "bollywood" ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    public function getAllHollywoodMovies()
    {
        $query = "SELECT * FROM " . "hollywood" ;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
