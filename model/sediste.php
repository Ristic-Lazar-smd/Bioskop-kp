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
        $q = "SELECT * FROM sediste";
        return $conn->query($q);
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

    public static function getById($sedisteID, mysqli $conn)
    {
        $q = "SELECT * FROM sediste WHERE sedisteID=$sedisteID";
        $myArray = array();
        if ($result = $conn->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }
}
