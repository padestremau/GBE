<!--  Choisir le tron&ccedil;on -->



<?php
if(isset($_SESSION['email']))
{
		
	$perso = $_SESSION['email'] ;
	$perso_array = mysql_fetch_array(mysql_query("SELECT id, page_collecte, equipe, page_equipe, rang FROM users WHERE email = '$perso'"));
	$perso_id = $perso_array['id'];
	$perso_rang = $perso_array['rang'];
	$troncon_choisi_array = mysql_fetch_array(mysql_query("SELECT id FROM organisation WHERE id_user = '$perso_id'"));
	$troncon_choisi_id = $troncon_choisi_array['id'];
	$page_collecte = $perso_array['page_collecte'];
	$equipe = $perso_array['equipe'];
	$page_equipe = $perso_array['page_equipe'];

	if($perso_rang != 1)
	{
		if(($troncon_choisi_id != null) or ($_GET['p']=='Page'))
		{
			if($page_collecte != null)		
			{
	
				if($equipe != 'aucune')
				{
			
					if(($page_equipe != null) or ($_GET['p']=='Page_Equipe'))
					{

								//Suppresion de l'&eacute;tape choisie pour la modifier
								if((isset($_GET['h'])) or ($page_equipe != null))
								{
									$option_modification=$_GET['h'];
									if($option_modification=='Modifier')
									{
										mysql_query("DELETE FROM organisation WHERE id_user = '$perso_id'");
									}

?>

<section class="contenu">	
	<a href="?t=Accueil" id="bouton_retour">Retour</a>
	<h2 id="titre_choisi_troncon">Un autre ton tron&ccedil;on ?</h2>	
	
		<a href="?t=Etape_Confirmation&c=6"><img alt="Etape 6" src="img/parcours/etape_6.png"  title="Etape 6"	id="choix_etape_6"/></a>
		<a href="?t=Etape_Confirmation&c=7"><img alt="Etape 7" src="img/parcours/etape_7.png"  title="Etape 7"	id="choix_etape_7"/></a>
		<a href="?t=Etape_Confirmation&c=8"><img alt="Etape 8" src="img/parcours/etape_8.png"  title="Etape 8"	id="choix_etape_8"/></a>
		<a href="?t=Etape_Confirmation&c=9"><img alt="Etape 9" src="img/parcours/etape_9.png"  title="Etape 9"	id="choix_etape_9"/></a>
		<a href="?t=Etape_Confirmation&c=5"><img alt="Etape 5" src="img/parcours/etape_5.png"  title="Etape 5"	id="choix_etape_5"/></a>
		<a href="?t=Etape_Confirmation&c=1"><img alt="Etape 1" src="img/parcours/etape_1.png"  title="Etape 1"	id="choix_etape_1"/></a>
		<a href="?t=Etape_Confirmation&c=10"><img alt="Etape 10" src="img/parcours/etape_10.png"  title="Etape 10"	id="choix_etape_10"/></a><br/>
		<a href="?t=Etape_Confirmation&c=4"><img alt="Etape 4" src="img/parcours/etape_4.png"  title="Etape 4"	id="choix_etape_4"/></a>
		<a href="?t=Etape_Confirmation&c=3"><img alt="Etape 3" src="img/parcours/etape_3.png"  title="Etape 3"	id="choix_etape_3"/></a>
		<a href="?t=Etape_Confirmation&c=2"><img alt="Etape 2" src="img/parcours/etape_2.png"  title="Etape 2"	id="choix_etape_2"/></a>
	
</section>

<?php
								}
								else
								{

									$valeur_champs = $_POST['lien_page_equipe'];
									// Le "i" apr&egrave;s le d&eacute;limiteur du pattern indique que la recherche ne sera pas sensible &agrave; la casse
									if (preg_match("/defidumekong-tourdefrance-nonstop.alvarum/i", "$valeur_champs")) 
									{
										if(mysql_query('UPDATE users set page_equipe="'.$valeur_champs.'" WHERE id = "'.$perso_id.'"'))
										{
?>
<section class="contenu">	
	<h2 id="titre_choisi_troncon">Bienvenu cher(e) participant(e) !</h2>	

	<p style="text-indent : 80px; ">Ton inscription s'est bien termin&eacute;e.</p>

	<p style="text-indent : 30px; ">Si tu ne voulais pas faire ce tron&ccedil;on, tu pourras modifier le tron&ccedil;on choisi sur ton <a href="index.php?t=Profil">profil</a>.<br/></p>

	<p style="text-indent : 30px; margin-left : 70px; ">Mais attention ! Il faudra changer aussi tous ces liens :
		<ul>
			<li>Lien vers ta page de collecte perso</li>
			<li>Lien vers ta page de collecte d'&eacute;quipe</li>
			<li>Le nom de ton &eacute;quipe</li>
		</ul>
	</p>
	
	<p style="text-indent : 30px; ">Et tu recevrais un nouvel email.</p>

	<p><br></p>

	<p style="text-indent : 30px; font-weight:800; ">ATTENTION !</p>
	<p style="text-indent : 30px; ">Tu vas recevoir un compte rendu de ton inscription. N'oublies pas de l'imprimer de l'envoyer à l'adresse ci-dessous avec <strong>ton don de 10 euros</strong> de participation pour finaliser ton inscription !</p>	
	<p></p>	
	<p style="text-indent : 50px; ">45, rue du Hamofihqsldfhj</p>
	<p style="text-indent : 50px; ">75000     Paris Sud</p>
	
	
		
</section>									
<?php

	
// On envoie le mail de recapitulation

	$destinataire = $_SESSION['email'];
	$subject = '[Tour de France - Non Stop] Création du compte';
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
"<h3 style=\"text-align : center;\">Bienvenu cher(e) participant(e) !</h3>".

'<p>Merci de t\'être inscrit(e). L\'inscription est terminée. Voici un récapitulatif de tout ce que tu as choisi :</p>'. 
'<ul style="margin-left : 100px;">
	<li><strong>Parcours</strong> : '.$parcours_chois['id'].') '.$parcour['ville_depart'].' - '.$parcour['ville_arrivee'].'</li>
	<li><strong>Page de collecte personnelle : </strong><a href="'.$infos['page_collecte'].'">Page de collecte</a></li>
	<li><strong>Page de collecte d\'équipe : </strong><a href="'.$infos['page_equipe'].'">Page de collecte d\'équipe</a></li>
</ul>'.
'<p>N\'oublie pas que nous te demandons de <strong>faire un don de 10 euros</strong> afin de finaliser ton inscription en tant que participation aux frais du Tour de France.<br/></p>'. 
'<p>En plus du don que tu vas faire, penses à imprimer le bulletin de confirmation d\'inscription, <a href="http://www.tourdefrance-nonstop.fr/img/documents/Inscription_TDFNS_2013.pdf">disponible ici</a>, et de le renvoyer à l\'adresse mentionnée dessus !<br/></p>'. 
'<p>N\'oublies pas non plus que tout est modifiable sur ton <a href="http://www.tourdefrance-nonstop.fr/index.php?t=Profil" style="font-size : 15px;">profil</a>.</p><br/><br/>'.
'<p>Tourdefrancenonstopeusement,</p><br/>'.
"<p style=\"font-weight : 700; font-size : 15px; color : #93be3d;\">L'équipe du Tour de France NON-STOP</p>".
"<p style=\"font-weight : 200; font-size : 10px; font-style: italic;\">(Ne pas imprimer ce message s'il n'y en a pas besoin, merci !)</p>".
'</body></html>';
     
	mail($destinataire, $subject, $message, $headers);
	
	
										}
										else
										{
?>
<section class="contenu">	
	<h2>Renseigne ta page de collecte d'&eacute;quipe</h2>

		<div id="creer_page_collecte_equipe">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/createATeam" target="_blank">Cr&eacute;er sa page de collecte d'&eacute;quipe</a>
		</div>

	<p style="text-indent : 80px; ">La page n'a pas pu &ecirc;tre ajout&eacute;e &agrave; la base de donn&eacute;es. R&eacute;essaie.</p>
		<p style="font-size : 10px; text-indent : 120px; "><strong>Ex :</strong> https://defidumekong-tourdefrance-nonstop.alvarum.net/pagedelequipedelutilisateur</p>
		<form action="?t=Choix_Troncon&p=Page_Equipe" method="post">
			<input type="url" name="lien_page_equipe" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Enregistrer"/>
		</form>

	<p style="text-indent : 80px; ">N'oublie que tu dois rejoindre la m&ecirc;me &eacute;quipe sur Alvarum que celle sur le site.</p>
	<p style="text-indent : 80px; ">Si tu changes d'&eacute;quipe, il faudra changer les pages sur Alvarum aussi.</p>
</section>
<?php							
										}
									}
									else
									{
?>
<section class="contenu">	
	<h2>Renseigne ta page de collecte d'&eacute;quipe</h2>

		<div id="creer_page_collecte_equipe">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/createATeam" target="_blank">Cr&eacute;er sa page de collecte d'&eacute;quipe</a>
		</div>

	<p style="text-indent : 80px; ">La page ne correspond pas aux conditions. R&eacute;essaie.</p>
		<p style="font-size : 10px; text-indent : 120px; "><strong>Ex :</strong> https://defidumekong-tourdefrance-nonstop.alvarum.net/pagedelutilisateur</p>
		<form action="?t=Choix_Troncon&p=Page_Equipe" method="post">
			<input type="url" name="lien_page_equip" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Enregistrer"/>
		</form>

	<p style="text-indent : 80px; ">N'oublie que tu dois rejoindre la m&ecirc;me &eacute;quipe sur Alvarum que celle sur le site.</p>
	<p style="text-indent : 80px; ">Si tu changes d'&eacute;quipe, il faudra changer les pages sur Alvarum aussi.</p>

</section>
<?php							
									}
								}
					}
					else
					{
?>
<section class="contenu">	
	<h2>Renseigne ta page de collecte d'&eacute;quipe</h2>

		<div id="creer_page_collecte_equipe">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/createATeam" target="_blank">Cr&eacute;er sa page de collecte d'&eacute;quipe</a>
		</div>

	<p style="text-indent : 80px; ">Tu dois renseigner le lien http:// vers ta page de collecte <strong>d'&eacute;quipe</strong> ici :</p>
		<p style="font-size : 10px; text-indent : 120px; "><strong>Ex :</strong> https://defidumekong-tourdefrance-nonstop.alvarum.net/pagedelequipedelutilisateur</p>
		<form action="?t=Choix_Troncon&p=Page_Equipe" method="post">
			<input type="url" name="lien_page_equipe" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Enregistrer"/>
		</form>

	<p style="text-indent : 80px; ">N'oublie que tu dois rejoindre la m&ecirc;me &eacute;quipe sur Alvarum que celle sur le site.</p>
	<p style="text-indent : 80px; ">Si tu changes d'&eacute;quipe, il faudra changer les pages sur Alvarum aussi.</p>

</section>
<?php
					}
				}
				else
				{
?>
<section class="contenu">	
	<h2>Choisis ton &eacute;quipe</h2>

	<h4 style="margin-left : 60px;">Tu veux cr&eacute;er ton &eacute;quipe ?</h4>

		<div id="creer_page_collecte">
			<a href="?t=Rejoindre_Equipe&p=2">Cr&eacute;er son &eacute;quipe</a>
		</div>
	
	<h4 style="margin-left : 60px;">Tu veux rejoindre une &eacute;quipe existante ?</h4>
		<form action="?t=Rejoindre_Equipe&p=4" method="post">
                    <select name="nom_equipe" style="margin-left : 230px;">
<?php
							$liste_equipes = mysql_query("SELECT DISTINCT equipe FROM users ORDER BY equipe");
							while($liste_equipe = mysql_fetch_array($liste_equipes))
							{
								if($liste_equipe['equipe'] != 'aucune')
								{
									echo '<option value="'.$liste_equipe['equipe'].'">'.$liste_equipe['equipe'].'</option>';									
								}

							}
?>
				         </select>
			<input type="submit" value="Rejoindre"/>
		</form>

</section>
<?php						
				}
			}
			else
			{
						$valeur_champs = $_POST['lien_page'];
						// Le "i" apr&egrave;s le d&eacute;limiteur du pattern indique que la recherche ne sera pas sensible &agrave; la casse
						if (preg_match("/defidumekong-tourdefrance-nonstop.alvarum/i", "$valeur_champs")) 
						{
							if(mysql_query('UPDATE users set page_collecte="'.$valeur_champs.'" WHERE id = "'.$perso_id.'"'))
							{
?>
<section class="contenu">	
	<h2>Choisis ton &eacute;quipe</h2>

	<h4 style="margin-left : 60px;">Tu veux cr&eacute;er ton &eacute;quipe ?</h4>

		<div id="creer_page_collecte">
			<a href="?t=Rejoindre_Equipe&p=2">Cr&eacute;er son &eacute;quipe</a>
		</div>
	
	<h4 style="margin-left : 60px;">Tu veux rejoindre une &eacute;quipe existante ?</h4>
		<form action="?t=Rejoindre_Equipe&p=4" method="post">
                    <select name="nom_equipe" style="margin-left : 230px;">
<?php
								$liste_equipes = mysql_query("SELECT DISTINCT equipe FROM users ORDER BY equipe");
								while($liste_equipe = mysql_fetch_array($liste_equipes))
								{
									if($liste_equipe['equipe'] != 'aucune')
									{
										echo '<option value="'.$liste_equipe['equipe'].'">'.$liste_equipe['equipe'].'</option>';									
									}
								}
?>
				         </select>
			<input type="submit" value="Rejoindre"/>
		</form>

</section>

<?php							
							}
							else
							{
?>
<section class="contenu">	
	<h2>Renseigne ta page de collecte personnelle</h2>

		<div id="creer_page_collecte">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/register" target="_blank">Cr&eacute;er sa page de collecte personnelle</a>
		</div>

	<p style="text-indent : 80px; ">La page n'a pas pu &ecirc;tre ajout&eacute;e &agrave; la base de donn&eacute;es. R&eacute;essaie.</p>
		<p style="font-size : 10px; text-indent : 120px; "><strong>Ex :</strong> https://defidumekong-tourdefrance-nonstop.alvarum.net/pagedelutilisateur</p>
		<form action="?t=Choix_Troncon&p=Page" method="post">
			<input type="url" name="lien_page" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Enregistrer"/>
		</form>

</section>
<?php			
							}		
						}
						else
						{
?>
<section class="contenu">	
	<h2>Renseigne ta page de collecte personnelle</h2>

		<div id="creer_page_collecte">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/register" target="_blank">Cr&eacute;er sa page de collecte personnelle</a>
		</div>

	<p style="text-indent : 80px; ">La page ne correspond pas aux conditions. R&eacute;essaie.</p>
		<p style="font-size : 10px; text-indent : 120px; "><strong>Ex :</strong> https://defidumekong-tourdefrance-nonstop.alvarum.net/pagedelutilisateur</p>
		<form action="?t=Choix_Troncon&p=Page" method="post">
			<input type="text" name="lien_page" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Enregistrer"/>
		</form>
</section>
<?php					
						}
			}
		}
		else
		{
?>
<section class="contenu">	
	<h2 id="titre_choisi_troncon">Choisi ton tron&ccedil;on</h2>	
	
		<a href="?t=Etape_Confirmation&c=6"><img alt="Etape 6" src="img/parcours/etape_6.png"  title="Etape 6"	id="choix_etape_6"/></a>
		<a href="?t=Etape_Confirmation&c=7"><img alt="Etape 7" src="img/parcours/etape_7.png"  title="Etape 7"	id="choix_etape_7"/></a>
		<a href="?t=Etape_Confirmation&c=8"><img alt="Etape 8" src="img/parcours/etape_8.png"  title="Etape 8"	id="choix_etape_8"/></a>
		<a href="?t=Etape_Confirmation&c=9"><img alt="Etape 9" src="img/parcours/etape_9.png"  title="Etape 9"	id="choix_etape_9"/></a>
		<a href="?t=Etape_Confirmation&c=5"><img alt="Etape 5" src="img/parcours/etape_5.png"  title="Etape 5"	id="choix_etape_5"/></a>
		<a href="?t=Etape_Confirmation&c=1"><img alt="Etape 1" src="img/parcours/etape_1.png"  title="Etape 1"	id="choix_etape_1"/></a>
		<a href="?t=Etape_Confirmation&c=10"><img alt="Etape 10" src="img/parcours/etape_10.png"  title="Etape 10"	id="choix_etape_10"/></a><br/>
		<a href="?t=Etape_Confirmation&c=4"><img alt="Etape 4" src="img/parcours/etape_4.png"  title="Etape 4"	id="choix_etape_4"/></a>
		<a href="?t=Etape_Confirmation&c=3"><img alt="Etape 3" src="img/parcours/etape_3.png"  title="Etape 3"	id="choix_etape_3"/></a>
		<a href="?t=Etape_Confirmation&c=2"><img alt="Etape 2" src="img/parcours/etape_2.png"  title="Etape 2"	id="choix_etape_2"/></a>
			
</section>
<?php
		}
	}
	else
	{
						//Suppresion de l'&eacute;tape choisie pour la modifier
						if (isset($_GET['h']))
						{
							$option_modification=$_GET['h'];
							if($option_modification=='Modifier')
							{
								mysql_query("DELETE FROM organisation WHERE id_user = '$perso_id'");
							}
						}
?>

<section class="contenu">	
	<h2 id="titre_choisi_troncon">Choisis ton tron&ccedil;on ?</h2>	
	
		<a href="?t=Etape_Confirmation&c=6"><img alt="Etape 6" src="img/parcours/etape_6.png"  title="Etape 6"	id="choix_etape_6"/></a>
		<a href="?t=Etape_Confirmation&c=7"><img alt="Etape 7" src="img/parcours/etape_7.png"  title="Etape 7"	id="choix_etape_7"/></a>
		<a href="?t=Etape_Confirmation&c=8"><img alt="Etape 8" src="img/parcours/etape_8.png"  title="Etape 8"	id="choix_etape_8"/></a>
		<a href="?t=Etape_Confirmation&c=9"><img alt="Etape 9" src="img/parcours/etape_9.png"  title="Etape 9"	id="choix_etape_9"/></a>
		<a href="?t=Etape_Confirmation&c=5"><img alt="Etape 5" src="img/parcours/etape_5.png"  title="Etape 5"	id="choix_etape_5"/></a>
		<a href="?t=Etape_Confirmation&c=1"><img alt="Etape 1" src="img/parcours/etape_1.png"  title="Etape 1"	id="choix_etape_1"/></a>
		<a href="?t=Etape_Confirmation&c=10"><img alt="Etape 10" src="img/parcours/etape_10.png"  title="Etape 10"	id="choix_etape_10"/></a><br/>
		<a href="?t=Etape_Confirmation&c=4"><img alt="Etape 4" src="img/parcours/etape_4.png"  title="Etape 4"	id="choix_etape_4"/></a>
		<a href="?t=Etape_Confirmation&c=3"><img alt="Etape 3" src="img/parcours/etape_3.png"  title="Etape 3"	id="choix_etape_3"/></a>
		<a href="?t=Etape_Confirmation&c=2"><img alt="Etape 2" src="img/parcours/etape_2.png"  title="Etape 2"	id="choix_etape_2"/></a>
		
			
</section>


<?php
	}
}
else
{
?>
<section class="contenu">	
	<h2>Attention</h2>

	<p>Tu n'es pas connect&eacute; !</p>
</section>
<?php						
}
?>