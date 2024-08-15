<?php
    include 'header.php';
    ?>
<?php
require '../Application Layer/add_hollywood_handler.php'; 
include '../Data Layer/db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $handler = new AddHollywoodMovieHandler($conn);
    $message = $handler->handleRequest($_POST);
    echo $message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hollywood Movie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Add Hollywood Movie</h1>
    <form method="post" action="add_hollywood.php">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="releaseYear">Release Year</label>
            <input type="number" class="form-control" id="releaseYear" name="releaseYear" min="1900" max="2100" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="form-group">
            <label for="ratings">Ratings(between 0-5)</label>
            <input type="number" step="0.1" min='0' max='5' class="form-control" id="ratings" name="ratings" required>
        </div>
        <div class="form-group">
            <label for="duration">Duration (minutes)</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>
        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" class="form-control" id="director" name="director" required>
        </div>
        <div class="form-group">
            <label for="producer">Producer</label>
            <input type="text" class="form-control" id="producer" name="producer" required>
        </div>
        <div class="form-group">
            <label for="boxOffice">Box Office</label>
            <input type="number" step="0.01" class="form-control" id="boxOffice" name="boxOffice">
        </div>
        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" class="form-control" id="language" name="language">
        </div>
        <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>
</div>
</body>
</html>
