
<?php
require_once('classes/sport.php');
require_once('classes/joueur.php');

function generateHeader()
{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <meta name="description" content="Site de la Coupe de l'X, tournoi sportif de l'École polytechnique">
            <meta name="author" content="BDS Polytechnique">
            <link rel="icon" href="../../favicon.ico">

            <title>Coupe de l'X 2017</title>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <script src="js/bootstrap-notify.min.js"></script>
            <!-- Bootstrap core CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

            <link href="https://fonts.googleapis.com/css?family=Vollkorn" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="css/carousel.css" rel="stylesheet">
            <link href="css/perso.css" rel="stylesheet">
            <link href="css/animate.css" rel="stylesheet">

            <!--jquery UI -->
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        </head>
        <?php
    }

    function generateFooter()
    {
        ?>
        <hr class="featurette-divider">

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-md-4">
                        <div class="center-block" style="padding-top:30px">
                            <div class="center-block" style="text-align:center">
                                <p style="margin:auto; font-style:italic; font-size:14px">&copy; BDS Polytechnique, tous droits réservés</p>
                            </div>
                            <div>
                                <a href='https://www.facebook.com/Bds-Polytechnique-640858446045589'><img src="img/logobds.png" alt="Logo BDS Polytechnique" style="max-width:256px; max-height:144px;width: auto;height: auto;" class="img-responsive center-block"/></a>
                                <div class="center-block" style="text-align:center">
                                    <p style="margin:auto; font-style:italic; font-size:11px">« Nous ne sommes pas qu'une équipe, nous sommes toute une armée »</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4">
                        <div class="center-block">
                            <div>
                                <a href='https://www.facebook.com/Bds-Polytechnique-640858446045589'><img src="img/lcl.png" style="max-width:366px; max-height:144px;width: auto;height: auto;" class="img-responsive center-block"/></a>
                                <div class="center-block" style="text-align:center">
                                    <p style="margin:auto; font-style:italic; font-size:15px">En collaboration avec le Crédit lyonnais</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </footer>

    <!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </body>
    </html>
    <?php
}

// Si on set preheader, c'est que la fonction est appelée avant un include de content
// Du coup, comme on est encore en train de parser la variable $_GET pour savoir si l'userinput est valide
// on n'a encore rien envoyé. On ajoute donc les balises nécessaires pour que le navigateur ait de quoi travailler
function redirectWithPost($url, $arrpost, $preheader = false)
{
    if($preheader)
    {
        echo '<!DOCTYPE html>
                <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <script type="text/javascript" src="js/jquery.js"></script>
                        <script type="text/javascript" src="js/redirect.js"></script>
                    </head>
                    <body>';
    }

    echo '<script>$.redirect("' . $url . '",{placeholder:"a"';
    foreach($arrpost as $key => $val)
    {
        echo ',' . $key . ':"' . $val . '"';
    }
    echo '});</script>';
    if($preheader)
    {
        echo '</body></html>';
    }
    exit();
}

function generateNavbar()
{
    ?>
    <body>
        <div class="navbar-wrapper container-fullwidth" style="width:100%">
            <div class="container container-fullwidth" style="width:100%">
                <nav class="container-fullwidth">
                    <ul>
                        <?php
                        require('globals.php');
                        foreach($navbar as $p)
                        {
                            echo "<li><a href=\"index.php?page=" . $p . "\">" . $titleNavbar[$p] . "</a>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php
    }

    function piecesSanityCheck($pieces)
    {
        return true;
    }

    // Vérifie que la chaîne est vide
    function stringIsBlank($str)
    {
        return isset($str) && preg_match("/^[\s]*$/", $str);
    }

    function safeAccess($arr, $key)
    {
        if(!isset($arr[$key]) || stringIsBlank($arr[$key]))
            return "";
        else
            return $arr[$key];
    }

    function doInscription($bysports)
    {
        $currEcole = ecole::getEcole($_SESSION['login']);

        foreach($bysports as $sport => $arr)
        {
            $currentSport = sport::getSportByID($sport);
            ksort($arr);

            /* On efface les anciens joueurs */
            joueur::delJoueurs($currentSport->id, $currEcole->id);

            $cnt = 1;

            foreach($arr as $jk => $arra)
            {
                if($cnt <= $currentSport->maxjoueurs)
                {
                    joueur::insertJoueur($currEcole->id, $currentSport->id, safeAccess($arra, 'prenom'), safeAccess($arra, 'nom'), $cnt, $cnt == 1, safeAccess($arra, 'mail'));
                    $cnt += 1;
                }
            }
        }
    }
    ?>

