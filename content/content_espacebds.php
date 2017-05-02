<div class="jumbotron jumbo-header">
    <h1 class="jumbo-title">Espace BDS</h1>
</div>

<div class="container-fluid">
    Cet espace vous permet, une fois connecté, de gérer l'inscription de vos équipes dans les différents sports.
    <hr class="featurette-divider" style="margin-bottom:10px;margin-top:20px">
</div>

<?php
echo '<div class="container-fluid">';

// Si je suis logué
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
{
    echo '<h1>Inscriptions</h1>';

    // Je suis logué, mais je suis l'admin
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])
    {
        echo '<p>Vous n\'êtes pas concerné !</p>';
    }

    // Je suis logué et prêt à procéder aux inscriptions
    else
    {
        echo '<p>Pas implémenté !</p>';
    }
    ?>
    <form action="index.php?page=espacebds&todo=logout" method="post">
    <button style="margin-right:10px" name="logout" type="submit" class="btn btn-default"> Déconnexion </button>
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
    background-color: rgb(20,20,40);
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}
</style>";
    echo '<h1 style="color: rgb(20,20,40)">Connectez-vous !</h1>';
    echo '<form action="index.php?page=index&todo=login" method="post">
  <div class="container">
    <label><b>Identifiant</b></label>
    <input type="text" placeholder="Identifiant" name="login" required><br/>

    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Mot de passe" name="mdp" required><br/>

    <button type="submit">Connexion</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <span class="psw"><a href="#">Je n\'ai pas d\'identifiants</a></span>
  </div>
</form>';
}
echo '</div>';
?>