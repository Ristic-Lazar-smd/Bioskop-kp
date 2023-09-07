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


    public static function getReservedSeatsForFilm($filmID, mysqli $conn)
    {
        $q = "SELECT sedisteID FROM rezervacija WHERE filmID='$filmID'";
        $result = $conn->query($q);
    
        $reservedSeats = array();
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reservedSeats[] = $row["sedisteID"];
            }
        }
    
        return $reservedSeats;
    }

    public static function isSeatReserved($filmID, $sedisteID, $conn) {
        $query = "SELECT * FROM rezervacija WHERE filmID = '$filmID' AND sedisteID = '$sedisteID'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            return true; 
        } else {
            return false;
        }
    }


}
