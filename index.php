<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .btn-group .btn {
            width: 100%;
            max-width: 300px;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #434b52);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #2b2d2f);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #ff6b6b);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #ff4d4d);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e0a800, #ff8700);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #66c466);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #4bbf4b);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #4db8ff);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #117a8b, #3a9ad7);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .btn-dark {
            background: linear-gradient(135deg, #343a40, #495057);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-dark:hover {
            background: linear-gradient(135deg, #23272b, #3b4147);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);

        }

        .results {
            margin-top: 20px;
        }

        .results .alert {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="mb-4 text-center">Movie Database Manager</h1>

        <div class="row mb-4">
            <div class="col-md-6 d-flex justify-content-center">
                <form class="form" action="Application Layer/movie_service.php" method="get">
                    <div class="btn-group" role="group">
                        <a href="/movie_database_management/Presentation Layer/add_bollywood.php" class="btn btn-primary" role="button">Add a Bollywood Movie</a>
                        <a href="/movie_database_management/Presentation Layer/add_hollywood.php" class="btn btn-primary" role="button">Add a Hollywood Movie</a>
                        <a href="/movie_database_management/Presentation Layer/search_movie.php" class="btn btn-secondary" role="button">Search for a Movie by Attribute</a>
                        <a href="/movie_database_management/Presentation Layer/delete_movie.php" class="btn btn-danger" role="button">Delete a Movie</a>
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex justify-content-center">
                <form class="form" action="Application Layer/movie_service.php" method="get">
                    <div class="btn-group" role="group">
                        <a href="/movie_database_management/Presentation Layer/update_movie.php" class="btn btn-warning" role="button">Update a Movie</a>
                        <a href="/movie_database_management/Presentation Layer/show_all_movie.php" class="btn btn-success" role="button">Show all Movies</a>
                        <a href="/movie_database_management/Presentation Layer/show_all_bollywoodmovie.php" class="btn btn-info" role="button">Show all Bollywood Movies</a>
                        <a href="/movie_database_management/Presentation Layer/show_all_hollywoodmovie.php" class="btn btn-info" role="button">Show all Hollywood Movies</a>
                        <!-- <a href="#" class="btn btn-dark" role="button">Exit</a> -->
                    </div>
                </form>
            </div>
        </div>

        <div class="results">
            <?php include 'results.php'; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9b2U4O2E/6hBoUtN7iFvj8zjl68uhSf8U5K5TrH6S85IkeqZcU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-eO1U9KgytFA1PshWv1c0N3KsD4/6N8Q5H6CgU5O9vD2rxF+2P5DIIQJ34yoeG9z" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js" integrity="sha384-eO1U9KgytFA1PshWv1c0N3KsD4/6N8Q5H6CgU5O9vD2rxF+2P5DIIQJ34yoeG9z" crossorigin="anonymous"></script>
</body>

</html>