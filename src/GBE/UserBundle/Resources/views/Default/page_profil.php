<?php
//Si l utilisateur est connecte, il a acces au profil en question

if(isset($_SESSION['email']))
{
$email = $_SESSION['email'];
$rang = mysql_fetch_array(mysql_query("SELECT rang FROM users WHERE email = '$email'"));
$rang_perso = $rang['rang'];

?>

<section class="contenu">
<?php

	if($rang_perso == 1)
	{
?>
	<a href="?t=Administration" id="bouton_retour">Retour</a>
<?php
	}
	elseif($_GET['r']==1)
	{
?>
	<a href="?t=Liste_Participants" id="bouton_retour">Retour</a>
<?php
	}
	else
	{
?>
	<a href="?t=Mon_Equipe" id="bouton_retour">Retour</a>
<?php
	}
?>

<section>
<h2>Profil</h2>


<div id="identite">

		<h3>
<?php

if(isset($_SESSION['email'])){
$perso = $_GET['p'] ;
$req = mysql_query("SELECT prenom, nom FROM users WHERE id = '$perso'");
while($dnn = mysql_fetch_array($req))
{
	echo ' '.$dnn['prenom'];
	echo ' '.$dnn['nom'];
}
}
?>
		</h3>

		<div id="portrait">
			<img id="photo_portrait" src="
					<?php 
					if(isset($_SESSION['email']))
					{
						$pers = $_GET['p'] ;
						$photo = mysql_query("SELECT avatar FROM users WHERE id = '$pers'");
						$pht = mysql_fetch_array($photo);
						if($pht['avatar']!=null)
						{
							echo $pht['avatar'];
						}
						else
						{
							echo 'img/profils/profil_defaut.png';
						}
					}
					?>" alt="" />
					
		</div>
			<p><strong>Email :</strong> <a href="mailto:<?php $ema = mysql_query("SELECT email FROM users WHERE id = '$perso'");
				while($emai = mysql_fetch_array($ema)) { echo htmlentities($emai['email']); }?>">Ecrire un message</a> </p>
			<p><strong>Tel :</strong> <?php $pho = mysql_query("SELECT tel FROM users WHERE id = '$perso'");
				while($phon = mysql_fetch_array($pho)) { echo htmlentities($phon['tel']); }?> </p>
			<p><strong>Ecole :</strong> <?php $eco = mysql_query("SELECT ecole FROM users WHERE id = '$perso'");
				while($ecol = mysql_fetch_array($eco)) { echo ' '.$ecol['ecole']; }?> </p>
			<p>
				<?php $adre = mysql_query("SELECT adresse1, adresse2, adresse3, adresse4 FROM users WHERE id = '$perso'"); 
				$adres = mysql_fetch_array($adre);
				if($adres['adresse2']!=null)
				{
					echo '<strong>Adresse :</strong>   '.$adres['adresse1']; 
					echo ', '.$adres['adresse2'].', '; 
					echo $adres['adresse3'].', '; 
					echo $adres['adresse4'].'<br/>';
				}
				else
				{
					echo '<br/>';
				}
				?> 
			</p>
			<p>
				<?php $dat = mysql_query("SELECT DAY(date_naissance) AS jour, MONTH(date_naissance) AS mois, YEAR(date_naissance) AS annee FROM users WHERE id = '$perso'");
					$date = mysql_fetch_array($dat) ;
					if($date['jour']!=0)
					{
						echo '<strong>Date de naissance :</strong>  '.htmlentities($date['jour']); 
						$mois_annee = array("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");
						$val = htmlentities($date['mois']);
						echo ' '.htmlentities($mois_annee[$val -1]);
						echo ' '.htmlentities($date['annee']);
					}
					else
					{
						echo '<br/>';
					}
					?> 
			</p>
			<p><?php $collecte = mysql_query("SELECT page_collecte FROM users WHERE id = '$perso'");
				while($collect = mysql_fetch_array($collecte)) 
				{ 
					if(htmlentities($collect['page_collecte']) != null)
					{
						echo '<strong>Page de collecte :</strong> <a href="'.htmlentities($collect['page_collecte']).'"  target="_blank">Acc&eacute;der &agrave; la page de collecte.</a>'; 
					}
				}?> 
			</p>


</div>
<p><br/></p>
</section>

<section>
<?php
if(isset($_SESSION['email'])){

	$perso_id = $_GET['p'] ;

	//Selection de l'&eacute;tape enregistr&eacute;e dans la base de donn&eacute;es	
	$etape_choisie = mysql_query("SELECT id FROM organisation WHERE id_user = '$perso_id'");
	$etape_choisi = mysql_fetch_array($etape_choisie);
	$num_etape = $etape_choisi['id'];
			
	//Affichage de l'&eacute;tape choisie si elle existe
			if($num_etape!=null)
			{
			
				echo '
				
				<h2>Tron&ccedil;on choisi</h2>
				<div id="box_troncon_choisi">
				';

			$liste = mysql_query("SELECT id, year(date_debut) AS annee, day(date_debut) AS jour_debut, month(date_debut) AS mois_debut, hour(date_debut) AS heure_debut, minute(date_debut) AS minute_debut, day(date_fin) AS jour_fin, month(date_fin) AS mois_fin, hour(date_fin) AS heure_fin, minute(date_fin) AS minute_fin, ville_depart, ville_arrivee, altitude_depart, altitude_arrivee, altitude_max, lieu_depart, lieu_arrivee, passe_ville, distance, temps_route, denivele FROM troncon WHERE id = '$num_etape'");
	
			$mois_annee = array("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");	
			$donnees = mysql_fetch_array($liste);
			$mois_debut = htmlentities($donnees['mois_debut']) -1;
			$mois_fin = htmlentities($donnees['mois_fin']) -1;

				if(htmlentities($donnees['mois_debut'])==htmlentities($donnees['mois_fin']))
				{
				echo 	'<div class="details_course">
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
								<h4>'.htmlentities($donnees['id']).') '.htmlentities($donnees['ville_depart']).' - '.htmlentities($donnees['ville_arrivee']).'</h4>
									<ul>
										<li><strong>Dates :</strong> du ';
											
											if(htmlentities($donnees['jour_debut'])==1)
											{
												echo htmlentities($donnees['jour_debut']).'er';
											}
											else
											{
												echo htmlentities($donnees['jour_debut']);
											}
											
											echo ' ('.htmlentities($donnees['heure_debut']).':'.htmlentities($donnees['minute_debut']).htmlentities($donnees['minute_debut']).') au ';
											
											if(htmlentities($donnees['jour_fin'])==1)
											{
												echo htmlentities($donnees['jour_fin']).'er';
											}
											else
											{
												echo htmlentities($donnees['jour_fin']);
											}
											
											echo ' ('.htmlentities($donnees['heure_fin']).':'.htmlentities($donnees['minute_fin']).htmlentities($donnees['minute_fin']).') '.$mois_annee[$mois_debut].'</li>
										<li><strong>Distance :</strong> '.htmlentities($donnees['distance']).' km</li>
										<li><strong>Altitude d&eacute;part :</strong> '.htmlentities($donnees['altitude_depart']).' m</li>
										<li><strong>Altitude arriv&eacute;e :</strong> '.htmlentities($donnees['altitude_arrivee']).' m</li>
										<li><strong>Altitude maximale :</strong> '.htmlentities($donnees['altitude_max']).' m</li>
										<li><strong>Temps de route :</strong> '.htmlentities($donnees['temps_route']).'</li>
										<li><strong>Lieu de d&eacute;part :</strong> '.$donnees['lieu_depart'].'</li>
										<li><strong>Lieu d\'arriv&eacute; :</strong> '.$donnees['lieu_arrivee'].'</li>
										<li><strong>Villes de passage :</strong> '.$donnees['passe_ville'].'</li>
										<li><strong>D&eacute;nivel&eacute; total : </strong> '.htmlentities($donnees['denivele']).' m</li>
									</ul>
							</div>
						</div>';
					}
				else
				{
					echo 	'<div class="details_course">
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
								<h4>'.htmlentities($donnees['id']).') '.htmlentities($donnees['ville_depart']).' - '.htmlentities($donnees['ville_arrivee']).'</h4>
									<ul>
										<li><strong>Dates :</strong> du ';
											
											if(htmlentities($donnees['jour_debut'])==1)
											{
												echo htmlentities($donnees['jour_debut']).'er';
											}
											else
											{
												echo htmlentities($donnees['jour_debut']);
											}
											
											echo ' ('.htmlentities($donnees['heure_debut']).':'.htmlentities($donnees['minute_debut']).htmlentities($donnees['minute_debut']).') '.$mois_annee[$mois_debut].'<br/> au ';
											
											if(htmlentities($donnees['jour_fin'])==1)
											{
												echo htmlentities($donnees['jour_fin']).'er';
											}
											else
											{
												echo htmlentities($donnees['jour_fin']);
											}
											
											echo ' ('.htmlentities($donnees['heure_fin']).':'.htmlentities($donnees['minute_fin']).htmlentities($donnees['minute_fin']).') '.$mois_annee[$mois_fin].'</li>
										<li><strong>Distance :</strong> '.htmlentities($donnees['distance']).' km</li>
										<li><strong>Altitude d&eacute;part :</strong> '.htmlentities($donnees['altitude_depart']).' m</li>
										<li><strong>Altitude arriv&eacute;e :</strong> '.htmlentities($donnees['altitude_arrivee']).' m</li>
										<li><strong>Altitude maximale :</strong> '.htmlentities($donnees['altitude_max']).' m</li>
										<li><strong>Temps de route :</strong> '.htmlentities($donnees['temps_route']).'</li>
										<li><strong>Lieu de d&eacute;part :</strong> '.$donnees['lieu_depart'].'</li>
										<li><strong>Lieu d\'arriv&eacute; :</strong> '.$donnees['lieu_arrivee'].'</li>
										<li><strong>Villes de passage :</strong> '.$donnees['passe_ville'].'</li>
										<li><strong>D&eacute;nivel&eacute; total : </strong> '.htmlentities($donnees['denivele']).' m</li>
									</ul>
							</div>
						</div>';
				}
				echo '</div>';
			}
			else   // Ou bien du bouton de choix de l'&eacute;tape si l'&eacute;tape n'a pas encore &eacute;t&eacute; choisie
			{
				
?>
				<p>Ce membre n'a pas encore choisi de tron&ccedil;on.</p>
<?php

			}


}
?>
</section>




</section>




<?php
//Sinon, le visiteur ne peut que voir un message qui lui dit de se connecter
}
else
{
	echo '<section class="contenu"><h2>Vous n\'&ecirc;tes pas connect&eacute; !</h2></section>';
}
?>