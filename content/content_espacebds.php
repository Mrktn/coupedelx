<div class="jumbotron jumbo-header">
    <h1 class="jumbo-title">Espace BDS</h1>
</div>

<div class="container-fluid">Cet espace vous permet, une fois connecté, de gérer l'inscription de vos équipes dans les différents sports.
    <hr class="featurette-divider" style="margin-bottom:10px;margin-top:20px">
</div>

<?php
require_once('classes/sport.php');
require_once('classes/joueur.php');
/* echo '<pre>';
  print_r($_POST);
  echo '</pre>'; */
echo '<div class="container-fluid">';

// Si je suis logué
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
{
    echo '<h1>Inscriptions (' . $_SESSION['nom'] . ')</h1>';

    // Je suis logué, mais je suis l'admin
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
    {
        echo '<p>Vous n\'êtes pas concerné !</p>';
    }

    // Je suis logué et prêt à procéder aux inscriptions
    else
    {
        echo "Pour chacun des sports suivants, vous pouvez inscrire une équipe. Le premier membre d'une équipe est le <b>capitaine</b> : pensez à renseigner son numéro de téléphone afin que l'équipe soit joignable durant la compétition !<br/><br/>";
        echo '<form data-toggle="validator" method="post" action="index.php?page=espacebds&todo=updateInscription" class="form-horizontal">';

        $sports = sport::getSports();


        foreach($sports as $s)
        {
            echo '<div class="panel-group" style="padding-left:40px;padding-right:40px;padding-bottom:30px">
              <div class="panel panel-default">
              <div class="panel-heading">
              <h2 class="panel-title">
              <a data-toggle="collapse" href="#collapse' . $s->sportID . '">' . $s->nom . '</a>
              </h2>
              </div><div id="collapse' . $s->sportID . '" class="panel-collapse collapse">
              <div class="panel-body">';
            //echo '<h2>' . $s->nom . '</h2>';
            echo "<p>Vous pouvez inscrire <b>au maximum " . $s->maxjoueurs . " joueurs</b>.<br/>";

            $joueurs = joueur::getJoueursInscrits($_SESSION['login'], $s->nom);
            $i = 0;

            foreach($joueurs as $j)
            {
                $i += 1;

                echo "<h3>Joueur $i" . ($i == 1 ? " (capitaine)" : "") . "</h3>";

                echo '<div class="form-group">
                        <label class="col-md-4 control-label">Prénom</label>  
                        <div class="col-md-4 inputGroupContainer">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="j' . $i . '-' . $s->sportID . '-prenom" name="j' . $i . '-' . $s->sportID . '-prenom" placeholder="Prénom" class="form-control" value="' . htmlspecialchars($j->prenom) . '" type="text">
                          </div>
                        </div>
                      </div>';

                echo '<div class="form-group">
                        <label class="col-md-4 control-label">Nom</label>  
                        <div class="col-md-4 inputGroupContainer">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="j' . $i . '-' . $s->sportID . '-nom" name="j' . $i . '-' . $s->sportID . '-nom" placeholder="Nom" class="form-control" value="' . htmlspecialchars($j->nom) . '" type="text">
                          </div>
                        </div>
                      </div>';

                echo '<div class="form-group">
                        <label class="col-md-4 control-label">Adresse mail</label>  
                        <div class="col-md-4 inputGroupContainer">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="j' . $i . '-' . $s->sportID . '-mail" name="j' . $i . '-' . $s->sportID . '-mail" placeholder="Adresse mail" class="form-control" value="' . htmlspecialchars($j->mail) . '" type="text">
                          </div>
                        </div>
                      </div>';
            }

            while($i < $s->maxjoueurs)
            {
                $i += 1;

                echo "<h3>Joueur $i" . ($i == 1 ? " (capitaine)" : "") ."</h3>";

                echo '<div class="form-group">
                        <label class="col-md-4 control-label">Prénom</label>  
                        <div class="col-md-4 inputGroupContainer">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="j' . $i . '-' . $s->sportID . '-prenom" name="j' . $i . '-' . $s->sportID . '-prenom" placeholder="Prénom" class="form-control" type="text">
                          </div>
                        </div>
                      </div>';

                echo '<div class="form-group">
                        <label class="col-md-4 control-label">Nom</label>  
                        <div class="col-md-4 inputGroupContainer">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="j' . $i . '-' . $s->sportID . '-nom" name="j' . $i . '-' . $s->sportID . '-nom" placeholder="Nom" class="form-control" type="text">
                          </div>
                        </div>
                      </div>';

                echo '<div class="form-group">
                        <label class="col-md-4 control-label">Adresse mail</label>  
                        <div class="col-md-4 inputGroupContainer">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="j' . $i . '-' . $s->sportID . '-mail" name="j' . $i . '-' . $s->sportID . '-mail" placeholder="Adresse mail" class="form-control"  type="text">
                          </div>
                        </div>
                      </div>';
            }

            echo '</div></div>
              </div>
              </div>';
        }

        echo '<br/><button type="submit" style="background-color: rgb(20,20,40); color: white;border: none;cursor: pointer; width: 100%;padding: 14px 20px;margin: 8px 0">Valider</button>';
        echo "</form>";
    }
    ?>
    <form action="index.php?page=espacebds&todo=logout" method="post">
        <button style="margin-right:10px" name="logout" type="submit" class="btn btn-default">Déconnexion</button>
    </form><?php
}

// Sinon si je ne suis pas logué
else
{
    echo "<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: rgb(20,20,40); color: white;border: none;cursor: pointer; width: 100%;
    padding: 14px 20px;
    margin: 8px 0;
    
}

button:hover {
    opacity: 0.8;
}

.containerX {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}
</style>";
    echo '<h1 style="color: rgb(20,20,40)">Connectez-vous !</h1>';
    echo '<form action="index.php?page=index&todo=login" method="post">
  <div class="container containerX">
    <label><b>Identifiant</b></label>
    <input type="text" placeholder="Identifiant" name="login" required><br/>

    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Mot de passe" name="mdp" required><br/>

    <button type="submit">Connexion</button>
  </div>

  <div class="container" >
    <span class="psw"><a href="#">Je n\'ai pas d\'identifiants</a></span>
  </div>
</form>';
}
echo '</div>';
?>