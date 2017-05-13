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

    public static function getSportByID($sportID)
    {
        $dbh = DB::connect();
        $stmt = $dbh->prepare("SELECT * FROM sport AS s WHERE s.sportID=?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'sport');
        $stmt->bindParam(1, $sportID);

        if($stmt->execute())
        {
            while(($row = $stmt->fetch()))
            {
                $stmt->closeCursor();
                return $row;
            }
        }
    }

}
