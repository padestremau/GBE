<!--  Photos -->

<section class="contenu">

	<a href="?t=Charger_Photos" id="charger_photos" class="bouton_retour">Charger des photos</a>
<?php			

if(isset($_SESSION['email']))
	{
		$perso = $_SESSION['email'] ;
		$test = mysql_query("SELECT rang FROM users WHERE email = '$perso'");
		$test2 = mysql_fetch_array($test);
			
		if($test2['rang']==1)
		{
?>
	<a href="?t=Supprimer_Photos" class="bouton_retour">Supprimer des photos</a>
<?php
		}
	}
?>
	<h2>Photos</h2>
	
<?php
	$photo1 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '1'");
	if($photo1!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 1</h3>
		<div class="photos_souvenir_etape">';
		while($photos1 = mysql_fetch_array($photo1))
		{
			echo '<img alt="'.$photos1['id'].'" src="'.$photos1['emplacement'].'" title="'.$photos1['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	
	
	$photo2 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '2'");
	if($photo2!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 2</h3>
		<div class="photos_souvenir_etape">';
		while($photos2 = mysql_fetch_array($photo2))
		{
			echo '<img alt="'.$photos2['id'].'" src="'.$photos2['emplacement'].'" title="'.$photos2['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo3 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '3'");
	if($photo3!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 3</h3>
		<div class="photos_souvenir_etape">';
		while($photos3 = mysql_fetch_array($photo3))
		{
			echo '<img alt="'.$photos3['id'].'" src="'.$photos3['emplacement'].'" title="'.$photos3['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo4 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '4'");
	if($photo4!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 4</h3>
		<div class="photos_souvenir_etape">';
		while($photos4 = mysql_fetch_array($photo4))
		{
			echo '<img alt="'.$photos4['id'].'" src="'.$photos4['emplacement'].'" title="'.$photos4['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo5 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '5'");
	if($photo5!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 5</h3>
		<div class="photos_souvenir_etape">';
		while($photos5 = mysql_fetch_array($photo5))
		{
			echo '<img alt="'.$photos5['id'].'" src="'.$photos5['emplacement'].'" title="'.$photos5['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo6 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '6'");
	if($photo6!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 6</h3>
		<div class="photos_souvenir_etape">';
		while($photos6 = mysql_fetch_array($photo6))
		{
			echo '<img alt="'.$photos6['id'].'" src="'.$photos6['emplacement'].'" title="'.$photos6['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo7 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '7'");
	if($photo7!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 7</h3>
		<div class="photos_souvenir_etape">';
		while($photos7 = mysql_fetch_array($photo7))
		{
			echo '<img alt="'.$photos7['id'].'" src="'.$photos7['emplacement'].'" title="'.$photos7['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	
	
	$photo8 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '8'");
	if($photo8!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 8</h3>
		<div class="photos_souvenir_etape">';
		while($photos8 = mysql_fetch_array($photo8))
		{
			echo '<img alt="'.$photos8['id'].'" src="'.$photos8['emplacement'].'" title="'.$photos8['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo9 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '9'");
	if($photo9!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 9</h3>
		<div class="photos_souvenir_etape">';
		while($photos9 = mysql_fetch_array($photo9))
		{
			echo '<img alt="'.$photos9['id'].'" src="'.$photos9['emplacement'].'" title="'.$photos9['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	

	$photo10 = mysql_query("SELECT id, emplacement FROM photos WHERE id_etape = '10'");
	if($photo10!=null)
	{
		echo '<h3 class="titre_partie_photo">Etape 10</h3>
		<div class="photos_souvenir_etape">';
		while($photos10 = mysql_fetch_array($photo10))
		{
			echo '<img alt="'.$photos10['id'].'" src="'.$photos10['emplacement'].'" title="'.$photos10['id'].'" class="photo_souvenir"/>';
		}
		echo '</div>
		<p><br/></p>
		<div class="separation"></div>';
	}	
?>
	
</section>