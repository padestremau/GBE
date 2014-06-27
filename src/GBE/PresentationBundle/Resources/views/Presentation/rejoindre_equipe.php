<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$perso_id_array = mysql_fetch_array(mysql_query("SELECT id, page_collecte, equipe FROM users WHERE email = '$perso'"));
	$perso_id = $perso_id_array['id'];
	$perso_page_collecte = htmlentities($perso_id_array['page_collecte']);
	$perso_equipe = htmlentities($perso_id_array['equipe']);
	
	if($_GET['p'] == 2)
	{
?>
<section class="contenu">
	<h2>Choisis le nom de ton &eacute;quipe</h2>

	<h4 style="margin-left : 10px; text-align : center; margin-right : 20px;">Tu seras chef d'&eacute;quipe et portera la charge de responsabilit&eacute; de trouver 3 autres participants pour ton &eacute;quipe.</h4>

		<form action="?t=Rejoindre_Equipe&p=3" method="post">
			<input type="text" name="nom_equipe_entree" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Cr&eacute;er"/>
		</form>
		
	<p  style="margin-left : 50px;">ATTENTION !</p>
	<p  style="margin-left : 20px;">Tu porteras la charge de tes trois compagnons !</p>
</section>
<?php		
	}
	elseif($_GET['p'] == 3)
	{
		$valeur_equipe = $_POST['nom_equipe_entree'];
		if(mysql_query('UPDATE users set equipe="'.$valeur_equipe.'", rang="2" WHERE id = "'.$perso_id.'"'))
		{
?>
<section class="contenu">	
	<h2>Renseigne ta page de collecte d'&eacute;quipe</h2>

		<div id="creer_page_collecte_equipe">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/createATeam" target="_blank">Cr&eacute;er sa page de collecte d'&eacute;quipe</a>
		</div>

	<p style="text-indent : 80px; ">La page ne correspond pas aux conditions. R&eacute;essaie.</p>
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
		else
		{
?>
<section class="contenu">	
	<h2>Choisis le nom de ton &eacute;quipe</h2>

	<h4 style="margin-left : 20px;">Une erreur est survenue lors de la cr&eacute;ation de ton &eacute;quipe. R&eacute;essaie. Si ce probl&egrave;me persiste, n'h&eacute;site pas &agrave; contacter le WebMaster.</h4>

		<form action="?t=Rejoindre_Equipe&p=3" method="post">
			<input type="text" name="nom_equipe_entree" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Cr&eacute;er"/>
		</form>

	<p  style="margin-left : 50px;">ATTENTION !</p>
	<p  style="margin-left : 20px;">Tu porteras la charge de tes trois compagnons !</p>

</section>
<?php
		}
	}
	elseif($_GET['p'] == 4)
	{
		$valeur_equipe = $_POST['nom_equipe'];
		if(mysql_query('UPDATE users set equipe="'.$valeur_equipe.'" WHERE id = "'.$perso_id.'"'))
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
		else
		{
?>
<section class="contenu">	
	<h2>Choisis ton &eacute;quipe</h2>

	<h4 style="margin-left : 20px;">Une erreur est survenue lors de la cr&eacute;ation de ton &eacute;quipe. R&eacute;essaie. Si ce probl&egrave;me persiste, n'h&eacute;site pas &agrave; contacter le WebMaster.</h4>
		<form action="?t=Rejoindre_equipe&p=4" method="post">
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

	<p  style="margin-left : 50px;">ATTENTION !</p>
	<p  style="margin-left : 20px;">Tu porteras la charge de tes trois compagnons !</p>

</section>


<?php		
		}

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