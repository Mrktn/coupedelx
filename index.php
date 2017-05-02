<?php

session_name("thesess");
session_start();

setlocale(LC_ALL, 'fr_FR.utf8', 'fra');
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

if(!isset($_SESSION['initiated']))
{
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}

require("classes/DB.php");
$dbh = DB::connect();

require('globals.php');
require('utils.php');
require('loginout.php');

//traitement des contenus de formulaires
//on regarde s'il y a quelque chose à faire 'todo' , si oui on regarde si c'est un login ou un loggout et on execute le cas échéant
if(isset($_GET['todo']) && ($_GET['todo'] == 'login'))
{
    //tentative de connexion , on a alors accès à ce qui a été entré via POST
    logIn();
}

if(isset($_GET['todo']) && $_GET['todo'] == 'logout')
{
    //tentative de déconnexion
    logOut();
    session_destroy();
}

generateHeader();
generateNavbar();

if(isset($_GET['page']))
{
    if(!array_key_exists($_GET['page'], $title))
    {
        redirectWithPost("index.php?page=index", array('tip' => 'error', 'msg' => 'Page invalide !'), true);
    }
    else
    {
        include("content/content_" . $_GET['page'] . ".php");
    }
}
else
{
    header('Location: index.php?page=index');
}

if(isset($_POST['tip']))
{
    $headerNotif = array("success" => "SUCCÈS", "error" => "ERREUR", "warning" => "ATTENTION");
    $titleNotif = array_key_exists($_POST['tip'], $headerNotif) ? $headerNotif[$_POST['tip']] : "ERREUR";
    $typeNotif = array("success" => "success", "error" => "danger", "warning" => "warning");

    $msgNotif = "";

    if(!isset($_POST['msg']))
        $msgNotif = "Message";
    else
        $msgNotif = $_POST['msg'];

    echo '<script type="text/javascript">$.notify({
	title: "<strong>' . $titleNotif . '</strong>",
	message: "<br/>' . $msgNotif . '"
},{
	type: "' . (array_key_exists($_POST['tip'], $typeNotif) ? ($typeNotif[$_POST['tip']]) : 'danger') . '"
});</script>';
}


generateFooter();
?>