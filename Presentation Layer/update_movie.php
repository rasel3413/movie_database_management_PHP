<?php
include 'header.php';
?>
<?php
include '../Data Layer/db_connect.php';
include '../Domain Layer/movie.php';
require '../Application Layer/movie_manager.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['searchValue'])) {
        $attribute = $_POST['attribute'];
        $searchValue = $_POST['searchValue'];
        $handler = new MovieManager($conn);


        $result =  $handler->searchMovies($attribute, $searchValue);

        if ($result->num_rows > 0) {
            echo '<form method="post" action="update_movie.php">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped ">';
            echo '<thead><tr><th>Select</th><th>ID</th><th>Title</th><th>Release Year</th><th>Genre</th><th>Ratings</th><th>Duration</th><th>Director</th><th>Producer</th><th>Songs/BoxOffice</th><th>Language</th><th>Type</th></tr></thead><tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><input type="radio" name="update_id" value="' . $row['id'] . '"></td>';
                foreach ($row as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo '<input type="hidden" name="movie_type" value="' . $row['type'] . '">';
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '</div>';
            echo '<button type="submit" name="edit_movie" class="btn btn-primary text-center">Edit Selected Movie</button>';
            echo '</form>';
        } else {
            echo '<div class="alert alert-info" role="alert">No results found.</div>';
        }
    }

    if (isset($_POST['edit_movie'])) {
        $updateId = $_POST['update_id'];
        $movieType = $_POST['movie_type'];

        $table = $movieType == 'bollywood' ? 'bollywood' : 'hollywood';

        $sql = "SELECT * FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $updateId);
        $stmt->execute();
        $result = $stmt->get_result();
        $movie = $result->fetch_assoc();

        if (!$movie) {
            $alternateTable = $movieType == 'bollywood' ? 'hollywood' : 'bollywood';
            $sql = "SELECT * FROM $alternateTable WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("i", $updateId);
            $stmt->execute();
            $result = $stmt->get_result();
            $movie = $result->fetch_assoc();

            $movieType = $alternateTable;
        }

        if (!$movie) {
            echo '<div class="alert alert-danger" role="alert">Movie not found in either table.</div>';
            return;
        }

        echo '<form method="post" action="update_movie.php">';
        echo '<div class="card p-4 mx-auto" style="max-width: 600px;">';
        echo '<h4 class="mb-4 text-center">Edit Movie Details</h4>';
        echo '<input type="hidden" name="update_id" value="' . $updateId . '">';
        echo '<input type="hidden" name="movie_type" value="' . $movieType . '">';
        foreach ($movie as $key => $value) {
            if ($key !== 'id') {
                echo '<div class="mb-3">';
                echo '<label for="' . $key . '" class="form-label">' . ucfirst($key) . '</label>';
                echo '<input type="text" class="form-control" id="' . $key . '" name="' . $key . '" value="' . htmlspecialchars($value) . '">';
                echo '</div>';
            }
        }
        echo '<button type="submit" name="update_movie" class="btn btn-success">Update Movie</button>';
        echo '</div>';
        echo '</form>';

        $stmt->close();
    }

    if (isset($_POST['update_movie'])) {
        $updateId = $_POST['update_id'];
        $movieType = $_POST['movie_type'];
        $table = $movieType == 'bollywood' ? 'bollywood' : 'hollywood';


        $columns = ['title', 'releaseYear', 'genre', 'ratings', 'duration', 'director', 'producer', 'songs', 'language'];
        $updateFields = [];
        $updateValues = [];
        foreach ($columns as $column) {
            if (isset($_POST[$column])) {
                $updateFields[] = "$column = ?";
                $updateValues[] = $_POST[$column];
            }
        }

        $sql = "UPDATE $table SET " . implode(', ', $updateFields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $types = str_repeat('s', count($updateValues)) . 'i';
        $updateValues[] = $updateId;
        $stmt->bind_param($types, ...$updateValues);

        if ($stmt->execute()) {
            echo "Movie updated successfully.";
        } else {
            echo "Error updating movie: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Search and Update Movies</h1>

        <form action="update_movie.php" method="post">
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

        <div class="results mt-4">
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchValue'])) { /* This will include the search results */
            } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>