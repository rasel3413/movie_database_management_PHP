<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../Data Layer/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];

    switch ($action) {
        case 'add_bollywood':
            echo "add bollywood exectued";
            header('Location: /movie_database_management/Presentation Layer/add_bollywood.php');
            break;
        case 'add_hollywood':
            header('Location: /movie_database_management/Presentation Layer/add_hollywood.php');
            break;
        case 'search_movie':
            header('Location: /movie_database_management/Presentation Layer/search_movie.php');
            break;
        case 'delete_movie':
            header('Location: /movie_database_management/Presentation Layer/delete_movie.php');
            break;
        case 'update_movie':
            header('Location: /movie_database_management/Presentation Layer/update_movie.php');
            break;
        case 'show_all':
            header('Location: /movie_database_management/Presentation Layer/show_all_movie.php');
            break;
        case 'show_bollywood':
            header('Location: /movie_database_management/Presentation Layer/show_all_bollywoodmovie.php');
            break;
        case 'show_hollywood':
            header('Location: /movie_database_management/Presentation Layer/show_all_hollywoodmovie.php');
            break;
        case 'exit':
            exit(); // Ensure no further code is executed
            break;
        default:
            echo "Invalid action.";
    }
}
?>
