<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/sediste.php';


// Kreirajte instancu konekcije na bazu podataka
$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pozovite statičku metodu za dohvat svih sedišta
$seats = Sediste::getAll($conn);

// Proverite da li postoje sedišta i vratite ih u JSON formatu
if ($seats) {
    $seatsArray = array();
    while ($row = $seats->fetch_assoc()) {
        $seatsArray[] = $row;
    }
    echo json_encode($seatsArray);
} else {
    echo json_encode(array('error' => 'Nema dostupnih sedišta.'));
}

// Zatvorite konekciju na bazu podataka
$conn->close();
?>
