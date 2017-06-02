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
                            $aPaye = false;
                            $estValide = false;

                            if(!paiement::aPayePour($ec->id, $sp->id))
                            {
                                $tags .= "nonPaye ";
                                $myGlyphs .= '<span title="Cette équipe n\'a pas payé !" ecole="' . $ec->id . '" sport="' . $sp->id . '" style="color:red; padding-left: 5px" class="glyphicon glyphicon-euro pull-right payeState"></span>';
                            }
                            else
                            {
                                $aPaye = true;
                                $tags .= "paye ";
                                $myGlyphs .= '<span title="Cette équipe a payé !" ecole="' . $ec->id . '" sport="' . $sp->id . '" style="color:green; padding-left: 5px" class="glyphicon glyphicon-euro pull-right payeState"></span>';
                            }

                            if(!validation::aValideEquipe($ec->id, $sp->id))
                            {
                                $tags .= "nonValide ";
                                $myGlyphs .= '<span title="Il faut que vous validiez cette équipe pour finaliser l\'inscription !" ecole="' . $ec->id . '" sport="' . $sp->id . '" style="color:red; padding-left: 5px" class="glyphicon glyphicon-remove pull-right valideState"></span>';
                            }
                            else
                            {
                                $estValide = true;
                                $tags .= "valide ";
                                $myGlyphs .= '<span title="Cette équipe a été validée !" ecole="' . $ec->id . '" sport="' . $sp->id . '" style="color:green; padding-left: 5px" class="glyphicon glyphicon-ok pull-right valideState"></span>';
                            }

                            echo '<div sport="' . $sp->id . '" ecole="' . $ec->id . '" class="' . $tags . ' panel panel-default">';
                            echo '<div style="padding-top: 10px; padding-bottom: 10px"  class="panel-heading">
                                        <h1 class="panel-title puretitre">
                                            <a data-toggle="collapse" data-target="#collapse' . $login . $sp->sportID . '" href="#collapse' . $login . $sp->sportID . '" class="noscroll"><span class="glyphicon glyphicon-chevron-down"></span>
                                                ' . htmlspecialchars($sp->nom) . ' </a>' . $myGlyphs .
                            '</h1></div>';

                            $sportifs = "";
                            $fst = true;
                            $sarray = joueur::getJoueursInscrits($ec->login, $sp->sportID);
                            foreach($sarray as $ssp)
                            {
                                $sportifs .= '<li>' . ($fst ? '<b>' : '') . htmlspecialchars($ssp->prenom) . ' ' . htmlspecialchars($ssp->nom) . ($fst ? '</b>' : '') . '</li>';
                                $fst = false;
                            }

                            echo '<div id="collapse' . $login . $sp->sportID . '" class="panel-collapse collapse">
                                        <div class="panel-body"><ul>' .
                            $sportifs
                            . '</ul>';

                            if(!$aPaye)
                                echo '<button style="margin-left: 10px" type="button" ecole="' . $ec->id . '" sport="' . $sp->id . '" class="pull-right payeBouton btn btn-success">Confirmer le paiement</button>';
                            else // rends l'argent
                                echo '<button style="margin-left: 10px" type="button" ecole="' . $ec->id . '" sport="' . $sp->id . '" class="pull-right unpayeBouton btn btn-danger">Annuler le paiement</button>';

                            if(!$estValide)
                                echo '<button style="margin-left: 10px" type="button" ecole="' . $ec->id . '" sport="' . $sp->id . '" class="pull-right valideBouton btn btn-success">Valider l\'inscription</button>';
                            else
                                echo '<button style="margin-left: 10px" type="button" ecole="' . $ec->id . '" sport="' . $sp->id . '" class="pull-right unvalideBouton btn btn-danger">Invalider l\'inscription</button>';

                            echo '</div></div></div>';
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