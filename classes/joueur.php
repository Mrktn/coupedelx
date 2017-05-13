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
    public $numero;

    public static function getJoueursInscrits($loginEcole, $nomSport)
    {
        $dbh = DB::connect();
        $a = array();

        $stmt = $dbh->prepare("SELECT j.* FROM sport AS s,joueur AS j,ecole AS e WHERE e.login=? AND s.nom=? AND j.sport=s.id AND j.ecole=e.id ORDER BY j.numero");
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

    public static function delJoueurs($sportPrimaryKey, $idEcole)
    {
        $dbh = DB::connect();

        $stmt = $dbh->prepare("DELETE FROM joueur WHERE ecole=? AND sport=?");
        $stmt->bindParam(1, $idEcole);
        $stmt->bindParam(2, $sportPrimaryKey);

        $stmt->execute();
        $stmt->closeCursor();
    }

    // FIXME: téléphone, capitaine
    public static function insertJoueur($ecoleID, $sportPrimaryKey, $prenom, $nom, $numero, $isCapitaine, $mail)
    {
        $dbh = DB::connect();

        $stmt = $dbh->prepare("INSERT INTO joueur (prenom, nom, numero, capitaine, mail, ecole, sport) VALUES(?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $prenom);
        $stmt->bindParam(2, $nom);
        $stmt->bindParam(3, $numero);
        $stmt->bindParam(4, $isCapitaine);
        $stmt->bindParam(5, $mail);
        $stmt->bindParam(6, $ecoleID);
        $stmt->bindParam(7, $sportPrimaryKey);

        $stmt->execute();
        $stmt->closeCursor();
    }

}

?>