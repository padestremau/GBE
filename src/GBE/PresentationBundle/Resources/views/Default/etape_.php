<section class="contenu" class="texte_etape">

<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{
$perso = $_SESSION['email'] ;
$perso_id_array = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE email = '$perso'"));
$perso_id = $perso_id_array['id'];
$choix_etape_user = mysql_query("SELECT id, id_user FROM organisation WHERE id_user = '$perso_id'");
$etape = mysql_fetch_array($choix_etape_user);
$etape_choisie = $_GET['c'];
if(htmlentities($etape['id'])==null)
{
	if(mysql_query('insert into organisation(id, id_user) values ("'.$etape_choisie.'", "'.$perso_id.'")'))
	{
		echo '
	<h2 class="titre_choisi_troncon">Etape '.$etape_choisie.'</h2>	
	<p style="text-indent : 30px; ">Tu as donc choisi l\'&eacute;tape '.$etape_choisie.'.</p>
	<p style="text-indent : 30px; ">Tu recevras un mail avec toutes les informations concernant ton tron&ccedil;on et le parcours.</p>
	<p style="text-indent : 30px; margin-left : 20px; margin-right : 20px;">N\'oublies pas que <img src="img/utilitaire/defi_mekong.png" alt="D&eacute;fi du M&eacute;kong" title="D&eacute;fi du M&eacute;kong" style="width : 50px;"/> s\'appuie sur les dons que les participants collectent. Pour cela, nous te demandons de cr&eacute;er une page de collecte sur Alvarum (un site qui permet de r&eacute;cup&eacute;rer les dons) :
	
		<div id="creer_page_collecte">
			<a href="https://defidumekong-tourdefrance-nonstop.alvarum.com/register" target="_blank">Cr&eacute;er sa page de collecte personnelle</a>
		</div>
	</p>

	<h2 class="titre_choisi_troncon">Page de collecte</h2>		
	<p style="text-indent : 80px; ">Tu dois renseigner le lien http:// vers ta page de collecte <strong>personnelle</strong> ici : <br/>
		<p style="font-size : 10px; text-indent : 120px; "><strong>Ex :</strong> https://defidumekong-tourdefrance-nonstop.alvarum.net/pagedelutilisateur</p>
		<form action="?t=Choix_Troncon&p=Page" method="post">
			<input type="text" name="lien_page" style="margin-left: 180px;" size = 50/>
			<input type="submit" value="Enregistrer"/>
		</form>
	</p>

	<h2 class="titre_choisi_troncon">Modifier le tron&ccedil;on</h2>		
	<p style="text-indent : 30px; ">Si tu ne voulais pas faire ce tron&ccedil;on, tu pourras modifier le tron&ccedil;on choisi sur ton <a href="index.php?t=Profil">profil</a>.</p>
	';
	}
	else
	{
		echo '
			<p style="text-indent : 30px; ">Nous  n\'avons pas r&eacute;ussi &agrave; t\'inscrire sur une &eacute;tape. R&eacute;essaie.</p>
			<p style="text-indent : 30px; "><a href="?t=Choix_Troncon>Retour au choix du tron&ccedil;on.</a></p>
			';
	}
	

	$subject = '[Tour de France - Non Stop] Choix du tronçon';




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
"<h3  style=\"text-align : center;\">Cher(e) participant(e),</h3>".
'<p>Tu as donc choisi le <strong>tronçon '.$parcours_chois['id'].'</strong>.</p>'.
'<p>N\'oublies pas de finir toutes les démarches nécessaires à la finalisation de ton <a href="http://www.tourdefrance-nonstop.fr/index.php?t=Profil" style="font-size : 15px;">profil</a></p>'.

'<p>Tourdefrancenonstopeusement,</p><br/>'.
"<p style=\"font-weight : 700; font-size : 15px; color : #93be3d;\">L'équipe du Tour de France NON-STOP</p>".
"<p style=\"font-weight : 200; font-size : 10px; font-style: italic;\">(Ne pas imprimer ce message s'il n'y en a pas besoin, merci !)</p>".
'</body></html>';     
     
	mail($destinataire, $subject, $message, $headers);
	





}
elseif($_GET['q']==1)
{
	mysql_query('update organisation set id="'.$_GET['c'].'" where id="'.$perso_id.'"');
	
?>
	<a href="?t=Profil" id="bouton_retour">Retour sur mon profil</a>
	<h2 class="titre_choisi_troncon">Attention !</h2>	
	<p style="text-align : center; ">Tu as donc chang&eacute; pour <strong>l'&eacute;tape <?php echo $etape_choisie ; ?></strong>.</p>

	<p style="text-align : center;">Tu vas recevoir un nouvel email avec les nouvelles instructions.</p>
	<p style="text-align : center;">N'oublies pas que les informations qui ne vont pas sont modifiables sur ton <a href="?t=Profil">profil</a>.</p>
<?php

	
// On envoie le mail de recapitulation

	$destinataire = $_SESSION['email'];
	$subject = '[Tour de France - Non Stop] Finalisation de l\'inscription';
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
"<h3 style=\"text-align : center;\">Cher(e) participant(e) !</h3>".
'<p>Tu as donc changé de tronçon, et tu as opté pour le <strong>tronçon '.$parcours_chois['id'].'</strong>  Voici un récapitulatif de tout ce que tu as choisi :</p>'. 
'<ul style="margin-left : 100px;">
	<li><strong>Parcours</strong> : '.$parcours_chois['id'].') '.$parcour['ville_depart'].' - '.$parcour['ville_arrivee'].'</li>
	<li><strong>Page de collecte personnelle : </strong><a href="'.$infos['page_collecte'].'">Page de collecte</a></li>
	<li><strong>Page de collecte d\'équipe : </strong><a href="'.$infos['page_equipe'].'">Page de collecte d\'équipe</a></li>
</ul>'.

'<p>Si certaines de ces informations ne sont pas justes, n\'oublies pas que tout est modifiable sur ton <a href="http://www.tourdefrance-nonstop.fr/index.php?t=Profil" style="font-size : 15px;">profil</a>.</p><br/><br/>'.
'<p>Tourdefrancenonstopeusement,</p><br/>'.
"<p style=\"font-weight : 700; font-size : 15px; color : #93be3d;\">L'équipe du Tour de France NON-STOP</p>".
"<p style=\"font-weight : 200; font-size : 10px; font-style: italic;\">(Ne pas imprimer ce message s'il n'y en a pas besoin, merci !)</p>".
'</body></html>';
          
	mail($destinataire, $subject, $message, $headers);
	
}
else
{
	echo '
	<h2 class="titre_choisi_troncon">Attention !</h2>	
	<p style="text-indent : 30px; ">Tu as d&eacute;j&agrave; choisi <strong>l\'&eacute;tape '.$etape_choisie.'</strong>.</p>
	
	<p style="text-indent : 30px; ">Tu peux modifier ton &eacute;tape en te rendant sur ton <a href="index.php?t=Profil">profil</a>.</p>
	';
}
}

?>

</section>