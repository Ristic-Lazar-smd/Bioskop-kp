<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/rezervacija.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["filmID"])) {
    $filmID = $_GET["filmID"];

    $conn = new mysqli($host, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $reservedSeats = Rezervacija::getReservedSeatsForFilm($filmID, $conn);

    echo json_encode(array('reservedSeats' => $reservedSeats));

    $conn->close();
}

?>
