<!--  Administration -->

<?php		
	if(isset($_SESSION['email']))
		{
			$perso = $_SESSION['email'] ;
			$test = mysql_query("SELECT rang FROM users WHERE email = '$perso'");
			$test2 = mysql_fetch_array($test);
			
			if($test2['rang']==1)
			{

?>
<section class="contenu">
	<a href="?t=Equipe" class="bouton_retour">Acc&egrave;s aux &eacute;quipes</a>
	<h2>Administration du site</h2>

	<div>
		<h3 style="margin-left : 40px;">Liste des participants.</h3>

<?php


	$liste = mysql_query("SELECT id, ville_depart, ville_arrivee FROM troncon ");
	
		while($donnees = mysql_fetch_array($liste))
		{
			if($donnees['id']!=10)
			{
				$id_etape = $donnees['id'];
				$nombre = mysql_query("SELECT id, id_user FROM organisation WHERE id = '$id_etape'");
				
				echo 	'<div class="details_course_administration">
							<h4 class="titre_etape_administration">'.htmlentities($donnees['id']).') '.$donnees['ville_depart'].' - '.$donnees['ville_arrivee'].'</h4>
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
									<ul>';
				while($gens = mysql_fetch_array($nombre))
				{
					$personne = $gens['id_user'];
					$qq = mysql_query("SELECT prenom, nom, avatar, page_collecte, equipe, page_equipe, rang FROM users WHERE id = '$personne'");		
					$qq1 = mysql_fetch_array($qq);
					if((($qq1['page_collecte']!=null) and ($qq1['equipe']!="aucune") and ($qq1['page_equipe']!=null)) or ($qq1['rang'] == 1))
					{
						$style_supp = '';						
					}
					else
					{
						$style_supp = 'style="	background-color:  rgba(225,0,0,0.69);"';	
					}
					
					
					if(htmlentities($qq1['avatar']) != null)
					{
						$avatar = htmlentities($qq1['avatar']);
					}
					else
					{
						$avatar = 'img/profils/profil_defaut.png';
					}
					echo '<a href="?t=Page_Profil&p='.$personne.'" class="lien_profil_administration"><li class="liste_membre_administration"  '.$style_supp.'><strong>'.$qq1['prenom'].' '.$qq1['nom'].'</strong>';
					echo '<img alt="'.htmlentities($qq1['prenom']).' '.htmlentities($qq1['nom']).'" src="'.$avatar.'" title="Avatar de '.htmlentities($qq1['prenom']).' '.htmlentities($qq1['nom']).'"	class="photo_profil_administration"/></li></a>';
				}
									
				echo	'</ul>
							</div>
						</div>';

				
			}
			else
			{
				$id_etape = $donnees['id'];
				$nombre = mysql_query("SELECT id, id_user FROM organisation WHERE id = '$id_etape'");
				
				echo 	'<div class="details_course_dernier_administration">
							<h4 class="titre_etape_administration">'.htmlentities($donnees['id']).') '.$donnees['ville_depart'].' - '.$donnees['ville_arrivee'].'</h4>
							<img alt="Etape '.htmlentities($donnees['id']).'" src="img/parcours/etape_'.htmlentities($donnees['id']).'.png" title="Etape '.htmlentities($donnees['id']).'"	id="etape_'.htmlentities($donnees['id']).'"/>
							<div class="description">
									<ul>';
				while($gens = mysql_fetch_array($nombre))
				{
					if(htmlentities($qq1['avatar'])==null)
					{
						$avatar = 'img/profils/defaut_profil.png';
					}
					else
					{
						$avatar = htmlentities($qq1['avatar']);
					}
					$personne = $gens['id_user'];
					$qq = mysql_query("SELECT prenom, nom, avatar FROM users WHERE id = '$personne'");
					$qq1 = mysql_fetch_array($qq);
					echo '<li class="liste_membre_administration"><strong>'.$qq1['prenom'].' '.$qq1['nom'].'</strong>';
					echo '<img alt="'.htmlentities($qq1['prenom']).' '.htmlentities($qq1['nom']).'" src="'.$avatar.'" title="Avatar de '.htmlentities($qq1['prenom']).' '.htmlentities($qq1['nom']).'"	class="photo_profil_administration"/></li>';

				}
									
				echo	'</ul>
							</div>
						</div>';

			}			
		}
		
?>

	</div>
</section>
<?php
}
else
{
?>
<section class="contenu">
	<h2>Attention</h2>

	<p style="margin-left : 80px;">
		Vous n'&ecirc;tes pas administrateur de site. Vous n'avez donc pas acc&egrave;s &agrave; ce domaine.
	</p>
</section>
<?php
}
}
else
{
?>

<section class="contenu">
	<h2>Attention</h2>

	<p style="text-indent : 50px;">Vous devez &ecirc;tre connect&eacute; pour acc&eacute;der &agrave; cette page.</p>
	
	
	<p><a href="espace_membre/connexion.php">Se Connecter</a></p>

</section>

<?php	
}

?>

