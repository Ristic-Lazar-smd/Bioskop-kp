<?php

class Rezervacija
{
    public $rezID;
    public $filmID;
    public $salaID;
    public $sedisteID;

    public function __construct($rezID = null, $filmID = null, $salaID = null, $sedisteID = null)
    {
        $this->rezID = $rezID;
        $this->filmID = $filmID;
        $this->salaID = $salaID;
        $this->sedisteID = $sedisteID;
    }

    public static function getAll(mysqli $conn)
    {
        $q = "SELECT * FROM rezervacija";
        return $conn->query($q);
    }

    public static function deleteById($rezID, mysqli $conn)
    {
        $q = "DELETE FROM rezervacija WHERE rezID=$rezID";
        return $conn->query($q);
    }

    public static function add($filmID, $salaID, $sedisteID, mysqli $conn)
    {
        $q = "INSERT INTO rezervacija(filmID, salaID, sedisteID) values('$filmID', '$salaID', '$sedisteID')";
        return $conn->query($q);
    }

    public static function update($rezID, $filmID, $salaID, $sedisteID,  mysqli $conn)
    {
        $q = "UPDATE rezervacija set filmID='$filmID', salaID='$salaID', sedisteID='$sedisteID' where rezID=$rezID";
        return $conn->query($q);
    }

    public static function getById($rezID, mysqli $conn)
    {
        $q = "SELECT * FROM rezervacija WHERE rezID=$rezID";
        $myArray = array();
        if ($result = $conn->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
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
