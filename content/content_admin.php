<?php
// FIXME: check credentials
$ok = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && $_SESSION['isAdmin'] && $_SESSION['login'] == "bdspolytechnique";

if(!$ok)
    redirectWithPost("index.php?page=index", array('tip' => 'error', 'msg' => "Vous n'avez pas la permission d'accéder à cette page !"), true);
?>

<div class="jumbotron jumbo-header">
    <h1 class="jumbo-title">Administration</h1>
</div>








<div class="container-fluid">
    <div class = "panel with-nav-tabs panel-default">
        <div class = "panel-heading">
            <ul class = "nav nav-tabs">
                <?php
                $i = 1;
                foreach($ecolesInvitees as $login)
                {
                    $ec = ecole::getEcole($login);
                    $nom = $ec->nom;

                    echo '<li ' . ($i == 1 ? 'class = "active"' : "") . '><a href = "#tab' . $i . 'default" data-toggle = "tab">' . $nom . '</a></li>';
                    $i += 1;
                }
                ?>
            </ul>
        </div>
        <div class = "panel-body">
            <div class = "tab-content">
                <?php
                $j = 1;
                $sports = sport::getSports();
                foreach($ecolesInvitees as $login)
                {
                    $ec = ecole::getEcole($login);
                    $nom = $ec->nom;

                    echo '<div class="tab-pane fade ' . ($j == 1 ? "in active" : "") . '" id = "tab' . $j . 'default">';
                    echo '<h2>' . $nom . '</h2>';

                    echo '<button style="margin-right: 10px" type="button" class="boutonPanel boutonTout btn btn-primary active">Voir tout</button>';
                    echo '<button style="margin-right: 10px" type="button" class="boutonPanel boutonNonPaye btn btn-primary">Voir seulement non payés</button>';
                    echo '<button type="button" class="boutonPanel boutonNonValide btn btn-primary">Voir seulement non validés</button>';

                    echo '<div style="padding-top: 50px" class="panel-group">';


                    foreach($sports as $sp)
                    {
                        $tags = "";
                        $myGlyphs = "";

                        if(ecole::aInscritDans($ec->id, $sp->id))
                        {
                            if(!paiement::aPayePour($ec->id, $sp->id))
                            {
                                $tags .= "nonPaye ";
                                $myGlyphs .= '<span title="Cette équipe n\'a pas payé !" style="color:red; padding-left: 5px" class="glyphicon glyphicon-euro pull-right"></span>';
                            }
                            else
                            {
                                $tags .= "paye ";
                                $myGlyphs .= '<span title="Cette équipe a payé !" style="color:green; padding-left: 5px" class="glyphicon glyphicon-euro pull-right"></span>';
                            }

                            if(!validation::aValideEquipe($ec->id, $sp->id))
                            {
                                $tags .= "nonValide ";
                                $myGlyphs .= '<span title="Il faut que vous validiez cette équipe pour finaliser l\'inscription !" style="color:red; padding-left: 5px" class="glyphicon glyphicon-remove pull-right"></span>';
                            }
                            else
                            {
                                $tags .= "valide ";
                                $myGlyphs .= '<span title="Cette équipe a été validée !" style="color:green; padding-left: 5px" class="glyphicon glyphicon-ok pull-right"></span>';
                            }

                            echo '<div class="' . $tags . ' panel panel-default" id="panel' . $login . $sp->sportID . '">';
                            echo '<div style="padding-top: 10px; padding-bottom: 10px"  class="panel-heading">
                                        <h1 class="panel-title puretitre">
                                            <a data-toggle="collapse" data-target="#collapse' . $login . $sp->sportID . '" href="#collapse' . $login . $sp->sportID . '" class="noscroll"><span class="glyphicon glyphicon-chevron-down"></span>
                                                ' . $sp->nom . ' </a>' . $myGlyphs .
                            '</h1></div>';

                            $sportifs = "";
                            $fst = true;
                            $sarray = joueur::getJoueursInscrits($ec->login, $sp->sportID);
                            foreach($sarray as $ssp)
                            {
                                $sportifs .= '<li>' . ($fst ? '<b>' : '') . $ssp->prenom . ' ' . $ssp->nom . ($fst ? '</b>' : '') . '</li>';
                                $fst = false;
                            }

                            echo '<div id="collapse' . $login . $sp->sportID . '" class="panel-collapse collapse">
                                        <div class="panel-body"><ul>' .
                            $sportifs
                            . '</ul>' . '<button type="button" ecole="' . $ec->id . '" sport=' . $sp->id . '" class="payeBouton btn btn-success">Confirmer le paiement</button>' .
                            '</div></div></div>';
                        }
                    }
                    echo '</div></div>';
                    $j += 1;
                }
                ?>
            </div>
        </div>
    </div>

    <script>$('.noscroll').click(function ($e) {
            $e.preventDefault();
        });
    </script></div>