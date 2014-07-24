<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Tour de France Non-Stop</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/main_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/parcours_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/cv_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/inscription_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/autre_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/police.css" />												

		<link rel="shortcut icon" href="../img/utilitaire/favicon_tdfns.ico" >
		<link rel="icon" type="image/gif" href="../img/utilitaire/favicon_tdfns.gif" >

		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="styleIE_red.css" id="link_stylesheet_ie"/>
		<![endif]-->

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		
	</head>
<body>
<!-- Importation du menu -->

		<?php include("../ajouts/menu_inscription.php"); ?>


<!-- Importation du haut de page -->

		<?php include("../ajouts/head_inscription.php"); ?>


<?php
//On verifie si lutilisateur est connecte
if(isset($_SESSION['email']))
{
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['prenom'], $_POST['nom'], $_POST['date_naissance'], $_POST['email'], $_POST['adresse1'], $_POST['adresse2'], $_POST['adresse3'], $_POST['adresse4'], $_POST['tel'], $_POST['ecole']) and $_POST['email']!='')
	{
		//On enleve lechappement si get_magic_quotes_gpc est active
		if(get_magic_quotes_gpc())
		{
			$_POST['prenom'] = stripslashes($_POST['prenom']);
			$_POST['nom'] = stripslashes($_POST['nom']);
			$_POST['date_naissance'] = stripslashes($_POST['date_naissance']);
			$_POST['email'] = stripslashes($_POST['email']);
			$_POST['adresse1'] = stripslashes($_POST['adresse1']);
			$_POST['adresse2'] = stripslashes($_POST['adresse2']);
			$_POST['adresse3'] = stripslashes($_POST['adresse3']);
			$_POST['adresse4'] = stripslashes($_POST['adresse4']);
			$_POST['tel'] = stripslashes($_POST['tel']);
			$_POST['ecole'] = stripslashes($_POST['ecole']);
		}
				//On verifie que le telephone est bien de 10 chiffres
				if(strlen($_POST['tel'])>=10 and strlen($_POST['tel'])<=10)
				{
					//On verifie si lemail est valide
					if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
					{
						//On echape les variables pour pouvoir les mettre dans une requette SQL
						$prenom = mysql_real_escape_string($_POST['prenom']);
						$nom = mysql_real_escape_string($_POST['nom']);
						$date_naissance = mysql_real_escape_string($_POST['date_naissance']);
						$email = mysql_real_escape_string($_POST['email']);
						$adresse1 = mysql_real_escape_string($_POST['adresse1']);
						$adresse2 = mysql_real_escape_string($_POST['adresse2']);
						$adresse3 = mysql_real_escape_string($_POST['adresse3']);
						$adresse4 = mysql_real_escape_string($_POST['adresse4']);
						$tel = mysql_real_escape_string($_POST['tel']);
						$ecole = mysql_real_escape_string($_POST['ecole']);
					
						//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
						$dn = mysql_fetch_array(mysql_query('select count(*) as nb from users where email="'.$email.'"'));
						//On verifie si le pseudo a ete modifie pour un autre et que celui-ci n'est pas deja utilise
						if($dn['nb']==0 or $_POST['email']==$_SESSION['email'])
						{
							//On modifie les informations de lutilisateur avec les nouvelles
							if(mysql_query('update users set prenom="'.$prenom.'", nom="'.$nom.'", date_naissance="'.$date_naissance.'", email="'.$email.'", adresse1="'.$adresse1.'", adresse2="'.$adresse2.'", adresse3="'.$adresse3.'", adresse4="'.$adresse4.'", tel="'.$tel.'", ecole="'.$ecole.'" where email="'.mysql_real_escape_string($_SESSION['email']).'"'))
							{
								//Si ca a fonctionne, on naffiche pas le formulaire
								$form = false;
								//On supprime les sessions username et userid au cas ou il aurait modifie son pseudo
								unset($_SESSION['email'], $_SESSION['userid']);
?>
<section class="contenu">
<h2>Op&eacute;ration r&eacute;ussie</h2>
<div>
	<p style="text-align: center;" >Vos informations ont bien &eacute;t&eacute; modifif&eacute;e. Vous devez &agrave; pr&eacute;sent vous reconnecter.</p><br />
	<p style="text-align: center;"><a href="connexion.php">Se connecter</a></p>
</div>
</section>
<?php
							}
							else
							{
								//Sinon on dit quil y a eu une erreur
								$form = true;
								$message = 'Une erreur est survenue lors des modifications.';
								}
								}
						else
						{
							//Sinon, on dit que le pseudo voulu est deja pris
							$form = true;
							$message = 'Un autre utilisateur utilise d&eacute;j&agrave; le nom d\'utilisateur que vous d&eacute;sirez utiliser.';
						}
					}
					else
					{
						//Sinon, on dit que lemail nest pas valide
						$form = true;
						$message = 'L\'email que vous avez entr&eacute; n\'est pas valide.';
					}
				}
				else
				{
					//Sinon, on dit que le tel n est pas valide
					$form = true;
					$message = 'Le numero de telephone que vous avez entr&eacute; n\'est pas valide. Il doit etre de 10 chiffres.';
				}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//Si le formulaire a deja ete envoye on recupere les donnes que lutilisateur avait deja insere
		if(isset($_POST['email']))
		{
			$prenom = htmlentities($_POST['prenom'], ENT_QUOTES, 'UTF-8');
			$nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
			$date_naissance = htmlentities($_POST['date_naissance'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$adresse1 = htmlentities($_POST['adresse1'], ENT_QUOTES, 'UTF-8');
			$adresse2 = htmlentities($_POST['adresse2'], ENT_QUOTES, 'UTF-8');
			$adresse3 = htmlentities($_POST['adresse3'], ENT_QUOTES, 'UTF-8');
			$adresse4 = htmlentities($_POST['adresse4'], ENT_QUOTES, 'UTF-8');
			$tel = htmlentities($_POST['tel'], ENT_QUOTES, 'UTF-8');
			$ecole = htmlentities($_POST['ecole'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			//Sinon, on affiche les donnes a partir de la base de donnee
			$dnn = mysql_fetch_array(mysql_query('select prenom, nom, date_naissance, email, adresse1, adresse2, adresse3, adresse4, tel, ecole, avatar from users where email="'.$_SESSION['email'].'"'));
			$prenom = htmlentities($dnn['prenom'], ENT_QUOTES, 'UTF-8');
			$nom = htmlentities($dnn['nom'], ENT_QUOTES, 'UTF-8');
			$date_naissance = htmlentities($dnn['date_naissance'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
			$adresse1 = htmlentities($dnn['adresse1'], ENT_QUOTES, 'UTF-8');
			$adresse2 = htmlentities($dnn['adresse2'], ENT_QUOTES, 'UTF-8');
			$adresse3 = htmlentities($dnn['adresse3'], ENT_QUOTES, 'UTF-8');
			$adresse4 = htmlentities($dnn['adresse4'], ENT_QUOTES, 'UTF-8');
			$tel = htmlentities($dnn['tel'], ENT_QUOTES, 'UTF-8');
			$ecole = htmlentities($dnn['ecole'], ENT_QUOTES, 'UTF-8');
		}

?>
<section class="contenu"  id="section_modification">
<?php
		//On affiche un message sil y a lieu
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}
?>
	<a href="../index.php?t=Profil" class="bouton_retour">Retour</a>
<h2>Tu veux modifier une information ?</h2>

	<p style="text-indent : 40px; margin-bottom : 20px;">Voici celles que tu avais entr&eacute;es. Tu n'as qu'&agrave; modifier celles qui ne conviennent pas.</p>

<div class="content"  id="formulaire_inscription">
    <form action="edit_infos.php" method="post">
    	<div>
            <label for="prenom">Pr&eacute;nom *</label>	<input type="text" name="prenom" required class="form_align" placeholder="Georges" value="<?php echo $prenom; ?>"/><br />
            <label for="nom">Nom *</label>		<input type="text" name="nom" required  class="form_align" placeholder="d'Artichaut" value="<?php echo $nom; ?>" /><br />
            <label for="modifier_mot_de_passe">Mot de passe</label>		<a href="edit_password.php" style="font-size: 10px;">Modifier le mot de passe</a><br/>
            <label for="date_naissance">Date de Naissance (aaaa-mm-jj)</label>
            									<input type="text" name="date_naissance"  class="form_align" placeholder="1990-06-04" value="<?php echo $date_naissance; ?>"/><br />
            <label for="email">Email *</label>	<input type="email" name="email" required  class="form_align" placeholder="adresse@domaine" value="<?php echo $email; ?>"/><br />
    	</div>
    	<div>
            <label for="adresse">Adresse</label>
            									<input type="number" name="adresse1" size="3" placeholder="54" value="<?php echo $adresse1; ?>" />,
            									<input type="text" name="adresse2" placeholder="rue d'Assas" value="<?php echo $adresse2; ?>" /><br />
            									<input type="number" name="adresse3" size="5" placeholder="75006" value="<?php echo $adresse3; ?>" />
            									<input type="text" name="adresse4" placeholder="Paris" value="<?php echo $adresse4; ?>" /><br />
    	</div>
    	<div>
            <label for="tel">Tel *</label>		<input type="tel" name="tel" required class="form_align" placeholder="0612345678" value="<?php echo $tel; ?>" /><br />
            <label for="ecole">Ecole *</label>	
<?php
												include("../pages/liste_ecoles.php");	
?>												
				<select style="width : 200px;" name="ecole" required>
						<option title="Choisis ton &eacute;cole" value="Modifie ton &eacute;cole !">Choisis ton &eacute;cole</option><br/>
					<optgroup label="Autre">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_autre) ; $i ++)
			{
				if($ecole != $liste_ecoles_autre[$i])
				{
					echo '<option title="'.$liste_ecoles_autre[$i].'" value="'.$liste_ecoles_autre[$i].'">'.$liste_ecoles_autre[$i].'</option><br/>';	
				}
				else
				{
					echo '<option title="'.$liste_ecoles_autre[$i].'" value="'.$liste_ecoles_autre[$i].'" selected>'.$liste_ecoles_autre[$i].'</option><br/>';	
				}
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Ecoles d'ing&eacute;nieur">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_ingenieur) ; $i ++)
			{
				if($ecole != $liste_ecoles_ingenieur[$i])
				{
					echo '<option title="'.$liste_ecoles_ingenieur[$i].'" value="'.$liste_ecoles_ingenieur[$i].'">'.$liste_ecoles_ingenieur[$i].'</option><br/>';	
				}
				else
				{
					echo '<option title="'.$liste_ecoles_ingenieur[$i].'" value="'.$liste_ecoles_ingenieur[$i].'" selected>'.$liste_ecoles_ingenieur[$i].'</option><br/>';	
				}
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Universit&eacute;s">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_universites) ; $i ++)
			{
				if($ecole != $liste_ecoles_universites[$i])
				{
					echo '<option title="'.$liste_ecoles_universites[$i].'" value="'.$liste_ecoles_universites[$i].'">'.$liste_ecoles_universites[$i].'</option><br/>';	
				}
				else
				{
					echo '<option title="'.$liste_ecoles_universites[$i].'" value="'.$liste_ecoles_universites[$i].'" selected>'.$liste_ecoles_universites[$i].'</option><br/>';	
				}
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Ecoles de commerce">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_commerce) ; $i ++)
			{
				if($ecole != $liste_ecoles_commerce[$i])
				{
					echo '<option title="'.$liste_ecoles_commerce[$i].'" value="'.$liste_ecoles_commerce[$i].'">'.$liste_ecoles_commerce[$i].'</option><br/>';	
				}
				else
				{
					echo '<option title="'.$liste_ecoles_commerce[$i].'" value="'.$liste_ecoles_commerce[$i].'" selected>'.$liste_ecoles_commerce[$i].'</option><br/>';	
				}
			}
?>
					</optgroup>

				</select>
       </div>
            <input type="submit" value="Mettre &agrave; jour" id="creer_profil" />
    </form>
            <p>* : Information obligatoire</p>
</div>

</section>
<?php
	}
}
else
{
?>
<section class="contenu">
<h2>Attention</h2>
<p class="message">Pour acc&eacute;der &agrave; cette page, tu dois &ecirc;tre connect&eacute;.</p>
<p><a href="connexion.php">Se connecter</a></p>
</section>
<?php
}
?>


<!-- Importation du bas de page -->

		<?php include("../ajouts/foot_inscription.php"); ?>



	</body>
</html>