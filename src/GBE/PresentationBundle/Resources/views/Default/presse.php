<!--  Presse -->

<?php

if(isset($_GET['d']))
{
$ou = $_GET['d'];
$logo_telecharger = mysql_query("SELECT emplacement FROM donnees_administration WHERE id='$ou'");
$telecharge = mysql_fetch_array($logo_telecharger);

$fichier = $telecharge['emplacement']; 
$fichier_taille = filesize($fichier);
header("Content-disposition: attachment; filename=$fichier");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: application/octet-stream");
header("Content-Length: $fichier_taille");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
header("Expires: 0");
readfile($fichier);
}
?>

<section class="contenu">
	<h2>Vous d&eacute;sirez &eacute;crire un article ?</h2>

	<h5 style="	text-align: center; margin-left : 20px; margin-right : 20px; font-style:italic; font-weight : 200;">Vous pouvez ci-apr&egrave;s t&eacute;l&eacute;charger un package d'&eacute;l&eacute;ments essentiels pour &eacute;crire un article dans un journal (local, &eacute;cole, national,etc).</h5>
	
	<p style="margin-left : 30px;">Cliquez sur les &eacute;l&eacute;ments que vous d&eacute;sirez t&eacute;l&eacute;charger :
		
		<ul style="margin-left : 100px;">
			<li>R&eacute;sum&eacute;s de tron&ccedil;on : <br/>
													<?php
														for($i=1 ; $i < 11 ; $i++)
														{
															echo '<div style="margin-left : 100px;" >';
															echo '<a href="img/documents/resumes/troncon'.$i.'.pdf" style="color:#d57003;">';
															echo '<label for="troncon'.$i.'"> Tron&ccedil;on numéro '.$i.'</label><br/>';
															echo '</a></div>';
														} 
													?>
<!--													<a href="img/documents/" class="bouton_telecharger"><img alt="Telecharger le resume de troncon" title="Telecharger le resume de troncon" src="img/documents/bouton_telecharger.png"/></a>
-->
			</li>
													
			<li>Logos :
				<div style="margin-left : 50px;">
													<?php
														$liste_logos = mysql_query("SELECT id, titre, emplacement FROM donnees_administration");
														while($liste = mysql_fetch_array($liste_logos))
														{
															echo '<div style="margin-bottom : 40px;">';
															echo '<a href="'.$liste['emplacement'].'" style="color:#d57003;">';
															echo '<label for="chk'.$liste['id'].'">'.$liste['titre'].'</label>';
															echo '<img alt="'.$liste['titre'].'" title="'.$liste['titre'].'" src="'.$liste['emplacement'].'" style="width : 50px; float : right; margin-right : 150px;"/><br/>';
															echo '</a></div>';
														} 
													?>
				</div>
			</li>

			<li>Pour information, le nombre de participants inscrits sur le tron&ccedil;on : <br/><br/>
					<ul style="list-style-type : none;">
													<?php
														for($i=1 ; $i < 11 ; $i++)
														{
															$nombre_participants = mysql_num_rows(mysql_query("SELECT id_user FROM organisation WHERE id='$i'"));
															echo '<li> Tron&ccedil;on n°'.$i.' : <strong>'.$nombre_participants.'</strong>';
														} 
													?>
					</ul>
			</li>
		</ul>

	</p>
	
</section>
