<?php
include 'header.php';
?>
<?php
include '../Data Layer/db_connect.php'; 
include '../Domain Layer/movie.php'; 
require '../Application Layer/movie_manager.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $movieType = $_POST['movie_type'];

        $table = $movieType == 'bollywood' ? 'bollywood' : 'hollywood';

        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }


        $stmt->bind_param("i", $deleteId);

        if ($stmt->execute()) {
            echo "Movie deleted successfully.";
        } else {
            echo "Error deleting movie: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $attribute = $_POST['attribute'];
        $searchValue = $_POST['searchValue'];
        $handler = new MovieManager($conn);


        $result =  $handler->searchMovies($attribute, $searchValue);
        if ($result->num_rows > 0) {
            echo '<form method="post" action="delete_movie.php"class="m-4">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead><tr><th>Select</th><th>ID</th><th>Title</th><th>Release Year</th><th>Genre</th><th>Ratings</th><th>Duration</th><th>Director</th><th>Producer</th><th>Songs/BoxOffice</th><th>Language</th><th>Type</th></tr></thead><tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><input type="radio" name="delete_id" value="' . $row['id'] . '"></td>';
                foreach ($row as $key => $value) {

                    echo "<td>$value</td>";
                }
                echo '<input type="hidden" name="movie_type" value="' . $row['type'] . '">';
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<button type="submit" class="btn btn-danger">Delete Selected Movie</button>';
            echo '</form>';
        } else {
            echo '<div class="alert alert-info" role="alert">No results found.</div>';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Search and Delete Movies</h1>

        <form action="delete_movie.php" method="post">
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
                    <option value="songs">Songs/BoxOffice</option>
                    <option value="language">Language</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="searchValue" class="form-label">Search Value</label>
                <input type="text" class="form-control" id="searchValue" name="searchValue" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>