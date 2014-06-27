<!--  Mon equipe -->

<section class="contenu">
	
<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$perso_id_array = mysql_fetch_array(mysql_query("SELECT id, equipe, page_equipe FROM users WHERE email = '$perso'"));
	$perso_id = $perso_id_array['id'];
	$perso_equipe = $perso_id_array['equipe'];
	$page_equipe = $perso_id_array['page_equipe'];

		if($perso_equipe != null)
		{
?>
	<a href="?t=Liste_Participants" title="Liste des Participants" class="bouton_retour">Liste des Participants</a>
	<a href="?t=Edit_Equipe" title="Changer d'Equipe" class="bouton_retour">Changer d'&eacute;quipe</a>
<?php

				if($perso_equipe != 'aucune')
				{
					echo '<h2 class="titre_choisi_troncon">Mon &eacute;quipe.</h2>';
					echo '<div class="liste_equipes"><h3 style="margin-left : 40px;">'.$perso_equipe.'</h3>';

					$nom_equipe = $perso_equipe;
					$id_chef_equipe = mysql_query("SELECT id FROM users WHERE equipe='$nom_equipe' AND rang='2' ");
					$id_chef_dequipe = mysql_fetch_array($id_chef_equipe);
					$id_chef_dequip = $id_chef_dequipe['id'];
					$id_troncon_equipe_choisi = mysql_query("SELECT id FROM organisation WHERE id_user='$id_chef_dequip'");
					$id_troncon_dequipe_choisi = mysql_fetch_array($id_troncon_equipe_choisi);
					$id_troncon_dequipe_chois = $id_troncon_dequipe_choisi['id'];
					$troncon_equipe_choisi = mysql_query("SELECT id, ville_depart, ville_arrivee FROM troncon WHERE id='$id_troncon_dequipe_chois'");
					$troncon_dequipe_choisi = mysql_fetch_array($troncon_equipe_choisi);
					
					echo '<div class="troncon_equipe"><h4>'.$troncon_dequipe_choisi['id'].')'.$troncon_dequipe_choisi['ville_depart'].' '.$troncon_dequipe_choisi['ville_arrivee'].'</h4></div>';
					
					$liste_participant = mysql_query("SELECT prenom, nom, avatar, rang FROM users WHERE equipe='$nom_equipe' ORDER BY rang");
					echo '<ul>';
					while($liste_participants = mysql_fetch_array($liste_participant))
					{
						if($liste_participants['avatar'] == null)
						{
							$emplacement_avatar = 'img/profils/profil_defaut.png';
						}
						else
						{
							$emplacement_avatar = $liste_participants['avatar'];
						}
						if($liste_participants['rang']==2)
						{
							echo '<a href="?t=Page_Profil&p='.$personne.'" class="lien_profil_administration"><li class="chef_equipe"><strong>'.$liste_participants['prenom'].' '.$liste_participants['nom'].'</strong><img alt="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" src="'.$emplacement_avatar.'" title="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" class="photo_profil_administration_equipe"/></li></a>';		
						}
						else
						{
							echo '<a href="?t=Page_Profil&p='.$personne.'" class="lien_profil_administration"><li class="membre_equipe"><strong>'.$liste_participants['prenom'].' '.$liste_participants['nom'].'</strong><img alt="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" src="'.$emplacement_avatar.'" title="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" class="photo_profil_administration_equipe"/></li></a>';	
						}
					}
					echo '</ul></div>';
					
					if($page_equipe !=null)
					{
						echo '<div class="liste_equipes_page" style="margin-top : 40px;"><h3 style="margin-left : 40px; font-size : 15px;">Pages de collecte D&eacute;fi du M&eacute;kong</h3>';
					
						$liste_pages_collecte = mysql_query("SELECT prenom, nom, page_collecte, rang FROM users WHERE equipe='$nom_equipe' ORDER BY rang");

						echo '<ul>';
						echo '<a href="'.$page_equipe.'" style="color:black;"><li style="color : green;" class="chef_equipe">Page de l\'&eacute;quipe.</li></a>';
						while($liste_pages = mysql_fetch_array($liste_pages_collecte))
						{
							if($liste_pages['page_collecte'] == null)
							{
								$emplacement_page = '#';
							}
							else
							{
								$emplacement_page = $liste_pages['page_collecte'];
							}
							if($liste_pages['rang']==2)
							{
								echo '<a href="'.$emplacement_page.'" target="_blank" class="lien_profil_administration"><li class="chef_equipe">Page de <strong>'.$liste_pages['prenom'].' '.$liste_pages['nom'].'</strong></li></a>';		
							}
							else
							{
								echo '<a href="'.$emplacement_page.'" target="_blank" class="lien_profil_administration"><li class="membre_equipe">Page de <strong>'.$liste_pages['prenom'].' '.$liste_pages['nom'].'</strong></li></a>';	
							}
						}
						echo '</ul></div>';
					}
				}
				else
				{
?>
			<h2 class="titre_choisi_troncon">Attention !</h2>	
			<p style="text-indent : 30px; ">Il n'y a aucune &eacute;quipe cr&eacute;&eacute;e.</strong></p>
<?php				
				}
		}
		else
		{
?>
			<h2 class="titre_choisi_troncon">Attention !</h2>	
			<p style="text-indent : 30px; ">Il n'y a aucune &eacute;quipe cr&eacute;&eacute;e.</strong></p>
<?php
		}
}
else
{
?>
		<h2 class="titre_choisi_troncon">Attention !</h2>	
		<p style="text-indent : 30px; ">Vous n'&ecirc;tes pas connect&eacute;.</strong></p>
<?php

}

?>

</section>