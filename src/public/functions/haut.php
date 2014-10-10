<?php
/*

Page haut.php

Page incluse cr�ant le doctype etc etc.

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
?>
<!DOCTYPE html>
<html>
	<head>
	<?php
	/**********V�rification du titre...*************/
	
	if(isset($titre) && trim($titre) != '')
	$titre = $titre.' : '.TITRESITE;
	
	else
	$titre = TITRESITE;
	
	/***********Fin v�rification titre...************/
	?>
		<title><?php echo $titre; ?></title>
		<meta  charset="UTF-8" />
		<meta name="language" content="fr" />
		<link rel="stylesheet" title="Design" href="/design.css" type="text/css" media="screen" />
	</head>


	<body>
		<div id="banniere">
			<a href="/index2.php"><img src="/images/banniere.png"/></a>
		</div>
		
		<div id="menu">
			<div id="menu_gauche">
			<!-- Vide, mettez-y les liens qui ne d�pendent pas du statut
			du membre (connect� ou non) -->
			</div>
			
			<div id="menu_droite">
			<?php
			if(isset($_SESSION['membre_id']))
			{
			?>
				<a href="../membres/moncompte.php">G�rer mon compte</a>   <a href="../membres/deconnexion.php">Se d�connecter</a>
			<?php
			}
			
			else
			{
			?>
				<a href="../membres/inscription2.php">Inscription</a>   <a href="../membres/connexion.php">Connexion</a>
			<?php
			}
			?>
			</div>
		</div>