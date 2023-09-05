<?php

class Sediste
{
    public $sedisteID;
    public $brojSedista;

    public function __construct($sedisteID = null, $brojSedista = null)
    {
        $this->sedisteID = $sedisteID;
        $this->brojSedista = $brojSedista;
    }

    public static function getAll(mysqli $conn)
{
    $sql = "SELECT * FROM sediste";
    $result = $conn->query($sql);

    // Provera da li je upit uspešno izvršen
    if ($result === false) {
        return false; // Vratiti false ako upit nije uspeo
    }

    return $result; // Vratiti rezultat upita
}

    

    public static function deleteById($sedisteID, mysqli $conn)
    {
        $q = "DELETE FROM sediste WHERE sedisteID=$sedisteID";
        return $conn->query($q);
    }

    public static function add($brojSedista, mysqli $conn)
    {
        $q = "INSERT INTO sediste(brojSedista) values('$brojSedista')";
        return $conn->query($q);
    }

    public static function update($sedisteID, $brojSedista, mysqli $conn)
    {
        $q = "UPDATE sediste set brojSedista='$brojSedista' where sedisteID=$sedisteID";
        return $conn->query($q);
    }

    public static function isSeatReserved($filmID, $sedisteID, mysqli $conn)
    {
        $q = "SELECT COUNT(*) as count FROM rezervacija WHERE filmID='$filmID' AND sedisteID='$sedisteID'";
        $result = $conn->query($q);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row["count"];
            
            return $count > 0;
        } else {
            return false;
        }
    }
    
}
