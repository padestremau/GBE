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
	if(isset($_POST['old_password'], $_POST['password'], $_POST['passverif']) and $_POST['password']!='')
	{
		//On enleve lechappement si get_magic_quotes_gpc est active
		if(get_magic_quotes_gpc())
		{
		$_POST['old_password'] = stripslashes($_POST['old_password']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		}
	

		//On verifie que c'est le bon ancien mot de passe
		$perso = $_SESSION['email'] ;
		$verif = mysql_query("SELECT password FROM users WHERE email = '$perso'");
		$veri = mysql_fetch_array($verif);
		$old_password = sha1(mysql_real_escape_string($_POST['old_password']));					
		if($old_password == $veri['password'])
		{

			//On verifie si le mot de passe et celui de la verification sont identiques
			if($_POST['password']==$_POST['passverif'])
			{
				//On verifie si le mot de passe a 6 caracteres ou plus
				if(strlen($_POST['password'])>=6)
				{									
						//On echape les variables pour pouvoir les mettre dans une requette SQL
						$password = sha1(mysql_real_escape_string($_POST['password']));					
			
						//On verifie si le mot de passe n'est pas le m&ecirc;me qu'avant
						if($password != $old_password)
						{
							//On modifie les informations de lutilisateur avec les nouvelles
							if(mysql_query('update users set password="'.$password.'" where email="'.mysql_real_escape_string($_SESSION['email']).'"'))
							{
								//Si ca a fonctionne, on naffiche pas le formulaire
								$form = false;
								//On supprime les sessions username et userid au cas ou il aurait modifie son pseudo
								unset($_SESSION['email'], $_SESSION['userid']);
?>
<section class="contenu">
<h2>Op&eacute;ration r&eacute;ussie</h2>
<div>
	<p style="text-align : center;">Votre mot de passe a bien &eacute;t&eacute; modifi&eacute;. Vous devez &agrave; pr&eacute;sent vous reconnecter.</p><br />
	<p style="text-align : center;"><a href="connexion.php">Se connecter</a></p>
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
							$message = 'Vous ne pouvez pas utiliser deux fois de suite le m&ecirc;me mot de passe.';
						}
					}
					else
					{
						//Sinon, on dit que le mot de passe nest pas assez long
						$form = true;
						$message = 'Le mot de passe que vous avez entr&eacute; contient moins de 6 caract&egrave;res.';
					}
				}
				else
				{
					//Sinon, on dit que les mots de passes ne sont pas identiques
					$form = true;
					$message = 'Les mots de passe que vous avez entr&eacute;s ne sont pas identiques.';
				}
			}
			else
			{
				//Sinon, on dit que les mots de passes ne sont pas identiques
				$form = true;
				$message = 'Ce n\'est pas le bon ancien mot de passe.';
			}
	}
	else
	{
		$form = true;
	}
	
	if($form)
	{
?>
<section class="contenu"  id="section_modification">
<?php
		//On affiche un message sil y a lieu
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}

?>
	<a href="edit_infos.php" class="bouton_retour">Retour</a>
<h2>Tu veux modifier ton mot de passe ?</h2>

<div class="content"  id="formulaire_inscription">
    <form action="edit_password.php" method="post">
    	<div>
            <label for="old_password">Ancien mot de passe *</label>	<input type="password" name="old_password" required class="form_align" /><br />
            <label for="password">Nouveau mot de passe *</label>	<input type="password" name="password" required class="form_align" /><br />
            <label for="passverif">Confirmer mot de passe *</label>	<input type="password" name="passverif" required class="form_align" /><br />
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

	</body>
</html>