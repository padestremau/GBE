<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>TDFNS - Connexion</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/main_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/parcours_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/cv_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/inscription_style.css" />
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


<section class="contenu">
<?php
//Si lutilisateur est connecte, on le deconecte
if((isset($_SESSION['email'])) and ($_GET['z']==1))
{
	//On le deconecte en supprimant simplement les sessions email et userid
	unset($_SESSION['email'], $_SESSION['userid']);
?>
<div class="content">
<h2>Op&eacute;ration r&eacute;ussie</h2>
	<h4 style="text-align: center;">Vous avez bien &eacute;t&eacute; d&eacute;connect&eacute;.</h4><br />
	<p style="text-align: center;"><a href="../index.php">Retour &agrave; l'accueil</a></p><br/>
	<p style="text-align: center;"><a href="connexion.php">Se connecter en tant que quelqu'un d'autre</a></p>
</div>
<?php
}
else
{
	$oemail = '';
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['email'], $_POST['password']))
	{
		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$oemail = stripslashes($_POST['email']);
			$email = mysql_real_escape_string(stripslashes($_POST['email']));
			$password = sha1(stripslashes($_POST['password']));
		}
		else
		{
			$email = mysql_real_escape_string($_POST['email']);
			$password = sha1($_POST['password']);
		}
		//On recupere le mot de passe de lutilisateur
		$req = mysql_query('select password,id from users where email="'.$email.'"');
		$dn = mysql_fetch_array($req);
		//On le compare a celui quil a entre et on verifie si le membre existe
		if($dn['password']==$password and mysql_num_rows($req)>0)
		{
			//Si le mot de passe es bon, on ne vas pas afficher le formulaire
			$form = false;
			//On enregistre son pseudo dans la session email et son identifiant dans la session userid
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['userid'] = $dn['id'];
			
//			header("location: index.php?t=Connexion");

?>
<div>
<h2>Op&eacute;ration r&eacute;ussie</h2>
<h4 style="text-align : center;">Vous avez bien &eacute;t&eacute; connect&eacute;.</h4> 
<h4 style="text-align : center;">Vous pouvez acc&eacute;der &agrave; votre espace membre.</h4>
<p style = "margin-left : 320px;"><a href="../index.php">Accueil</a></p>
</div>
<?php
		}
		else
		{
			//Sinon, on indique que la combinaison nest pas bonne
			$form = true;
			$message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//On affiche un message sil y a lieu
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
	//On affiche le formulaire
?>

<div id="section_inscrit">
	<h2>D&eacute;j&agrave; inscrit ?</h2>
    <form action="connexion.php" method="post">
        <p style="text-indent: 40px;">Veuillez entrer vos identifiants pour vous connecter:</p>
        <div class="center">
            <label for="email">Email</label><input type="text" name="email" id="email" autofocus="autofocus" value="<?php echo htmlentities($oemail, ENT_QUOTES, 'UTF-8'); ?>" /><br />
            <label for="password">Mot de passe</label><input type="password" name="password" id="password" /><br />
		</div>
            <input type="submit" value="Connexion" id="bouton_connexion"/>
    </form>

</div>
<?php
	}
}
?>
		
		
</section>


<!-- Importation du bas de page -->

		<?php include("../ajouts/foot.php"); ?>


		
	</body>
</html>