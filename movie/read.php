<?php
// Debugging Line
ini_set('display_errors', 1);

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-6");

// 1. Include Database and Objects
include_once '../config/database.php';
include_once '../objects/movie.php';

// 2. Instantiate database and movie object
$database = new Database();
$db_connector = $database->getConnection();

$movie = new Movie($db_connector);

// 3. Query movies based on different requests

if(isset($_GET['id'])){
    // b. /movie/read.php?id=1 ===> reutrn movie that has ID = 1
    $results = $movie->getMovieByID($_GET['id']);

} elseif(isset($_GET['genre'])) {
    // c. /movie/read.php?genre=action ===> return all action movies
    $results = $movie->getMovieByGenre($_GET['genre']);

} else {
    // a. /movie/read.php ===> return all movies
    $results = $movie->getMovies();
}





// $results = [
//     'test-key'=>'test-value'
// ];

// 4. Return the data in JSON format (remove JSON_PRETTY_PRINT once done testing)
echo json_encode($results);
exit;