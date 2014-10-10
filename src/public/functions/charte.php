<?php

/*

Page charte.php

Contient la charte et g�n�re le QCM qui va avec.

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
					<div id="charte">
						<h1>La charte de mon site :</h1>
						<p>Ce site contient un espace membres, un forum, un syst�me de news ainsi que d'autres modules.<br/>
						En vous inscrivant, vous reconnaissez avoir pris connaissance de cette charte et l'avoir accept�e.
						Si tel n'est pas le cas, vous ne pouvez vous inscrire.</p><br/>
						
						<div class="chartecat">R�glement G�n�ral du site</div><br/>
						<p>Ce site et toutes ses pages sont soummis � la loi fran�aise, par cons�quent, il est interdit
						d'y tenir des propos ou d'y publier du contenu ill�gal aux yeux de la loi, sont consid�r�s ill�gaux entres
						autres les contenus suivants : contenu � caract�re raciste, contenu diffamatoire, contenu incitant � la haine,
						� la violence, contenu expliquant comment pirater (i.e. : � des fins n�fastes ou non), contenu violant les droits
						d'auteur.<br/>
						� cette liste non exhaustive vient s'ajouter l'interdiction de publier du contenu � caract�re sexuel.<br/>
						Cette liste �tant non exhaustive, nous faisons appel � votre bon sens pour discerner ce que vous pouvez publier
						et / ou dire de ce que vous ne pouvez publier / dire.<br/>
						Les propos insultants, d�gradants, agressifs ou tout comportement n�faste � une ambiance correcte sur l'ensemble
						du site sont interdits.<br/>
						Le th�me de ce site n'est pas restreint, bien que les technologies de l'information soient le th�me principal, libre
						� vous de parler de couture si �a vous chante, mais n'esp�rez pas trouver autant d'adeptes de la couture que de la
						programmation ici.<br/>
						Les forums sont un espace de discussion important pour un site � caract�re communautaire, surtout s'il est centr�
						sur l'informatique, mais c'est aussi un espace d'entraide, par cons�quent, n'h�sitez pas � y poser vos questions si
						vous en avez, cependant, pensez � faire une recherche avant de poster une question, peut-�tre que la question a d�j� �t� pos�e par
						un autre membre, et de plus, votre sujet devra avoir un titre clair et concis.<br/>
						Partout sur le site, vous devrez �crire dans un fran�ais correct, toute forme de langage SMS (abr�g�) est interdite.<br/>
						Il est important de noter que pour votre confort, et le n�tre, le forum est surveill� par une �quipe de mod�ration
						b�n�vole, qui peut �tre ammen�e � sanctionner tout membre enfreignant le r�glement, ceci allant de l'avertissement
						� l'interdiction d'acc�der au site.<br/>
						La messagerie priv�e est, comme son nom l'indique, priv�e. Cependant, vous acceptez l'id�e que vous, ou votre / vos
						interlocuteur(s) puisse(nt), � tout moment, demander � l'�quipe de mod�ration du site de lire votre �change avec
						lui / eux en cas de probl�me.<br/>
						Vous reconnaissez que ce site est la propri�t� de son cr�ateur, qui est, par cons�quent libre de faire ce
						qu'il veut de celui-ci, tout en respectant le caract�re priv� des informations que vous, ou tout autre membre, lui donnez en vous
						inscrivant et en utilisant le site.<br/>
						Vous �tes donc propri�taire de votre compte et responsable de celui-ci (ainsi que des propos tenus avec), vous pouvez
						� tout moment demander sa suppression. Veuillez noter qu'� aucun moment, l'�quipe du site ne vous demandera votre mot
						de passe.<br/>
						
						Fin (ben ouais, vous y mettez ce que vous voulez dans votre charte, mais � 2h du mat, moi �a me barbe de continuer ;
						en plus, c'est pas terrible. ^^ )
						</p>
					</div>
					<div id="qcm">
						<h1>Questionnaire sur la charte :</h1>
						<p>Pous nous assurer que vous avez lu le r�glement, ou du moins que vous avez du bon sens,
						voici un questionnaire � remplir. (Le remplir signifie accepter la charte.)
						</p>
<?php
/*QCM CHARTE*/
$questions = Array();
$questions[] = Array('A qui appartient ce site ?', 'Son cr�ateur', 'Vous', 'L\'h�bergeur web du site', '� personne', 'Je ne sais pas', 1);
$questions[] = Array('Que faut-il faire avant de poser une question sur les forums ?', 'Rien', 'Demander � son voisin s\'il a la r�ponse', 'Une recherche sur le site', 'Consulter Google', 'Je ne sais pas', 3);
$questions[] = Array('Vous pouvez supprimer votre compte...', 'quand vous voulez', 'quand vous voulez en le demandant � un administrateur', 'seulement le mardi', 'seulement si vous ne respectez pas le r�glement', 'Je ne sais pas', 2);
$questions[] = Array('Quel titre de sujet convient ?', 'PC en carton plante tout le temps', 'Grrrrrrrrr!!!! Quelqu\'un a un marteau ?', 'A l\'aiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiide !!', '[Windows] Plantage syst�me au d�marrage', 'Je ne sais pas', 4);
$questions[] = Array('Qui surveille les forums ?', 'L\'�quipe de mod�ration', 'Les administrateurs', 'L\'h�bergeur web du site', 'Il se surveille tout seul', 'Je ne sais pas', 1);
$questions[] = Array('Quel sujet n\'est pas l�gal ?', '[SONDAGE] Vous lavez-vous souvent les cheveux ?', '[HOTMAIL] Contourner le filtre anti-spam', 'La nouvelle loi Hadopi, la fin du P2P en France ?', 'Topic flood !', 'Je ne sais pas', 2);
$questions[] = Array('Si quelqu\'un vous demande votre mot de passe...', 'il n\'est pas membre de l\'�quipe du site', 'c\'est qu\'il est curieux', 'vous lui donnez', 'vous lui demandez le sien en �change', 'Je ne sais pas', 1);
$questions[] = Array('Quel langage est interdit sur ce site ?', 'L\'anglais', 'L\'allemand', 'Le braille', 'Le SMS', 'Je ne sais pas', 4);
$questions[] = Array('En vous inscrivant vous reconnaissez', '�tre fan du site', 'aimer le chocolat', 'avoir accept� la charte', '�tre b�te', 'Je ne sais pas', 3);
$Tquestions = count($questions);
?>
<?php
$locate = Array();
$i=1;

while($i<=3)
{
	$k = $questions[mt_rand(0,$Tquestions-1)];
	while(in_array($k, $locate))
	{
		$k = $questions[mt_rand(0,$Tquestions-1)];
	}
	$locate[] = $k;
	$i++;
}
?>
<!--Affichage-->
<?php
$i=1;
while($i<=3)
{
	$_SESSION['reponse'.$i] = $locate[$i-1][6];
?>
						<span class="question"><?php echo $locate[$i-1][0]; ?></span><br/>
						<input type="radio" name="reponse<?php echo $i; ?>" value="1" id="<?php echo $i; ?>1" /> <label for="<?php echo $i; ?>1"><?php echo $locate[$i-1][1]; ?></label><br />
						<input type="radio" name="reponse<?php echo $i; ?>" value="2" id="<?php echo $i; ?>2" /> <label for="<?php echo $i; ?>2"><?php echo $locate[$i-1][2]; ?></label><br />
						<input type="radio" name="reponse<?php echo $i; ?>" value="3" id="<?php echo $i; ?>3" /> <label for="<?php echo $i; ?>3"><?php echo $locate[$i-1][3]; ?></label><br />
						<input type="radio" name="reponse<?php echo $i; ?>" value="4" id="<?php echo $i; ?>4" /> <label for="<?php echo $i; ?>4"><?php echo $locate[$i-1][4]; ?></label><br />
						<input type="radio" name="reponse<?php echo $i; ?>" value="5" id="<?php echo $i; ?>5" /> <label for="<?php echo $i; ?>5"><?php echo $locate[$i-1][5]; ?></label><br />
<?php
	$i++;
}
?>
					</div>