<?php
				// Envoi du mail positif (tout est bon).
				$destinataire = $qq1['email'];
				$subject = '[Tour de France - Non Stop] Profil complet';
				$headers = 'From: Contact Tour de France Non-Stop <contact@tourdefrance-nonstop.fr'.">\r\n" .'Reply-To: contact@tourdefrance-nonstop.fr'."\r\n" .'X-Mailer: PHP/' . phpversion()."\r\n"."MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8"; 
			
				$infos_mail = mysql_query('SELECT * FROM users WHERE id = "'.$perso_id.'"');
				$infos = mysql_fetch_array($infos_mail);
				$parcours_choisi = mysql_query('SELECT id FROM organisation WHERE id_user = "'.$perso_id.'"');
				$parcours_chois = mysql_fetch_array($parcours_choisi);
				$parcours = mysql_query('SELECT * FROM troncon WHERE id = "'.$parcours_chois['id'].'"');
				$parcour = mysql_fetch_array($parcours);
			
				$message = 
				"<html><body>" .
				'<img alt="Baniere TDFNS" title="Baniere TDFNS" src="http://www.tourdefrance-nonstop.fr/img/utilitaire/banniere.png" style="width:100%;" />'.
				"<h3 style=\"text-align : center;\">Bravo ".$infos['prenom']." !</h3>".
				'<p></p>'.
				'<p style="text-align:center;">Merci pour ton inscription. Tout est complet. </p>'.
				'<p style="text-align:center;">Voici un récapitulatif de tout ce que tu as choisi :</p>'. 
				'<ul style="margin-left : 200px;">
					<li><strong>Parcours</strong> : '.$parcours_chois['id'].') '.$parcour['ville_depart'].' - '.$parcour['ville_arrivee'].'</li>
					<li><strong>Page de collecte personnelle : </strong><a href="'.$infos['page_collecte'].'">Page de collecte</a></li>
					<li><strong>Page de collecte d\'équipe : </strong><a href="'.$infos['page_equipe'].'">Page de collecte d\'équipe</a></li>
				</ul>'.
				'<p style="text-align:center;">N\'oublie pas que nous <strong>manquons de participants !</strong></p>'.
				'<p style="text-align:center;">Tu nous serais bien utile en motivant tes proches (amis, parents, frères et soeurs, cousins ou voisins) <br/> à venir participer à <strong>un</strong> des tronçons eux aussi.<br/></p>'.$texte_avatar.
				'<p style="text-align:center;">N\'oublies pas non plus que tout est modifiable sur ton <a href="http://www.tourdefrance-nonstop.fr/index.php?t=Profil">profil</a>.</p><br/>'.
				'<p style="text-align:center;">Tourdefrancenonstopeusement,</p>'.
				'<p style="text-align:center;"> <span style="font-weight : 700; font-size : 15px; color : #93be3d; ">L\'équipe du Tour de France NON-STOP</span><br/>
				<span style="font-weight : 200; font-size : 10px; font-style: italic; ">(Ne pas imprimer ce message s\'il n\'y en a pas besoin, merci !)</span></p>'.
				'</body></html>';
?>