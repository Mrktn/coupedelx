<?php

// Quel est le titre à afficher dans la barre de navigation ?
$title = array("index" => "Coupe de l'X 2017", "contact" => "Contact", "infos" => "Informations pratiques", "disciplines" => "Disciplines sportives", "espacebds" => "Espace BDS", "admin" => "Administration");

// Quel est le nom de chaque page dans la navbar ?
$titleNavbar = array("index" => "Accueil", "disciplines" => "Disciplines", "infos" => "Informations pratiques", "espacebds" => "Espace BDS", "contact" => "Contact", "admin" => "Administrer", "myShotguns" => "Administrer");


$navbar = array("index", "disciplines", "infos", "espacebds", "contact", "admin");

// Quelles sont les pages qui requièrent d'être admin pour les voir ?
$adminPages = array("administration");

// Quelles sont les pages que je suis autorisé à voir en étant logged out ?
$authorizedLoggedOut = array("index", "register", "error", "info");

// Quelles sont les pages que je suis autorisé à voir en étant logged in (admin ou user, peu importe) ?
$authorizedLoggedIn = array("index", "error", "placeholerloggedin", "info", "displayShotguns", "manageShotguns", "shotgunRecord", "myShotguns", "shotgunIt", "createShotgun","myShotgunsReserves","changePassword");

// $accessibleSimpleUser['une page d'admin'] = false
$accessibleSimpleUser = array("index" => true, "register" => true, "error" => true, "info" => true, "manageShotguns" => false, "shotgunRecord" => true, "myShotguns" => true, "shotgunIt" => true, "createShotgun" => true,"myShotgunsReserves" => true, "changePassword" => true);

$sportsID = array("avironF", "avironM", "badminton", "basketF", "basketM", "escalade", "escrime", "footF", "footM", "handF", "handM", "judo", "natation", "pompoms", "relais", "rugbyF", "rugbyM", "ultimate", "volleyF", "volleyM");
