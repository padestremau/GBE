<?php
//Si l utilisateur est connecte, il a acces a tout le site
if(isset($_SESSION['email']))
{
?>

<!-- Insertion de l'encadre -->

	<?php include("ajouts/CV_perso.php"); ?>


<?php
}
else
{
?>

<?php
	$ousername = '';
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
			//On enregistre son pseudo dans la session username et son identifiant dans la session userid
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['userid'] = $dn['id'];
?>
<div class="CV">
<div class="message"><br/>Vous avez bien &eacute;t&eacute; connect&eacute;. Vous pouvez acc&eacute;der &agrave; votre espace membre.<br />
<a href="?t=Profil">Profil</a><br/>
</div>
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

?>
<div class="CV">
<div class="content"  id="box-CV">	
    <form action="index.php" method="post">
        <div class="center">
            <label for="email" id="label_email">Email</label><input type="text" autofocus="autofocus" name="email" id="email" size="18"/><br />
            <label for="password" id="label_password">Mot de passe</label><input type="password" name="password" id="password" size="18"/><br />
            <input type="submit" value="Connexion" id="box-connexion"/>
            <a href="index.php?t=Participer" class="sinscrire">S'inscrire</a>
		</div>
    </form>
</div>

</div>
<?php
	}
}

?>