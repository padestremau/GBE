<section class="contenu" class="texte_etape">
	
	<a href="?t=Administration" id="bouton_retour">Retour</a>
	<a href="?t=Liste_Ecoles" id="bouton_retour">Liste des participants par école</a>
	
<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$perso_id_array = mysql_fetch_array(mysql_query("SELECT id, rang FROM users WHERE email = '$perso'"));
	$perso_id = $perso_id_array['id'];

		$liste_equipes = mysql_query("SELECT DISTINCT equipe FROM users ORDER BY equipe");

		if($liste_equipes != null)
		{
			echo '<br/><h2 class="titre_choisi_troncon">Liste des &eacute;quipes et ses participants.</h2>';

			while($equipes = mysql_fetch_array($liste_equipes))
			{
				if($equipes['equipe'] != 'aucune')
				{
					echo '<div class="liste_equipes"><h3 style="margin-left : 40px;">'.$equipes['equipe'].'</h3>';

					$nom_equipe = $equipes['equipe'];
					$id_chef_equipe = mysql_query("SELECT id FROM users WHERE equipe='$nom_equipe' AND rang='2' ");
					$id_chef_dequipe = mysql_fetch_array($id_chef_equipe);
					$id_chef_dequip = $id_chef_dequipe['id'];
					$id_troncon_equipe_choisi = mysql_query("SELECT id FROM organisation WHERE id_user='$id_chef_dequip'");
					$id_troncon_dequipe_choisi = mysql_fetch_array($id_troncon_equipe_choisi);
					$id_troncon_dequipe_chois = $id_troncon_dequipe_choisi['id'];
					$troncon_equipe_choisi = mysql_query("SELECT id, ville_depart, ville_arrivee FROM troncon WHERE id='$id_troncon_dequipe_chois'");
					$troncon_dequipe_choisi = mysql_fetch_array($troncon_equipe_choisi);

					
					echo '<div class="troncon_equipe"><h4>'.$troncon_dequipe_choisi['id'].')'.$troncon_dequipe_choisi['ville_depart'].' '.$troncon_dequipe_choisi['ville_arrivee'].'</h4></div>';
					
					$liste_participant = mysql_query("SELECT id, prenom, nom, avatar, rang FROM users WHERE equipe='$nom_equipe' ORDER BY rang");
					echo '<ul>';
					while($liste_participants = mysql_fetch_array($liste_participant))
					{
						$id_personne = $liste_participants['id'];
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
							echo '<a href="?t=Page_Profil&p='.$id_personne.'&r=1" class="lien_profil_administration"><li class="chef_equipe"><strong>'.$liste_participants['prenom'].' '.$liste_participants['nom'].'</strong><img alt="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" src="'.$emplacement_avatar.'" title="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" class="photo_profil_administration_equipe"/></li></a>';		
						}
						else
						{
							echo '<a href="?t=Page_Profil&p='.$id_personne.'&r=1" class="lien_profil_administration"><li class="membre_equipe"><strong>'.$liste_participants['prenom'].' '.$liste_participants['nom'].'</strong><img alt="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" src="'.$emplacement_avatar.'" title="'.$liste_participants['prenom'].' '.$liste_participants['nom'].'" class="photo_profil_administration_equipe"/></li></a>';	
						}
					}
					echo '</ul></div>';
				}
			}

		}
		else
		{
?>
			<h2 class="titre_choisi_troncon">Attention !</h2>	
			<p style="text-indent : 30px; ">Il n\'y a aucune &eacute;quipe cr&eacute;&eacute;e.</strong></p>
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