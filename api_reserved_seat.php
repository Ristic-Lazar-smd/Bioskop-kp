<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/rezervacija.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["filmID"]) && isset($_GET["sedisteID"])) {
    $filmID = $_GET["filmID"];
    $sedisteID = $_GET["sedisteID"];

    // Kreirajte instancu konekcije na bazu podataka
    $conn = new mysqli($host, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $isReserved = Rezervacija::isSeatReserved($filmID, $sedisteID, $conn);

    // Vratite rezultat kao JSON
    echo json_encode(array('reserved' => $isReserved));

    // Zatvorite konekciju na bazu podataka
    $conn->close();
}
?>