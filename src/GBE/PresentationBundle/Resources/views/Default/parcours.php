<!--  Parcours -->

<section class="contenu" id="etapes">
	<h2>Parcours</h2>
	
	<p>
		<img alt="Parcours" src="img/parcours/parcours.png" id="parcours_general" title="Parcours G&eacute;n&eacute;ral" />
	</p>


<?php 
	$liste = mysql_query("SELECT id, year(date_debut) AS annee, day(date_debut) AS jour_debut, month(date_debut) AS mois_debut, hour(date_debut) AS heure_debut, minute(date_debut) AS minute_debut, day(date_fin) AS jour_fin, month(date_fin) AS mois_fin, hour(date_fin) AS heure_fin, minute(date_fin) AS minute_fin, ville_depart, ville_arrivee, altitude_depart, altitude_arrivee, altitude_max, lieu_depart, lieu_arrivee, passe_ville,  distance, temps_route, denivele FROM troncon ");
	
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
											
											echo ' ('.htmlentities($donnees['heure_fin']).':'.htmlentities($donnees['minute_fin']).htmlentities($donnees['minute_fin']).') '.$mois_annee[$mois_debut].'
										</li>	
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

?>

	
</section>