<?php

class sport
{
    public $id;
    public $nom;
    public $maxjoueurs;
    public $sportID;

    public static function getSports()
    {
        $dbh = DB::connect();
        $a = array();

        $stmt = $dbh->prepare("SELECT * FROM sport AS s ORDER BY s.nom");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'sport');

        if($stmt->execute())
        {
            while(($row = $stmt->fetch()))
                $a[] = $row;
            $stmt->closeCursor();
        }
        
        return $a;
    }

}
