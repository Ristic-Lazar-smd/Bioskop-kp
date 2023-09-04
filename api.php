<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/film.php'; 

// Kreirajte instancu konekcije na bazu podataka
$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pozovite statičku metodu za dohvat svih filmova
$films = Film::getAll($conn);

// Proverite da li postoje filmovi i vratite ih u JSON formatu
if ($films && $films->num_rows > 0) {
    $filmArray = array();
    while ($row = $films->fetch_assoc()) {
        $filmArray[] = $row;
    }
    echo json_encode($filmArray);
} else {
    echo json_encode(array('error' => 'Nema dostupnih filmova.'));
}

// Zatvorite konekciju na bazu podataka
$conn->close();
?>
