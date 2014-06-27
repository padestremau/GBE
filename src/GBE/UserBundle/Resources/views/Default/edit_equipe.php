<!--  Mon equipe -->

<section class="contenu">
	
<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$perso_id_array = mysql_fetch_array(mysql_query("SELECT id, equipe, rang FROM users WHERE email = '$perso'"));
	$perso_id = $perso_id_array['id'];
	$perso_equipe = $perso_id_array['equipe'];
	$perso_rang = $perso_id_array['rang'];	
	
	// Code d'execution pour le changement d 'equipe
	
	if(isset($_GET['n'])==1)
	{
		$id_chef_nouveau = $_POST['nouveau_chef_equipe'];
		mysql_query("UPDATE users SET equipe='aucune', rang='3' WHERE email = '$perso'");	
		mysql_query("UPDATE users SET rang='2' WHERE id = '$id_chef_nouveau'");
	}

	if(isset($_GET['k'])==1)
	{
		mysql_query("UPDATE users SET rang='3' WHERE email = '$perso'");	
		mysql_query("UPDATE users SET equipe='aucune' WHERE equipe = '$perso_equipe'");
	}	
	
	// Fin de code d'execution

		if($perso_equipe != null)
		{
?>
	<a href="?t=Liste_Participants" title="Liste des Participants" class="bouton_retour">Liste des Participants</a>
	<a href="?t=Edit_Equipe" title="Changer d'Equipe" class="bouton_retour">Changer d'&eacute;quipe</a>
<?php

				if(($perso_equipe != 'aucune') and ($_GET['m']!=1) and ($_GET['m']!=2))
				{
					echo '<h2 class="titre_choisi_troncon">Changer d\'&eacute;quipe.</h2>';
					echo '<div class="liste_equipes"><h3 style="margin-left : 40px;">'.$perso_equipe.' ne te pla&icirc;t plus ?</h3>';

					$nom_equipe = $perso_equipe;
					$id_chef_equipe = mysql_query("SELECT id FROM users WHERE equipe='$nom_equipe' AND rang='2' ");
					$id_chef_dequipe = mysql_fetch_array($id_chef_equipe);
?>
			<p style="text-indent : 30px; ">Si tu d&eacute;cides de changer d'&eacute;quipe, tu vas devoir modifier ta page de collecte d'&eacute;quipe, voire ta page de collecte personnelle si la nouvelle &eacute;quipe ne fait pas le même tron&ccedil;on que celui que tu avais choisi.</p>


			<p style="text-indent : 30px; ">Es-tu s&ucirc;r(e) et certain(e) que tu veux changer d'&eacute;quipe ? <br/><br/><br/> </p>

	<div>
	
		<a href="?t=Edit_Equipe&m=1" class="bouton_validation" id="bt_val_oui">OUI</a>
		<a href="?t=Mon_Equipe" class="bouton_validation" id="bt_val_non">NON </a>
		<p><br/><br/><br/> </p>
	</div>
<?php
				}
				elseif(($perso_equipe != 'aucune') and ($_GET['m']==1))
				{
					if($perso_rang==3)
					{
						mysql_query("UPDATE users SET equipe='aucune' WHERE email = '$perso'");
					?>

<h2 class="titre_choisi_troncon">Change d'&eacute;quipe.</h2>
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
<?php
					}
					elseif($perso_rang==2)
					{
?>

<h2 class="titre_choisi_troncon">Attention, tu es chef d'&eacute;quipe.</h2>
	<h4 style="margin-left : 60px;">Tu veux supprimer ton &eacute;quipe ?</h4>

		<div id="creer_page_collecte">
			<a href="?t=Edit_Equipe&k=1&m=2">Supprimer mon &eacute;quipe</a>
		</div>
	
	<h4 style="margin-left : 60px;">Tu veux nommer quelqu'un d'autre chef d'&eacute;quipe ?</h4>
		<form action="?t=Edit_Equipe&n=1&m=2" method="post">
                    <select name="nouveau_chef_equipe" style="margin-left : 230px;">
<?php
							$liste_membres = mysql_query("SELECT id, prenom, nom FROM users WHERE equipe='$perso_equipe'");
							while($liste_membre = mysql_fetch_array($liste_membres))
							{
								echo '<option value="'.$liste_membre['id'].'">'.$liste_membre['prenom'].' '.$liste_membre['nom'].'</option>';								
							}
?>
				         </select>
			<input type="submit" value="Nommer"/>
		</form>
		
<?php						
					}

				}
				elseif($_GET['m']==2)
				{
					?>

<h2 class="titre_choisi_troncon">Change d'&eacute;quipe.</h2>
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
<?php
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