<?php
/*

Page deconnexion.php

Permet de se d�connecter du site.

Quelques indications : (Utiliser l'outil de recherche et rechercher les mentions donn�es)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
D�connexion
--------------------------
*/

session_start();
include('../functions/config.php');
include('../functions/fonctions.php');
connexionbdd();
mysql_query("DELETE FROM connectes WHERE connectes_id = ".$_SESSION['membre_id']) or exit(mysql_error());
vider_cookie();
session_destroy();

$informations = Array(/*D�connexion*/
				false,
				'D�connexion',
				'Vous �tes � pr�sent d�connect�.',
				' - <a href="'.ROOTPATH.'/membres/connexion.php">Se connecter</a>',
				ROOTPATH.'/index2.php',
				5
				);

require_once('../information.php');
exit();
?>