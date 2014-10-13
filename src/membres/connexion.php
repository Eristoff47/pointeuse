<?php
/*

Page connexion.php

Permet de se connecter au site.

Quelques indications : (Utiliser l'outil de recherche et rechercher les mentions donn�es)

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations/erreurs :
--------------------------
Membre qui essaie de se connecter alors qu'il l'est d�j�
Vous �tes bien connect�
Erreur de mot de passe
Erreur de pseudo doublon (normalement impossible)
Pseudo inconnu
--------------------------
*/

session_start();
header('Content-type: text/html; charset=utf-8');
include('../functions/config.php');

/********Actualisation de la session...**********/

include('../functions/fonctions.php');
connexionbdd();
actualiser_session();

/********Fin actualisation de session...**********/

if(isset($_SESSION['membre_id']))
{
	$informations = Array(/*Membre qui essaie de se connecter alors qu'il l'est d�j�*/
					true,
					'Vous �tes d�j� connect�',
					'Vous �tes d�j� connect� avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['membre_pseudo'], ENT_QUOTES).'</span>.',
					' - <a href="'.ROOTPATH.'/membres/deconnexion.php">Se d�connecter</a>',
					ROOTPATH.'/index2.php',
					5
					);
	
	require_once('../information.php');
	exit();
}

if($_POST['validate'] != 'ok')
{
/********Ent�te et titre de page*********/

$titre = 'Connexion';

include('../functions/haut.php'); //contient le doctype, et head.

/**********Fin ent�te et titre***********/
?>		
		<div id="colonne_gauche">
		<?php
		include('../functions/colg.php');
		?>
		</div>
		
		<div id="contenu">
			<div id="map">
				<a href="../index2.php">Accueil</a> => <a href="connexion2.php">Connexion</a>
			</div>
					
			<h1>Formulaire de connexion</h1>
			<p>Pour vous connecter, indiquez votre pseudo et votre mot de passe.<br/>
			Vous pouvez aussi cocher l'option "Me connecter automatiquement � mon
			prochain passage." pour laisser une trace sur votre ordinateur pour �tre
			connect� automatiquement.<br/>
			Ce syst�me de trace est bas� sur les cookies, ce sont des petits fichiers
			contenant votre num�ro d'identification ainsi qu'une version crypt�e de votre
			mot de passe. Ces fichiers ne peuvent en aucun cas endommager votre ordinateur,
			ni l'affecter d'aucune fa�ons, vous pourrez les supprimer � tout moment dans
			les options de votre navigateur.</p>
			
			<form name="connexion" id="connexion" method="post" action="connexion.php">
				<fieldset><legend>Connexion</legend>
					<label for="pseudo" class="float">Pseudo :</label> <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_SESSION['connexion_pseudo'])) echo $_SESSION['connexion_pseudo']; ?>"/><br/>
					<label for="mdp" class="float">Passe :</label> <input type="password" name="mdp" id="mdp"/><br/>
					<input type="hidden" name="validate" id="validate" value="ok"/>
					<input type="checkbox" name="cookie" id="cookie"/> <label for="cookie">Me connecter automatiquement � mon prochain passage.</label><br/>
					<div class="center"><input type="submit" value="Connexion" /></div>
				</fieldset>
			</form>
			
			<h1>Options</h1>
			<p><a href="inscription.php">Je ne suis pas inscrit !</a><br/>
			<a href="moncompte.php?action=reset">J'ai oubli� mon mot de passe !</a>
			</p>
			<?php
}
			
			else
			{
				$result = sqlquery("SELECT COUNT(membre_id) AS nbr, membre_id, membre_pseudo, membre_mdp FROM membres WHERE
				membre_pseudo = '".mysql_real_escape_string($_POST['pseudo'])."' GROUP BY membre_id", 1);
				
				if($result['nbr'] == 1)
				{
					if(md5($_POST['mdp']) == $result['membre_mdp'])
					{
						$_SESSION['membre_id'] = $result['membre_id'];
						$_SESSION['membre_pseudo'] = $result['membre_pseudo'];
						$_SESSION['membre_mdp'] = $result['membre_mdp'];
						unset($_SESSION['connexion_pseudo']);
						
						if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
						{
							setcookie('membre_id', $result['membre_id'], time()+365*24*3600);
							setcookie('membre_mdp', $result['membre_mdp'], time()+365*24*3600);
						}
						
						$informations = Array(/*Vous �tes bien connect�*/
										false,
										'Connexion r�ussie',
										'Vous �tes d�sormais connect� avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['membre_pseudo'], ENT_QUOTES).'</span>.',
										'',
										ROOTPATH.'/index2.php',
										3
										);
						require_once('../information.php');
						exit();
					}
					
					else
					{
						$_SESSION['connexion_pseudo'] = $_POST['pseudo'];
						$informations = Array(/*Erreur de mot de passe*/
										true,
										'Mauvais mot de passe',
										'Vous avez fourni un mot de passe incorrect.',
										' - <a href="'.ROOTPATH.'/index2.php">Index</a>',
										ROOTPATH.'/membres/connexion.php',
										3
										);
						require_once('../information.php');
						exit();
					}
				}
				
				else if($result['nbr'] > 1)
				{
					$informations = Array(/*Erreur de pseudo doublon (normalement impossible)*/
									true,
									'Doublon',
									'Deux membres ou plus ont le m�me pseudo, contactez un administrateur pour r�gler le probl�me.',
									' - <a href="'.ROOTPATH.'/index2.php">Index</a>',
									ROOTPATH.'/contact.php',
									3
									);
					require_once('../information.php');
					exit();
				}
				
				else
				{
					$informations = Array(/*Pseudo inconnu*/
									true,
									'Pseudo inconnu',
									'Le pseudo <span class="pseudo">'.htmlspecialchars($_POST['pseudo'], ENT_QUOTES).'</span> n\'existe pas dans notre base de donn�es. Vous avez probablement fait une erreur.',
									' - <a href="'.ROOTPATH.'/index.php">Index</a>',
									ROOTPATH.'/membres/connexion.php',
									5
									);
					require_once('../information.php');
					exit();
				}
			}
			?>			
		</div>

		<?php
		include('../functions/bas.php');
		mysql_close();
		?>