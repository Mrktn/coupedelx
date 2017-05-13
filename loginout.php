<?php

require_once('classes/ecole.php');

// opérations sur la base
function logIn()
{
    // Test si le nom de compte et mot de passe sont corrects
    $test = ecole::testerMdp($_POST['login'], sha1($_POST['mdp']));

    if($test)
    {
        $ecole = ecole::getEcole($_POST['login']);
        $_SESSION['loggedIn'] = true; // la variable va persister au fur et à mesure de la navigation
        $_SESSION['isAdmin'] = $ecole->admin;
        $_SESSION['login'] = $ecole->login;
        $_SESSION['nom'] = $ecole->nom;
        redirectWithPost("index.php?page=espacebds", array('tip' => 'success', 'msg' => "Vous êtes maintenant connecté !"), true);
    }
    else
    {
        unset($_SESSION['loggedIn']);
        redirectWithPost("index.php?page=espacebds", array('tip' => 'error', 'msg' => "Votre login ou votre mot de passe est invalide !"), true);
    }
}

function logOut()
{
    unset($_SESSION['loggedIn']);
    unset($_SESSION['isAdmin']);
    unset($_SESSION['login']);
    unset($_SESSION['nom']);
}
