<!-- Menu -->

<?php
$pages=array(
    "Accueil"=>"pages/accueil.php",
    "Participer"=>"pages/participer.php",
    "Presentation"=>"pages/presentation.php",
    "Trophees"=>"pages/trophees.php",
    "Qui_sommes_nous"=>"pages/qui_sommes_nous.php",
    "Parcours"=>"pages/parcours.php",
    "Partenaires"=>"pages/partenaires.php",
    "Nous_suivre"=>"pages/nous_suivre.php",
    "Photos"=>"pages/photos.php",
    "Contact"=>"pages/contact.php",
    "Contact_Organisation"=>"pages/contact_organisation.php",
    "Contact_Chef_Equipe"=>"pages/contact_chef_equipe.php",
    "Contact_Traitement"=>"pages/contact-traitement.php",
    "Profil"=>"espace_membre/profil.php",
    "Inscription"=>"espace_membre/inscription.php",
    "Faire_Don"=>"pages/faire_don.php",
    "Connexion"=>"espace_membre/connexion.php",
    "Etape_"=>"pages/etape_.php",
    "Etape_Confirmation"=>"pages/etape_confirmation.php",
    "Choix_Troncon"=>"pages/choix_troncon.php",
    "Presse"=>"pages/presse.php",
    "Charger_Photos"=>"pages/charger_photos.php",
    "Supprimer_Photos"=>"pages/supprimer_photos.php",
    "Page_Profil"=>"espace_membre/page_profil.php",
    "Edit_Avatar"=>"espace_membre/edit_avatar.php",
    "Edit_Password"=>"espace_membre/edit_password.php",
    "Edit_Infos"=>"espace_membre/edit_infos.php",
    "Rejoindre_Equipe"=>"pages/rejoindre_equipe.php",
    "Equipe"=>"pages/equipe.php",
    "Edit_Equipe"=>"espace_membre/edit_equipe.php",
    "Mon_Equipe"=>"pages/mon_equipe.php",
    "Liste_Participants"=>"pages/liste_participants.php",
    "Liste_Ecoles"=>"pages/liste_participants_ecole.php",
    "Administration"=>"espace_membre/administration.php",
    "Calendrier"=>"pages/calendrier.php"
);

if (isset($_GET['t'])){
	$page=$_GET['t'];
    if (in_array($page, array_keys($pages))){
        $content=$pages[$page];
    }
    }

?>


<section id="section_gauche">
<?php
include('../ajouts/CV_inscription.php')
?>

<nav>
	<div>
		<ul id="menu">
			<li <?php if($page=='Accueil'){echo 'class="active"';}
						elseif($page=='Participer'){echo 'class="active"';}?>><a href="../index.php?t=Accueil">Accueil</a></li>
			<li <?php if($page=='Presentation'){echo 'class="active"';}
						elseif($page=='Trophees'){echo 'class="active"';}?>><a href="../index.php?t=Presentation">Pr&eacute;sentation</a></li>
			<li <?php if($page=='Qui_sommes_nous'){echo 'class="active"';}?>><a href="../index.php?t=Qui_sommes_nous">Qui sommes-nous ?</a></li>
			<li <?php if($page=='Parcours'){echo 'class="active"';}
						elseif($page=='Nous_suivre'){echo 'class="active"';}?>><a href="?t=Parcours">Parcours (Live)</a></li>
			<li <?php if($page=='Calendrier'){echo 'class="active"';}?>><a href="../?t=Calendrier">Calendrier</a></li>
			<li <?php if($page=='Partenaires'){echo 'class="active"';}?>><a href="../index.php?t=Partenaires">Partenaires</a></li>
			<li <?php if($page=='Presse'){echo 'class="active"';}?>><a href="../?t=Presse">Presse</a></li>
			<li <?php if($page=='Photos'){echo 'class="active"';}
						elseif($page=='Supprimer_Photos'){echo 'class="active"';}
						elseif($page=='Charger_Photos'){echo 'class="active"';}?>><a href="../index.php?t=Photos">Photos</a></li>
			<li <?php if($page=='Contact'){echo 'class="active"';}
						elseif($page=='Contact_Chef_Equipe'){echo 'class="active"';}
						elseif($page=='Contact_Organisation'){echo 'class="active"';}
						elseif($page=='Contact_Traitement'){echo 'class="active"';}?>><a href="../index.php?t=Contact">Contact</a></li>

<?php 
//Si l utilisateur est connecte, il a acces a son profil et peut le modifier
if(isset($_SESSION['email']))
{
?>

			<li <?php if($page=='Profil'){echo 'class="active"';}
					elseif($page=='Edit_Avatar'){echo 'class="active"';}
					elseif($page=='Edit_Infos'){echo 'class="active"';}
					elseif($page=='Edit_Password'){echo 'class="active"';}?>><a href="../index.php?t=Profil">Profil</a></li>

<?php
			$perso = $_SESSION['email'] ;
			$rep = mysql_query("SELECT rang FROM users WHERE email = '$perso'");
			$donn = mysql_fetch_array($rep);
			if(htmlentities($donn['rang'])=="1")
			{
?>
			<li <?php if($page=='Administration'){echo 'class="administration"';}
						elseif($page=='Equipe'){echo 'class="administration"';}?>><a href="../index.php?t=Administration">Administration</a></li>

<?php
			}
			else
			{
?>
			<li <?php if($page=='Mon_Equipe'){echo 'class="active"';}
						elseif($page=='Liste_Participants'){echo 'class="active"';}
						elseif($page=='Liste_Ecoles'){echo 'class="active"';}
						elseif($page=='Edit_Equipe'){echo 'class="active"';}?>><a href="../index.php?t=Mon_Equipe">Mon &eacute;quipe</a></li>

<?php
			}

}
?>
		</ul>
	</div>
</nav>

</section>