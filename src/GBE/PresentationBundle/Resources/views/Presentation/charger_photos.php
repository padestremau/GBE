<!-- Charger des photos -->

<section class="contenu">

<?php
if(isset($_SESSION['email'])){

	if(isset($_POST['MAX_FILE_SIZE']) && (sizeof($_FILES['fichier']) <= $_POST['MAX_FILE_SIZE']))
	{

		if(get_magic_quotes_gpc())
		{
			$_POST['etape'] = stripslashes($_POST['etape']);
		}
		if($_POST['etape']!= 'choisir_etape')
		{
			$etape = mysql_real_escape_string($_POST['etape']);
			$nombre_photos = mysql_num_rows(mysql_query('select id from photos'));
			$id_photo = $nombre_photos+1;

			$chemin = 'img/photos/etape_'.$etape.'/';
			$infosfichier = pathinfo($_FILES['fichier']['name']);
			$extension_upload = $infosfichier['extension'];
			$nom_fichier = $id_photo.'.'.$extension_upload;

			move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin.$nom_fichier);

			if(mysql_query('insert into photos(id, id_etape, emplacement) values ('.$id_photo.', "'.$etape.'", "'.$chemin.$nom_fichier.'")')) 
				{
					echo '<strong>Les photos ont bien &eacute;t&eacute; ajout&eacute;es &agrave; la biblioth&egrave;que.</strong>';
				}
				else
				{
					echo '<strong>Les photos n\'ont pas pu &ecirc;tre ajout&eacute;es &agrave; la biblioth&egrave;que. Veuillez r&eacute;essayer.</strong>';
				}
		}
	}
?>

	<a href="?t=Photos" class="bouton_retour">Retour</a>
	<h2>Charge tes photos</h2>
<div id="module_chargement">
	<form method="post" enctype="multipart/form-data" action="?t=Charger_Photos">
		<label>Etape</label>
				         <select name="etape">
				         	<option value="choisir_etape" selected>Choisir &eacute;tape</option>
	            			<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
	            			<option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option>
	            			<option value="9">9</option><option value="10">10</option>
	            		</select>

		<input type="file" name="fichier" enctype="multipart/form-data" /><br/>
		<input type="submit" value="Charger" id="bouton_charger_photos"/>
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	</form>
</div>


<?php

}
else
{
?>


	<a href="?t=Photos" class="bouton_retour">Retour</a>
	<h2>Attention</h2>

	<p style="text-indent : 50px;">Vous devez &ecirc;tre connect&eacute; pour charger des photos.</p>
	
	
	<p  style="	text-align: center;"><a href="espace_membre/connexion.php">Se Connecter</a></p>



<?php

}

?>
</section>