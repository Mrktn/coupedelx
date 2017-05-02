<?php

require_once('DB.php');

class ecole
{
    public $id;
    public $nom;
    public $login;
    public $mdp;
    public $admin;

    public static function getEcole($login)
    {
        $dbh = DB::connect();

        $stmt = $dbh->prepare("SELECT * FROM ecole WHERE login=?");
        $stmt->bindParam(1, $login);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ecole');

        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $stmt->closeCursor();
                return $row;
            }
        }
        else
            return null;
    }

    public static function testerMdp($login, $mdp)
    {
        $dbh = DB::connect();

        $stmt = $dbh->prepare("SELECT * FROM ecole WHERE login=? AND mdp=?");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $mdp);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ecole');

        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $stmt->closeCursor();
                return true;
            }
        }
        else
            return false;
    }

}
