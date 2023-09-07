<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/sediste.php';

$conn = new mysqli($host, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$seats = Sediste::getAll($conn);

if ($seats) {
    $seatsArray = array();
    while ($row = $seats->fetch_assoc()) {
        $seatsArray[] = $row;
    }
    echo json_encode($seatsArray);
} else {
    echo json_encode(array('error' => 'Nema dostupnih sedišta.'));
}

$conn->close();
?>
