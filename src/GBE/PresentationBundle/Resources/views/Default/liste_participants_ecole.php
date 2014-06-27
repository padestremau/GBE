
	
<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$perso_id_array = mysql_fetch_array(mysql_query("SELECT id, rang FROM users WHERE email = '$perso'"));
	$perso_id = $perso_id_array['id'];

		include("pages/liste_ecoles.php");	
		
/*		$liste_equipes = mysql_query("SELECT DISTINCT equipe FROM users ORDER BY equipe");
*/
		if(isset($_GET['v']))
		{
?>
<section class="contenu" >
	<a href="?t=Liste_Ecoles" id="bouton_retour">Retour</a>
		<h2 class="titre_choisi_troncon">Liste des participants par &eacute;cole</h2>

<?php
		$nom_ecole = $_POST['nom_ecole'];
		$liste_correspondant = mysql_query("SELECT prenom, nom, equipe FROM users WHERE ecole = '$nom_ecole' ORER BY nom");		
?>
		<h4 style="text-align : center;"><?php echo $nom_ecole; ?></h4>
		
<?php
		if($liste_correspondant != null)
		{
?>
			<table id="tableau_liste_participants">
				<tr>
					<td>Pr&eacute;nom</td>
					<td>Nom</td>
					<td>Equipe</td>
				</tr>

<?php
			while($liste_correspondante = mysql_fetch_array($liste_correspondant))
			{
?>
				<tr>
					<td><?php echo $liste_correspondante['prenom']; ?></td>
					<td><?php echo $liste_correspondante['nom']; ?></td>
					<td><?php echo $liste_correspondante['equipe']; ?></td>
				</tr>
<?php
			}
?>
			</table>
<?php
		}
		else
		{
			echo'<p style="text-align : center;">Il n\'y a encore personne de cette &eacute;cole inscrit sur le <strong>Tour de France NON-STOP</strong>.</p>';
			echo'<p style="text-align : center;">Si tu en conna&icirc;s, n\'h&eacute;site pas &agrave; les inviter !</p>';
		}
?>
</section>
<?php
		}
		else
		{
?>

<section class="contenu">
	
	<a href="?t=Mon_Equipe" id="bouton_retour">Retour</a>
		<h2 class="titre_choisi_troncon">Liste des participants par &eacute;cole</h2>
			
			<p style="text-align :center;">Choisis l'&eacute;cole que tu veux consulter :</p>
			<div style="margin-left : 200px;">
			<form method="post" action="?t=Liste_Ecoles&v=1">
				<select style="width : 200px;" name="nom_ecole">
						<option title="Choisis ton &eacute;cole" value="Modifie ton &eacute;cole !">Choisis ton &eacute;cole</option><br/>
					<optgroup label="Autre">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_autre) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_autre[$i].'" value="'.$liste_ecoles_autre[$i].'">'.$liste_ecoles_autre[$i].'</option><br/>';	
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Ecoles d'ing&eacute;nieur">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_ingenieur) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_ingenieur[$i].'" value="'.$liste_ecoles_ingenieur[$i].'">'.$liste_ecoles_ingenieur[$i].'</option><br/>';	
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Universit&eacute;s">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_universites) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_universites[$i].'" value="'.$liste_ecoles_universites[$i].'">'.$liste_ecoles_universites[$i].'</option><br/>';	
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Ecoles de commerce">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_commerce) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_commerce[$i].'" value="'.$liste_ecoles_commerce[$i].'">'.$liste_ecoles_commerce[$i].'</option><br/>';	
			}
?>
					</optgroup>

				</select>
				
				<input type="submit" value="Consulter"/>
			</form>
			</div>
</section>
<?php
		}
}
else
{
?>
<section class="contenu">
		<h2 class="titre_choisi_troncon">Attention !</h2>	
		<p style="text-indent : 30px; ">Vous n'&ecirc;tes pas connect&eacute;.</strong></p>
</section>
<?php

}

?>

