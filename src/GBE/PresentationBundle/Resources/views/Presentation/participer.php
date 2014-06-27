<!--  Parcours -->

<?php
if(isset($_GET['j'])==1)
{
?>

<section class="contenu">
<a href="?t=Participer" class="bouton_retour">Retour</a>
	<h2>Nouveau partenaire</h2>

<h3 style="margin-left : 50px; ">Partenaire <strong style="color : #922e2e; font-size : 19px;">Bronze</strong> : <strong style="color:#93be3d; font-size : 25px; font-weight : 700;">1 000 &#128;</strong></h3>

<p style="margin-left : 20px; margin-right : 20px; text-indent : 30px;">Sponsoriser le Tour de France Non-Stop avec : 
	<ul style="margin-left : 70px; margin-right : 40px;">
		<li>flocage de votre marque sur les t-shirts des participants</li>
		<li>commentaires d&eacute;di&eacute;s sur la page Facebook</li>
		<li>pr&eacute;sence sur le bas de page et dans la rubrique « Partenaires » du site officiel</li>
	</ul>
</p>

<h3 style="margin-left : 50px; ">Partenaire <strong style="color : #922e2e; font-size : 19px;">Argent</strong> : <strong style="color:#93be3d; font-size : 25px; font-weight : 700;">5 000 &#128;</strong></h3>

<p style="margin-left : 20px; margin-right : 20px; text-indent : 30px;">Sponsoriser le Tour de France Non-Stop avec : 
	<ul style="margin-left : 70px; margin-right : 40px;">
		<li>flocage de votre marque sur les t-shirts des participants</li>
		<li>commentaires d&eacute;di&eacute;s sur la page Facebook</li>
		<li>pr&eacute;sence sur le bas de page et dans la rubrique « Partenaires » du site officiel</li>
<strong>
		<li>Page de collecte &agrave; votre nom</li>
		<li>Stand partenaire &agrave; UNE étape pour communiquer avec les participants</li>
		<li>Communication auprès des parrains locaux</li>
</strong>
	</ul>
</p>


<h3 style="margin-left : 50px; ">Partenaire <strong style="color : #922e2e; font-size : 19px;">Or</strong> : <strong style="color:#93be3d; font-size : 25px; font-weight : 700;">10 000 &#128;</strong></h3>

<p style="margin-left : 20px; margin-right : 20px; text-indent : 30px;">Sponsoriser le Tour de France Non-Stop avec : 
	<ul style="margin-left : 70px; margin-right : 40px;">
		<li>flocage de votre marque sur les t-shirts des participants</li>
		<li>commentaires d&eacute;di&eacute;s sur la page Facebook</li>
		<li>pr&eacute;sence sur le bas de page et dans la rubrique « Partenaires » du site officiel</li>
		<li>Page de collecte &agrave; votre nom</li>
		<li>Stand partenaire &agrave; <strong>CHAQUE</strong> &eacute;tape pour communiquer avec les participants</li>
		<li>Communication auprès de <strong>TOUS</strong> nos parrains locaux <strong>et dans toute la communication interne &agrave; l’&eactue;v&egrave;nement</strong></li>
<strong>
		<li>Invitation &agrave; la soir&eactue;e de retour</li>
		<li>Remise des petits prix</li>
</strong>
	</ul>
</p>



<h3 style="margin-left : 50px; ">Partenaire <strong style="color : #922e2e; font-size : 19px;">Platine</strong> : <strong style="color:#93be3d; font-size : 25px; font-weight : 700;">20 000 &#128;</strong></h3>

<p style="margin-left : 20px; margin-right : 20px; text-indent : 30px;">Sponsoriser le Tour de France Non-Stop avec : 
	<ul style="margin-left : 70px; margin-right : 40px;">
		<li>flocage de votre marque sur les t-shirts des participants</li>
		<li>commentaires d&eacute;di&eacute;s sur la page Facebook</li>
		<li>pr&eacute;sence sur le bas de page et dans la rubrique « Partenaires » du site officiel</li>
		<li>Page de collecte &agrave; votre nom</li>
		<li>Stand partenaire &agrave; <strong>CHAQUE</strong> &eacute;tape pour communiquer avec les participants</li>
		<li>Communication auprès de <strong>TOUS</strong> nos parrains locaux <strong>et dans toute la communication interne &agrave; l’&eactue;v&egrave;nement</strong></li>
		<li>Invitation &agrave; la soir&eactue;e de retour</li>
<strong>
		<li>Remise des grands prix avec partenaire sportif officiel</li>
		<li>Partenaire durable de D&eacute;fi du M&eacute;kong, communication interne  &agrave; l’association d&eacute;di&eacute;e</li>
</strong>
	</ul>
</p>

	<p>
		<a href="index.php?t=Participer&k=1" title="Devenir partenaire du au Tour de France" id="devenir_partenaire">Devenir partenaires</a><br/><br/><br/>
	</p>


</section>
<?php
}
elseif(isset($_GET['k'])==1)
{
?>

<section class="contenu">
<a href="?t=Participer&j=1" class="bouton_retour">Retour</a>
	<h2>Contactez-nous</h2>
			<form action="?t=Participer&m=1" method="post">
                <fieldset class="4u">
                    <legend><h3>Destinataire</h3></legend>
					<input type="hidden" name="destinataire1" value="p.a.destremau@gmail.com" id="dest1"><label for="dest1">Pierre-Arnaud Destremau, WebMaster</label><br/>
				
                    <legend><h3>Exp&eacute;diteur</h3></legend>
					Société / Prénom Nom : 
					<input type="input" name="nom_expediteur"/><br/>
					Adresse mail : 
					<input type="email" name="email_expediteur" placeholder="adresse@nomdedomaine" required/><br/>
					Choix du sponsor :
                    <select name="choix_sponsor">
                    	<option selected value="Autre">Autre</option>
                    	<option value="Bronze">Sponsor Bronze</option>
                    	<option value="Argent">Sponsor Argent</option>
                    	<option value="Or">Sponsor Or</option>
                    	<option value="Platine">Sponsor Platine</option>
                    </select>

				</fieldset>
				<br/>
				<fieldset>
                    <legend><h3>Message</h3></legend>
					Objet du message : <br/>
					<input type="input" name="objet_email_contact" style="width: 650px;" placeholder="Ecrivez ici l'objet de votre message." required/><br/>
					Contenu du message : <br/>
					<textarea name="texte_email_contact" style="width: 650px;font-family:arial" placeholder="Ecrivez ici le texte de votre message." rows=10 required></textarea>
				</fieldset>
				<br/>
					<input id="bouton-valider-contact" type="submit" value="Envoyer"/>
			</form>
</section>
<?php

}
elseif(isset($_GET['m'])==1)
{

	$destinataire = $_POST['destinataire1'];
	$subject = '[Sponsor Tour de France - Non Stop] '.stripslashes($_POST['objet_email_contact']);
	$message = 
"<html><body>" .
'<img alt="Baniere TDFNS" title="Baniere TDFNS" src="http://www.tourdefrance-nonstop.fr/img/utilitaire/banniere.png" style="width:100%;" />'.
"<h3>Vous avez potentiellement un nouveau partenaire qui s'appelerait : <strong style=\"color : #922e2e;\">".$_POST['nom_expediteur']."</strong></h3>".
"<p>-------------------------------------------------------------------------</p>".
"<strong>Objet : </strong>".stripslashes($_POST['objet_email_contact']).
"<p>-------------------------------------------------------------------------</p>".
"<strong>Choix du sponsor : </strong>".$_POST['choix_sponsor'].
"<p>-------------------------------------------------------------------------</p>".
nl2br(stripslashes($_POST['texte_email_contact'])).
"<p>-------------------------------------------------------------------------</p>".
"<p>Tourdefrancenonstopeusement,<br/></p>".
"<p style=\"font-weight : 700; font-size : 15px; color : #922e2e;\">L'équipe du Tour de France NON-STOP</p>".
"<p style=\"font-weight : 200; font-size : 10px; font-style: italic;\">(Ne pas imprimer ce message s'il n'y en a pas besoin, merci !)</p>".
"</body></html><br/><br/>";

	$headers = 'From: '.$_POST['nom_expediteur'].' <'.$_POST['email_expediteur'].">\r\n" .'Reply-To:'. $_POST['email_expediteur'] . "\r\n" .'X-Mailer: PHP/' . phpversion(). "\r\n"."MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8"; 
     
if(mail($destinataire, $subject, $message, $headers)){
?>
<section class="contenu">
<a href="index.php?t=Participer&k=1" class="bouton_retour">Envoyer un autre mail</a>
			<h2>Message envoy&eacute;</h2>

			<p style="text-align : center;">Votre message a bien &eacute;t&eacute; envoy&eacute;.</p>
			<p style="text-align : center;">Vous serez contacté dans les plus brefs délais.</p>
			<p style="text-align : center;">Merci et &agrave; bientôt.</p><br/><br/>
			
			<p style="text-align : center;">Tourdefrancenonstopeusement,</p><br/><br/>

			<h4 style="text-align : center; font-weight : 700px;">L'équipe du Tour de France NON-STOP</h4>
			
</section>
<?php
}
else
{
?>
<section class="contenu">
<a href="index.php?t=Participer&k=1" class="bouton_retour">Envoyer un autre mail</a>
			<h2>Message non envoy&eacute;</h2>

			<p style="text-align : center;">Votre message n'a pas pu partir.</p>
			<p style="text-align : center;">Veuillez r&eacute;essayer avec une autre adresse ou plus tard.</p>
			
</section>
<?php
}
	
}
else
{
?>

<section class="contenu">
<a href="?t=Accueil" class="bouton_retour">Retour</a>
	<h2>Choisi ton mode de participation</h2>
	
<h3 style="margin-left : 50px;">Tu veux courir en tant que sportif ?</h3>

	<p>
		<a href="espace_membre/inscription.php" title="Participer au Tour de France" class="choix_participer" id="choix_sportif">Sportif</a><br/><br/>
	</p>

<h3 style="margin-left : 50px;">Tu veux devenir partenaire ?</h3>

	<p>
		<a href="index.php?t=Participer&j=1" title="Participer au Tour de France" class="choix_participer" id="choix_partenaire">Partenaire</a><br/><br/>
	</p>

<h3 style="margin-left : 50px;">Tu veux participer en tant que donateur ?</h3>

	<p>
		<a target="_blank" href="http://defidumekong-tourdefrance-nonstop.alvarum.net" title="Faire un don aux Défi du Mékong" class="choix_participer" id="choix_donateur">Donateur</a><br/><br/>
	</p>
	
	<p> 
		<ul  style="font-size : 12px; font-style: italic; margin-left : 137px; border: 1px solid grey; border-radius : 5px; width : 400px; padding-top : 6px; padding-bottom : 6px;">
			<li><strong>Vous êtes un particulier imposable en France</strong><br/>
					=> Réduction d'impôts de 75% de votre don, dans la limite de 521€ par an. <br/>
					Au-delà, réduction d'impôt de 66% à hauteur de 20% du revenu net imposable.
			</li><br/>
			<li><strong>Vous êtes une entreprise imposable en France </strong><br/>
					=> Déductibilité de 60% à hauteur de 5‰ du CA HT.
			</li>
		</ul>
	</p>
	
</section>






<?php
}
?>