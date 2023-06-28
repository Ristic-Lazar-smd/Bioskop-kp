<?php

class Film
{
    public $filmID;
    public $nazivFilma;

    public function __construct($filmID = null, $nazivFilma = null)
    {
        $this->filmID = $filmID;
        $this->nazivFilma = $nazivFilma;
    }

    public static function getAll(mysqli $conn)
    {
        $q = "SELECT * FROM film";
        return $conn->query($q);
    }

    public static function deleteById($filmID, mysqli $conn)
    {
        $q = "DELETE FROM film WHERE filmID=$filmID";
        return $conn->query($q);
    }

    public static function add($nazivFilma, mysqli $conn)
    {
        $q = "INSERT INTO film(nazivFilma) values('$nazivFilma')";
        return $conn->query($q);
    }

    public static function update($filmID, $nazivFilma, mysqli $conn)
    {
        $q = "UPDATE film set nazivFilma='$nazivFilma' where filmID=$filmID";
        return $conn->query($q);
    }

    public static function getById($filmID, mysqli $conn)
    {
        $q = "SELECT * FROM film WHERE filmID=$filmID";
        $myArray = array();
        if ($result = $conn->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }
}
