<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Movie Database Management</title>

    <style>
        .navbar {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc3545; /* Highlight Home in a different color */
        }
        .navbar-brand:hover {
            color: #c82333;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="navbar navbar-expand-lg navbar-light shadow-sm mb-4">
    <div class="container-fluid">
        <a href="../index.php" class="navbar-brand d-flex align-items-center">
            <i class="fas fa-home me-2"></i> <!-- Home icon with FontAwesome -->
            Home
        </a>
        <button onclick="history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-circle-left"></i> <!-- Back icon with FontAwesome -->
            Back
        </button>
    </div>
</header>

<!-- Content -->
<div class="container">
    <!-- Your content here -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
