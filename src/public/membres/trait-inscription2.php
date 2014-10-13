<?php

/*

        Page trait-inscription.php
        
        Permet de valider son inscription.
        
        Quelques indications : (utiliser l'outil de recherche et rechercher les mentions donn�es)
        
        Liste des fonctions :
        --------------------------
        Aucune fonction
        --------------------------
        
        
        Liste des informations/erreurs :
        --------------------------
        D�j� inscrit (en cas de bug...)
        --------------------------
        */
       ?>
       <?php 
        //session_start();
        header('Content-type: text/html; charset=utf-8');
        include('../../functions/config.php');
        
        /********Actualisation de la session...**********/
        
        include('../functions/fonctions.php');
        connexionbdd();
        actualiser_session();
        
        /********Fin actualisation de session...**********/
        
        if(isset($_SESSION['membre_id']))
            {
                header('Location: index2.php');
                exit();
            }
        
        if($_SESSION['inscrit'] == $_POST['pseudo'] && trim($_POST['inscrit']) != '')
            {
                $informations = Array(/*D�j� inscrit (en cas de bug...)*/
                                    true,
                                    'Vous �tes d�j� inscrit',
                                    'Vous avez d�j� compl�t� une inscription avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['inscrit'], ENT_QUOTES).'</span>.',
                                    ' - <a href="'.ROOTPATH.'/index2.php">Retourner � l\'index</a>',
                                    ROOTPATH.'../membres/connexion.php',);
                require_once('../information.php');
                exit();
            }
        
        function checkpseudo($pseudo)
            {
            	if($pseudo == '') return 'empty';
            	else if(strlen($pseudo) < 3) return 'tooshort';
            	else if(strlen($pseudo) > 32) return 'toolong';
            	
            	else
            	{
            		$result = sqlquery("SELECT COUNT(*) AS nbr FROM membres WHERE membre_pseudo = '".mysql_real_escape_string($pseudo)."'", 1);
            		global $queries;
            		$queries++;
            		
            		if($result['nbr'] > 0) return 'exists';
            		else return 'ok';
            	}
            }
        
        function checkmdp($mdp)
            {
            	if($mdp == '') return 'empty';
            	else if(strlen($mdp) < 4) return 'tooshort';
            	else if(strlen($mdp) > 50) return 'toolong';
            	
            	else
            	{
            		if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
            		else if(!preg_match('#[A-Z]{1,}#', $mdp)) return 'noupcap';
            		else return 'ok';
            	}
            }
        
        function checkmdpS($mdp, $mdp2)
            {
            	if($mdp != $mdp2 && $mdp != '' && $mdp2 != '') return 'different';
            	else return checkmdp($mdp);
            }
        
        function checkmail($email)
            {
            	if($email == '') return 'empty';
            	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'isnt';
            	
            	else
            	{
            		$result = sqlquery("SELECT COUNT(*) AS nbr FROM membres WHERE membre_mail = '".mysql_real_escape_string($email)."'", 1);
            		global $queries;
            		$queries++;
            		
            		if($result['nbr'] > 0) return 'exists';
            		else return 'ok';
            	}
            }
        
        function checkmailS($email, $email2)
            {
            	if($email != $email2 && $email != '' && $email2 != '') return 'different';
            	else return 'ok';
            }
        
        function birthdate($date)
            {
            	if($date == '') return 'empty';
            
            	else if(substr_count($date, '/') != 2) return 'format';
            	else
            	{
            		$DATE = explode('/', $date);
            		if(date('Y') - $DATE[2] <= 4) return 'tooyoung';
            		else if(date('Y') - $DATE[2] >= 135) return 'tooold';
            		
            		else if($DATE[2]%4 == 0)
            		{
            			$maxdays = Array('31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
            			if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
            			else return 'ok';
            		}
            		
            		else
            		{
            			$maxdays = Array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
            			if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
            			else return 'ok';
            		}
            	}
            }
        
        function vidersession()
            {
            	foreach($_SESSION as $cle => $element)
            	{
            		unset($_SESSION[$cle]);
            	}
            }
         
        
        
        $_SESSION['erreurs'] = 0;
        ?>
        <?php 
        //Pseudo
        if(isset($_POST['pseudo']))
            {
                $pseudo = trim($_POST['pseudo']);
                $pseudo_result = checkpseudo($pseudo);
                if($pseudo_result == 'tooshort')
                {
                    $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caract�res).</span><br/>';
                    $_SESSION['form_pseudo'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($pseudo_result == 'toolong')
                {
                    $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caract�res).</span><br/>';
                    $_SESSION['form_pseudo'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($pseudo_result == 'exists')
                {
                    $_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est d�j� pris, choisissez-en un autre.</span><br/>';
                    $_SESSION['form_pseudo'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($pseudo_result == 'ok')
                {
                    $_SESSION['pseudo_info'] = '';
                    $_SESSION['form_pseudo'] = $pseudo;
                }
            
                else if($pseudo_result == 'empty')
                {
                    $_SESSION['pseudo_info'] = '<span class="erreur">Vous n\'avez pas entr� de pseudo.</span><br/>';
                    $_SESSION['form_pseudo'] = '';
                    $_SESSION['erreurs']++;
                }
            }
        
            else
            {
               // header('Location: ../index2.php');
                exit();
            }
        
        //Mot de passe
        if(isset($_POST['mdp']))
            {
                $mdp = trim($_POST['mdp']);
                $mdp_result = checkmdp($mdp, '');
                if($mdp_result == 'tooshort')
                {
                    $_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entr� est trop court, changez-en pour un plus long (minimum 4 caract�res).</span><br/>';
                    $_SESSION['form_mdp'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($mdp_result == 'toolong')
                {
                    $_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entr� est trop long, changez-en pour un plus court. (maximum 50 caract�res)</span><br/>';
                    $_SESSION['form_mdp'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($mdp_result == 'nofigure')
                {
                    $_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins un chiffre.</span><br/>';
                    $_SESSION['form_mdp'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($mdp_result == 'noupcap')
                {
                    $_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins une majuscule.</span><br/>';
                    $_SESSION['form_mdp'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($mdp_result == 'ok')
                {
                    $_SESSION['mdp_info'] = '';
                    $_SESSION['form_mdp'] = $mdp;
                }
            
                else if($mdp_result == 'empty')
                {
                    $_SESSION['mdp_info'] = '<span class="erreur">Vous n\'avez pas entr� de mot de passe.</span><br/>';
                    $_SESSION['form_mdp'] = '';
                    $_SESSION['erreurs']++;
            
                }
            }
            
            else
                {
                    header('Location: ../index2.php');
                    exit();
                }
        
        //Mot de passe suite
        if(isset($_POST['mdp_verif']))
            {
                $mdp_verif = trim($_POST['mdp_verif']);
                $mdp_verif_result = checkmdpS($mdp_verif, $mdp);
                if($mdp_verif_result == 'different')
                {
                    $_SESSION['mdp_verif_info'] = '<span class="erreur">Le mot de passe de v�rification diff�re du mot de passe.</span><br/>';
                    $_SESSION['form_mdp_verif'] = '';
                    $_SESSION['erreurs']++;
                    if(isset($_SESSION['form_mdp'])) unset($_SESSION['form_mdp']);
                }
            
                else
                    {
                    if($mdp_verif_result == 'ok')
                    {
                        $_SESSION['form_mdp_verif'] = $mdp_verif;
                        $_SESSION['mdp_verif_info'] = '';
                    }
        
                    else
                    {
                        $_SESSION['mdp_verif_info'] = str_replace('passe', 'passe de v�rification', $_SESSION['mdp_info']);
                        $_SESSION['form_mdp_verif'] = '';
                        $_SESSION['erreurs']++;
                    }
                }
            }
        
            else
                {
                    header('Location: ../index2.php');
                    exit();
                }
        
        //mail
        if(isset($_POST['mail']))
            {
                $mail = trim($_POST['mail']);
                $mail_result = checkmail($mail);
                if($mail_result == 'isnt')
                {
                    $_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</span><br/>';
                    $_SESSION['form_mail'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($mail_result == 'exists')
                {
                    $_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est d�j� pris, <a href="../contact.php">contactez-nous</a> si vous pensez � une erreur.</span><br/>';
                    $_SESSION['form_mail'] = '';
                    $_SESSION['erreurs']++;
                }
            
                else if($mail_result == 'ok')
                {
                    $_SESSION['mail_info'] = '';
                    $_SESSION['form_mail'] = $mail;
                }
            
                else if($mail_result == 'empty')
                {
                    $_SESSION['mail_info'] = '<span class="erreur">Vous n\'avez pas entr� de mail.</span><br/>';
                    $_SESSION['form_mail'] = '';
                    $_SESSION['erreurs']++;
                }
            }
        
        else
        {
            header('Location: ../index2.php');
            exit();
        }
        
        //mail suite
        if(isset($_POST['mail_verif']))
        {
            $mail_verif = trim($_POST['mail_verif']);
            $mail_verif_result = checkmailS($mail_verif, $mail);
            if($mail_verif_result == 'different')
            {
                $_SESSION['mail_verif_info'] = '<span class="erreur">Le mail de v�rification diff�re du mail.</span><br/>';
                $_SESSION['form_mail_verif'] = '';
                $_SESSION['erreurs']++;
            }
        
            else
            {
                if($mail_result == 'ok')
                {
                    $_SESSION['mail_verif_info'] = '';
                    $_SESSION['form_mail_verif'] = $mail_verif;
                }
        
                else
                {
                    $_SESSION['mail_verif_info'] = str_replace(' mail', ' mail de v�rification', $_SESSION['mail_info']);
                    $_SESSION['form_mail_verif'] = '';
                    $_SESSION['erreurs']++;
                }
            }
        }
        
        else
        {
            header('Location: ../index2.php');
            exit();
        }
        
        //date de naissance
        if(isset($_POST['date_naissance']))
        {
            $date_naissance = trim($_POST['date_naissance']);
            $date_naissance_result = birthdate($date_naissance);
            if($date_naissance_result == 'format')
            {
                $_SESSION['date_naissance_info'] = '<span class="erreur">Date de naissance au mauvais format ou invalide.</span><br/>';
                $_SESSION['form_date_naissance'] = '';
                $_SESSION['erreurs']++;
            }
        
            else if($date_naissance_result == 'tooyoung')
            {
                $_SESSION['date_naissance_info'] = '<span class="erreur">Agagagougougou areuh ? (Vous �tes trop jeune pour vous inscrire ici.)</span><br/>';
                $_SESSION['form_date_naissance'] = '';
                $_SESSION['erreurs']++;
            }
        
            else if($date_naissance_result == 'tooold')
            {
                $_SESSION['date_naissance_info'] = '<span class="erreur">Plus de 135 ans ? Mouais...</span><br/>';
                $_SESSION['form_date_naissance'] = '';
                $_SESSION['erreurs']++;
            }
        
            else if($date_naissance_result == 'invalid')
            {
                $_SESSION['date_naissance_info'] = '<span class="erreur">Le '.htmlspecialchars($date_naissance, ENT_QUOTES).' n\'existe pas.</span><br/>';
                $_SESSION['form_date_naissance'] = '';
                $_SESSION['erreurs']++;
            }
        
            else if($date_naissance_result == 'ok')
            {
                $_SESSION['date_naissance_info'] = '';
                $_SESSION['form_date_naissance'] = $date_naissance;
            }
        
            else if($date_naissance_result == 'empty')
            {
                $_SESSION['date_naissance_info'] = '<span class="erreur">Vous n\'avez pas entr� de date de naissance.</span><br/>';
                $_SESSION['form_date_naissance'] = '';
                $_SESSION['erreurs']++;
            }
        }
        
        else
        {
            header('Location: ../index2.php');
            exit();
        }
        
        //qcm
        if($_SESSION['reponse1'] == $_POST['reponse1'] && $_SESSION['reponse2'] == $_POST['reponse2'] && $_SESSION['reponse3'] == $_POST['reponse3'] && isset($_POST['reponse1']) && isset($_POST['reponse2']) && isset($_POST['reponse3']))
        {
            $_SESSION['qcm_info'] = '';
        }
        
        else
        {
            $_SESSION['qcm_info'] = '<span class="erreur">Au moins une des r�ponses au QCM charte est fausse.</span><br/>';
            $_SESSION['erreurs']++;
        }
        
        
        
        
        unset($_SESSION['reponse1'], $_SESSION['reponse2'], $_SESSION['reponse3']);
        
        
        

?>
<?php
    function inscription_mail($mail, $pseudo, $passe)
    {
    	$to = $mail;
    	$subject = 'Inscription sur '.TITRESITE.' - '.$pseudo;
?>
<?php
	$message = '<html>
					<head>
						<title></title>
					</head>
					
					<body>
						<div>Bienvenue sur '.TITRESITE.' !<br/>
						Vous avez compl�t� une inscription avec le pseudo
						'.htmlspecialchars($pseudo, ENT_QUOTES).' � l\'instant.<br/>
						Votre mot de passe est : '.htmlspecialchars($passe, ENT_QUOTES).'.<br/>
						Veillez � le garder secret et � ne pas l\'oublier.<br/><br/>
						
						En vous remerciant.<br/><br/>
						Moi - Wembaster de '.TITRESITE.'
					</body>
				</html>';
?>
<?php
    //headers principaux.
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    //headers suppl�mentaires
    $headers .= 'From: "Mon super site" <contact@supersite.com>' . "\r\n";
    $headers .= 'Cc: "Duplicata" <duplicata@supersite.com>' . "\r\n";
    $headers .= 'Reply-To: "Membres" <membres@supersite.com>' . "\r\n";
?>
<?php
    $mail = mail($to, $subject, $message, $headers); //marche
    
    if($mail) return true;
    return false;
    }
?>
<!--fin-->
<?php 
/********Ent�te et titre de page*********/
    if($_SESSION['erreurs'] > 0) $titre = 'Erreur : Inscription 2/2';
    else $titre = 'Inscription 2/2';
    
    include('functions/haut.php'); //contient le doctype, et head.
?>
/**********Fin ent�te et titre***********/

		<div id="colonne_gauche">
	<?php 	
		include('functions/colg.php');
	?>
		</div>
		
		<div id="contenu">
			<div id="map">
<!-- Absence de lien � Inscription 2/2 volontaire -->
				<a href="../index2.php">Accueil</a> => Inscription 2/2
			</div>

<!--Test des erreurs et envoi-->
			<?php
    			if($_SESSION['erreurs'] == 0)
    			{
    				$insertion = "INSERT INTO membres VALUES(NULL, '".mysql_real_escape_string($pseudo)."',
    				'".md5($mdp)."', '".mysql_real_escape_string($mail)."',
    				".time().", '".mysql_real_escape_string($date_naissance)."',
    				'', '',
    				'', '',
    				'', '',
    				'', '',
    				".time().", 0)";
    				
    				if(mysql_query($insertion))
    				{
    					$queries++;
    					vidersession();
    					$_SESSION['inscrit'] = $pseudo;
    					/*informe qu'il s'est d�j� inscrit s'il actualise, si son navigateur
    					bugue avant l'affichage de la page et qu'il recharge la page, etc.*/
			?>	
    			<h1>Inscription valid�e !</h1>
    			<p>Nous vous remercions de vous �tre inscrit sur notre site, votre inscription a �t� valid�e !<br/>
    			Vous pouvez vous connecter avec vos identifiants <a href="../membres/connexion.php">ici</a>.
    			</p>
			<?php 	
				}
				
				else
				{
					if(stripos(mysql_error(), $_SESSION['form_pseudo']) !== FALSE) // recherche du pseudo
					{
						unset($_SESSION['form_pseudo']);
						$_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est d�j� pris, choisissez-en un autre.</span><br/>';
						$_SESSION['erreurs']++;
					}
					
					if(stripos(mysql_error(), $_SESSION['form_mail']) !== FALSE) //recherche du mail
					{
						unset($_SESSION['form_mail']);
						unset($_SESSION['form_mail_verif']);
						$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est d�j� pris, <a href="../contact.php">contactez-nous</a> si vous pensez � une erreur.</span><br/>';
						$_SESSION['mail_verif_info'] = str_replace('mail', 'mail de v�rification', $_SESSION['mail_info']);
						$_SESSION['erreurs']++;
						$_SESSION['erreurs']++;
					}
					
					if($_SESSION['erreurs'] == 0)
					{
						$sqlbug = true; //plantage SQL.
						$_SESSION['erreurs']++;
					}
				}
			}

			if($_SESSION['erreurs'] > 0)
			{
				if($_SESSION['erreurs'] == 1) $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu 1 erreur.</span><br/>';
				else $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu '.$_SESSION['erreurs'].' erreurs.</span><br/>';
				?>
			<h1>Inscription non valid�e.</h1>
			<p>Vous avez rempli le formulaire d'inscription du site et nous vous en remercions, cependant, nous n'avons
			pas pu valider votre inscription, en voici les raisons :<br/>
			<?php 
				echo $_SESSION['nb_erreurs'];
				echo $_SESSION['pseudo_info'];
				echo $_SESSION['mdp_info'];
				echo $_SESSION['mdp_verif_info'];
				echo $_SESSION['mail_info'];
				echo $_SESSION['mail_verif_info'];
				echo $_SESSION['date_naissance_info'];
				echo $_SESSION['qcm_info'];
				
				
				if($sqlbug !== true)
				{
				    ?>
			Nous vous proposons donc de revenir � la page pr�c�dente pour corriger les erreurs. (Attention, que vous
			l'ayez correctement remplie ou non, la partie sur la charte et l'image est � refaire int�gralement.)</p>
			<div class="center"><a href="inscription2.php">Retour</a></div>
			<?php 
				}
				
				else
				{
				    ?>
			Une erreur est survenue dans la base de donn�es, votre formulaire semble ne pas contenir d'erreurs, donc
			il est possible que le probl�me vienne de notre c�t�, r�essayez de vous inscrire ou contactez-nous.</p>
			
			<div class="center"><a href="inscription2.php">Retenter une inscription</a> - <a href="../contact.php">Contactez-nous</a></div>
			<?php
				}
			}
			?>
		</div>
		<?php
				if(mysql_query($insertion))
				{
					if(inscription_mail($mail, $pseudo, $mdp)) $sent = 'Un mail de confirmation vous a �t� envoy�.';
					else $sent = 'Un mail de confirmation devait �tre envoy�, mais son envoi a �chou�, vous �tes cependant bien inscrit.';
					vidersession();
					$_SESSION['inscrit'] = $pseudo;
					/*informe qu'il s'est d�j� inscrit s'il actualise, si son navigateur
					bugue avant l'affichage de la page et qu'il recharge la page, etc.*/
				?>
			<h1>Inscription valid�e !</h1>
			<p>Nous vous remercions de vous �tre inscrit sur notre site, votre inscription a �t� valid�e !<br/>
			Vous pouvez vous connecter avec vos identifiants <a href="../membres/connexion.php">ici</a><br/>.
			<?php echo $sent; ?>

	<?php 
		include('functions/bas.php');
		mysql_close();
		?>