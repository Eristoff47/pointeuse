<?php
/*

Page inscription.php

Permet de s'inscrire.

Quelques indications : (utiliser l'outil de recherche et rechercher les mentions donn�es)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Aucune information/erreur
--------------------------
*/

session_start();
header('Content-type: text/html; charset=utf-8');
include('../functions/config.php');
?>
<?php
/********Actualisation de la session...**********/

include('../functions/fonctions.php');
connexionbdd();
actualiser_session();

/********Fin actualisation de session...**********/
?>
<?php
if(isset($_SESSION['membre_id']))
{
	header('Location: /index2.php');
	exit();
}
?>
<?php
/********Ent�te et titre de page*********/

$titre = 'Inscription 1/2';

include('../functions/haut.php'); //contient le doctype, et head.

/**********Fin ent�te et titre***********/
?>

<!--Colonne gauche-->
		<div id="colonne_gauche">
		<?php
		include('../functions/colg.php');
		?>
		</div>
		<!--Contenu-->
		<div id="contenu">
			<div id="map">
				<a href="../index2.php">Accueil</a> => <a href="../membres/inscription2.php">Inscription 1/2</a>
			</div>
			
			<h1>Formulaire d'inscription</h1>
			<p>Bienvenue sur la page d'inscription de mon site !<br/>
			Merci de remplir ces champs pour continuer.</p>
			<!-- Formulaire mis � jour : -->
			<form action="trait-inscription2.php" method="post" name="Inscription2">
				<fieldset><legend>Identifiants</legend>
					<label for="pseudo" class="float">Pseudo :</label> <input type="text" name="pseudo" id="pseudo" size="30" /> <em>(compris entre 3 et 32 caract�res)</em><br />
					<label for="mdp" class="float">Mot de passe :</label> <input type="password" name="mdp" id="mdp" size="30" /> <em>(compris entre 4 et 50 caract�res)</em><br />
					<label for="mdp_verif" class="float">Mot de passe (v�rification) :</label> <input type="password" name="mdp_verif" id="mdp_verif" size="30" /><br />
					<label for="mail" class="float">Mail :</label> <input type="text" name="mail" id="mail" size="30" /> <br />
					<label for="mail_verif" class="float">Mail (v�rification) :</label> <input type="text" name="mail_verif" id="mail_verif" size="30" /><br />
					<label for="date_naissance" class="float">Date de naissance :</label> <input type="text" name="date_naissance" id="date_naissance" size="30" /> <em>(format JJ/MM/AAAA)</em><br/>
				</fieldset>
				<fieldset><legend>Charte du site et protection anti-robot</legend>
					<?php
					include('../functions/charte.php');
					?>
					
					<h1>Syst�me anti-robot :</h1>
					
					<p>Qu'est-ce que c'est ?<br/>
					Pour lutter contre l'inscription non d�sir�e de robots qui publient du contenu non d�sir� sur les sites web,
					nous avons d�cid� de mettre en place un syst�le de s�curit�.<br/>
					Aucun de ces syst�mes n'est parfait, mais nous esp�rons que celui-ci, sans vous �tre inacessible sera suffisant
					pour lutter contre ces robots.<br/>
					Il est possible que certaines fois, l'image soit trop dure � lire ; le cas �ch�ant, actualisez la page jusqu'� avoir une image lisible.<br/>
					Si vous �tes dans l'incapacit� de lire plusieurs images d'affil�e, <a href="../contact.php">contactez-nous</a>, nous nous occuperons de votre inscription.</p>
					<label for="captcha" class="float">Entrez les 8 caract�res (majuscules ou chiffres) contenus dans l'image :</label> <input type="text" name="captcha" id="captcha"><br/>
					<img src="captcha.php" />
				</fieldset>
				<div class="center"><input type="submit" value="Inscription2" /></div>
			</form>
		<!--bas-->
		<?php
		include('../functions/bas.php');
		mysql_close();
		?>