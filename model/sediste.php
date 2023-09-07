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

   
    if ($result === false) {
        return false; 
    }

    return $result; 
    }

    public static function update($sedisteID, $brojSedista, mysqli $conn)
    {
        $q = "UPDATE sediste set brojSedista='$brojSedista' where sedisteID=$sedisteID";
        return $conn->query($q);
    }
    

    
}
