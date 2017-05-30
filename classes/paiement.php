<?php

// Un enregistrement = telle école a payé pour tel sport
class paiement
{
    public $id;
    public $sport;
    public $ecole;

    public static function aPayePour($ec, $sp)
    {
        $dbh = DB::connect();

        $stmt = $dbh->prepare("SELECT * FROM paiement AS p WHERE p.sport=? AND p.ecole=?");

        $stmt->bindParam(1, $sp);
        $stmt->bindParam(2, $ec);

        if($stmt->execute() && $sth->fetchColumn() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
