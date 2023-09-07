<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/film.php'; 
$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$films = Film::getAll($conn);

if ($films && $films->num_rows > 0) {
    $filmArray = array();
    while ($row = $films->fetch_assoc()) {
        $filmArray[] = $row;
    }
    echo json_encode($filmArray);
} else {
    echo json_encode(array('error' => 'Nema dostupnih filmova.'));
}

$conn->close();
?>
