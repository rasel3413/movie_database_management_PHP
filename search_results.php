<?php
include 'db_connect.php'; // Include database connection
include 'movie.php'; // Include Movie classes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attribute = $_POST['attribute'];
    $searchValue = $_POST['searchValue'];

    // Create a search function
    function searchMovies($conn, $attribute, $searchValue) {
        // Validate the attribute
        $validAttributes = ['title', 'releaseYear', 'genre', 'ratings', 'duration', 'director', 'producer', 'songs', 'language'];
        if (!in_array($attribute, $validAttributes)) {
            echo "Invalid search attribute.";
            return;
        }

        // Prepare the SQL query
        $sql = "SELECT id, title, releaseYear, genre, ratings, duration, director, producer, songs, language, type FROM bollywood WHERE $attribute LIKE ? 
                UNION 
                SELECT id, title, releaseYear, genre, ratings, duration, director, producer, NULL as songs, language, type FROM hollywood WHERE $attribute LIKE ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters and execute
        $searchValue = "%$searchValue%";
        $stmt->bind_param("ss", $searchValue, $searchValue);
        $stmt->execute();

        // Get results
        $result = $stmt->get_result();

        // Display results
        if ($result->num_rows > 0) {
            echo '<form action="delete_movie.php" method="post">';
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Select</th><th>ID</th><th>Title</th><th>Release Year</th><th>Genre</th><th>Ratings</th><th>Duration</th><th>Director</th><th>Producer</th><th>Songs</th><th>Language</th><th>Type</th></tr></thead><tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><input type="radio" name="movie_id" value="' . $row['id'] . '" data-type="' . $row['type'] . '"></td>';
                foreach ($row as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<button type="submit" class="btn btn-danger">Delete Selected Movie</button>';
            echo '</form>';
        } else {
            echo '<div class="alert alert-info" role="alert">No results found.</div>';
        }

        $stmt->close();
        $conn->close();
    }

    searchMovies($conn, $attribute, $searchValue);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Search Movies</h1>

    <form action="search_results.php" method="post">
        <div class="mb-3">
            <label for="attribute" class="form-label">Search Attribute</label>
            <select class="form-select" id="attribute" name="attribute">
                <option value="title">Title</option>
                <option value="releaseYear">Release Year</option>
                <option value="genre">Genre</option>
                <option value="ratings">Ratings</option>
                <option value="duration">Duration</option>
                <option value="director">Director</option>
                <option value="producer">Producer</option>
                <option value="songs">Songs</option>
                <option value="language">Language</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="searchValue" class="form-label">Search Value</label>
            <input type="text" class="form-control" id="searchValue" name="searchValue" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="results mt-4">
        <?php include 'search_results.php'; ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9b2U4O2E/6hBoUtN7iFvj8zjl68uhSf8U5K5TrH6S85IkeqZcU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-eO1U9KgytFA1PshWv1c0N3KsD4/6N8Q5H6CgU5O9vD2rxF+2P5DIIQJ34yoeG9z" crossorigin="anonymous"></script>
</body>

</html>
