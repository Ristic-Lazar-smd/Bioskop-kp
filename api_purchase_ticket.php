<?php
header('Content-Type: application/json');
include 'dbBroker.php';
include 'model/rezervacija.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["filmID"]) && isset($_GET["sedisteID"])) {
    $filmID = $_GET["filmID"];
    $sedisteID = $_GET["sedisteID"];

    $filmID = isset($_GET["filmID"]) ? $_GET["filmID"] : null;
    $sedisteID = isset($_GET["sedisteID"]) ? $_GET["sedisteID"] : null;
    
    if ($filmID !== null && $sedisteID !== null) {
        $conn = new mysqli($host, $username, $password, $db);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $isReserved = Rezervacija::isSeatReserved($filmID, $sedisteID, $conn);
    
        if ($isReserved) {
            echo json_encode(array('success' => false, 'message' => 'Sedište je već rezervisano.'));
        } else {
            $query = "INSERT INTO rezervacija (filmID, sedisteID) VALUES ('$filmID', '$sedisteID')";
    
            if ($conn->query($query) === TRUE) {
                echo json_encode(array('success' => true, 'message' => 'Uspešno ste kupili kartu.'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Kupovina nije uspela.'));
            }
    
            $conn->close();
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Nedostaju parametri filmID ili sedisteID.'));
    }
    
}
?>
