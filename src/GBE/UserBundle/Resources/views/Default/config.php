<?php
//On demarre les sessions
session_start();

/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que l'
espace membre puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
mysql_connect('localhost', 'root', 'root');
mysql_select_db('TDFNS') or die('Impossible de se connecter : ' . mysql_error());

//Email du webmaster
$mail_webmaster = 'p.a.destremau@gmail.com';

//Adresse du dossier de la top site
$url_root = 'localhost:8888/MyECN';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';

//Nom du design
$design = 'default';
?>