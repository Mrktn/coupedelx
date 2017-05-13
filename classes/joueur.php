<?php

class joueur
{
    public $id;
    public $prenom;
    public $nom;
    public $sexe;
    public $sport;
    public $ecole;
    public $capitaine;
    public $telephone;
    public $mail;

    public static function getJoueursInscrits($loginEcole, $nomSport)
    {
        $dbh = DB::connect();
        $a = array();

        $stmt = $dbh->prepare("SELECT j.* FROM sport AS s,joueur AS j,ecole AS e WHERE e.login=? AND s.nom=? AND j.sport=s.id AND j.ecole=e.id");
        $stmt->bindParam(1, $loginEcole);
        $stmt->bindParam(2, $nomSport);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'joueur');

        if($stmt->execute())
        {
            while(($row = $stmt->fetch()))
                $a[] = $row;
            $stmt->closeCursor();
        }

        return $a;
    }

}

?>