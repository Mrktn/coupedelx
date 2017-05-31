<?php

// Un enregistrement = telle école a payé pour tel sport
class validation
{
    public $id;
    public $sport;
    public $ecole;

    // Est-ce que l'école en question a validé son équipe dans le sport donné ?
    public static function aValideEquipe($ec, $sp)
    {
        $dbh = DB::connect();

        $stmt = $dbh->prepare("SELECT * FROM validation AS v WHERE v.sport=? AND v.ecole=?");

        $stmt->bindParam(1, $sp);
        $stmt->bindParam(2, $ec);

        if($stmt->execute() && $stmt->fetchColumn() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}