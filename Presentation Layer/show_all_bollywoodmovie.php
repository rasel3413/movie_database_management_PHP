<?php
include 'header.php';
?>
<?php
include_once '../Data Layer/db_connect.php';
include_once '../Domain Layer/movie.php';
include_once '../Application Layer/search_movie_handler.php';
$handler = new SearchMovieHandler($conn);


$movies =  $handler->getAllBollywoodMovies();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">All Bollywood Movies</h1>

        <?php if ($movies->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Release Year</th>
                        <th>Genre</th>
                        <th>Ratings</th>
                        <th>Duration</th>
                        <th>Director</th>
                        <th>Producer</th>
                        <th>Songs</th>
                        <th>Language</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $movies->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo ($row['id']); ?></td>
                            <td><?php echo ($row['title']); ?></td>
                            <td><?php echo ($row['releaseYear']); ?></td>
                            <td><?php echo ($row['genre']); ?></td>
                            <td><?php echo ($row['ratings']); ?></td>
                            <td><?php echo ($row['duration']); ?></td>
                            <td><?php echo ($row['director']); ?></td>
                            <td><?php echo ($row['producer']); ?></td>
                            <td><?php echo ($row['songs']); ?></td>
                            <td><?php echo ($row['language']); ?></td>
                            <td><?php echo ($row['type']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">No movies found.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>