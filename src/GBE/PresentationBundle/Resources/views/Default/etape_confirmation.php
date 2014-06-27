<section class="contenu">
	<a href="?t=Choix_Troncon" id="bouton_retour">Retour</a>

<?php
//On verifie que l'utilisateur est connecte
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$perso_id_array = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE email = '$perso'"));
	$perso_id = $perso_id_array['id'];
	$choix_etape_user = mysql_query("SELECT id, id_user FROM organisation WHERE id_user = '$perso_id'");
	$etape = mysql_fetch_array($choix_etape_user);
	
	$etape_choisie = $_GET['c'];
	if(htmlentities($etape['id'])==null)
	{

?>
	<h2 class="titre_choisi_troncon">Etape <?php echo $etape_choisie; ?></h2>	
	<p style="text-indent : 30px; margin-left : 20px; margin-right : 20px;">Tu as choisi l'&eacute;tape <?php echo $etape_choisie ; ?>.</p>
	<p style="text-indent : 30px; margin-left : 20px; margin-right : 20px;">Es-tu sûr(e) et certain(e) de vouloir parcourir ce tron&ccedil;on ? <br/><br/><br/></p>

	<div>
	
		<a href="?t=Etape_&c=<?php echo $etape_choisie;?>" class="bouton_validation" id="bt_val_oui">OUI</a>
		<a href="?t=Choix_Troncon" class="bouton_validation" id="bt_val_non">NON </a>

	</div>
	<div>
	<br/><br/><br/>
	<p style="text-indent : 30px; margin-left : 20px; margin-right : 20px;">Rappel des données du tron&ccedil;on : </p>
<?php

// Debut du script d'appel du troncon

	$liste = mysql_query("SELECT id, year(date_debut) AS annee, day(date_debut) AS jour_debut, month(date_debut) AS mois_debut, hour(date_debut) AS heure_debut, minute(date_debut) AS minute_debut, day(date_fin) AS jour_fin, month(date_fin) AS mois_fin, hour(date_fin) AS heure_fin, minute(date_fin) AS minute_fin, ville_depart, ville_arrivee, altitude_depart, altitude_arrivee, altitude_max, lieu_depart, lieu_arrivee, passe_ville, distance, temps_route, denivele FROM troncon WHERE id='$etape_choisie'");
	
	$mois_annee = array("Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");	
		while($donnees = mysql_fetch_array($liste))
		{
			$mois_debut = htmlentities($donnees['mois_debut']) -1;
			$mois_fin = htmlentities($donnees['mois_fin']) -1;

			if($donnees['id']!=10)
			{
				if(htmlentities($donnees['mois_debut'])==htmlentities($donnees['mois_fin']))
				{
				echo 	'<div class="details_course">
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'_hover.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
								<h4>'.htmlentities($donnees['id']).') '.$donnees['ville_depart'].' - '.$donnees['ville_arrivee'].'</h4>
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
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'_hover.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
								<h4>'.htmlentities($donnees['id']).') '.$donnees['ville_depart'].' - '.$donnees['ville_arrivee'].'</h4>
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
			}
			else
			{
				echo 	'<div class="details_course_dernier">
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'_hover.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
								<h4>'.htmlentities($donnees['id']).') '.$donnees['ville_depart'].' - '.$donnees['ville_arrivee'].'</h4>
									<ul>
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
		}

// fin du script

	}
	else
	{
?>
	<h2 class="titre_choisi_troncon">Attention ! Tu veux changer de tronçon ?</h2>	
	<p style="text-indent : 30px;margin-left : 20px; margin-right : 20px; ">Tu as d&eacute;j&agrave; choisi <strong>l'&eacute;tape <?php echo $etape['id']; ?></strong>.</p>
	
	<p style="text-indent : 30px; margin-left : 20px; margin-right : 20px; ">Si tu comptes réellement modifier ton &eacute;tape, et la remplacer par <strong>l'&eacute;tape <?php echo $etape_choisie; ?></strong>, <br/>clique sur "Je change".</p>

	<p style="text-indent : 30px;margin-left : 20px; margin-right : 20px; ">Mais attention ! Il faudra changer aussi tous ces liens :
		<ul style="margin-left : 70px; ">
			<li>Lien vers ta page de collecte perso</li>
			<li>Lien vers ta page de collecte d'&eacute;quipe</li>
			<li>Le nom de ton &eacute;quipe</li>
		</ul>
	</p>
	
	<p style="text-indent : 30px;margin-left : 20px; margin-right : 20px; ">Et tu recevras un nouvel email.<br/><br/><br/></p>

		<a href="?t=Etape_&c=<?php echo $etape_choisie;?>&q=1" class="bouton_validation" id="bt_val_oui">Je change</a>
		<a href="?t=Choix_Troncon" class="bouton_validation" id="bt_val_non">Je ne change pas</a>

<?php
	}
}
else
{
?>

	<h2 class="titre_choisi_troncon">Attention !</h2>	
	<p style="text-indent : 30px; ">Tu n'es pas connecté !</p>
	<p style="text-indent : 50px; "><a href="espace_membre/connexion.php">Se Connecter</a></p>


<?php
}

?>

</section>