<?php
if(isset($_SESSION['email'])){

		if(isset($_POST['MAX_FILE_SIZE']) && sizeof($_FILES['avatar']) <= $_POST['MAX_FILE_SIZE'])
		{
			$perso = $_SESSION['email'] ;
			$req = mysql_query("SELECT id, avatar FROM users WHERE email = '$perso'");
			$dnn = mysql_fetch_array($req);
			$id_utilisateur = $dnn['id'];
			$avatar_utilisateur = $dnn['avatar'];
		
			if($avatar_utilisateur != null)
			{
				unlink ($avatar_utilisateur); 
				mysql_query("update users set avatar='' where id='$id_utilisateur'");
			}
				//On d&eacute;place la photo de l'avatar 
				$chemin = 'img/profils/';
				$infosfichier = pathinfo($_FILES['avatar']['name']);
				$extension_upload = $infosfichier['extension'];
				$nom_fichier = $id_utilisateur.'.'.$extension_upload;
				$avatar = $chemin.$nom_fichier;
				move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin.$nom_fichier);

				if(mysql_query('update users set avatar="'.$avatar.'" where email="'.mysql_real_escape_string($_SESSION['email']).'"'))
					{
?>
<section class="contenu">
	<a href="?t=Profil" class="bouton_retour">Retour</a>
	<h2>Modification effectu&eacute;e</h2>

	<p style="text-align: center;">La photo a bien &eacute;t&eacute; ajout&eacute;e &agrave; la biblioth&egrave;que.</p>
</section>
<?php
					}
					else
					{
?>
<section class="contenu">
	<a href="?t=Profil" class="bouton_retour">Retour</a>
	<h2>Attention</h2>

	<p style="text-align: center;">Le photo n\'a pas pu &ecirc;tre ajout&eacute;e &agrave; la biblioth&egrave;que. Veuillez r&eacute;essayer.</p>
</section>
<?php
					}
		}
		else
		{
?>
<section class="contenu">
	<a href="?t=Profil" class="bouton_retour">Retour</a>
	<h2>Tu d&eacute;sires changer ta photo ?</h2>
		<p>Charge une photo qui correspond aux consignes suivantes :
			<ul>
				<li>Taille < 500ko </li>
				<li>Dimensions carr&eacute;es</li>
				<li>Visage au centre</li>
			</ul>
		</p>
		<form method="post" enctype="multipart/form-data" action="?t=Edit_Avatar" style="margin-left: 50px;">
            <label for="avatar">Image perso </label>
            									<input type="file" name="avatar" /><br />
												<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
            <input type="submit" value="Cr&eacute;er" id="creer_profil" />
		</form>


</section>


<?php
		}
}
else
{
?>

<section class="contenu">

	<a href="?t=Profil" class="bouton_retour">Retour</a>
	<h2>Attention</h2>

	<p style="text-indent : 50px;">Vous devez &ecirc;tre connect&eacute; pour charger des photos.</p>
	
	
	<p><a href="espace_membre/connexion.php">Se Connecter</a></p>

</section>

<?php

}

?>