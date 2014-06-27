<?php

//Ajout des destinataires
	
	$destinataire = $_POST['destinataire1'].', '.$_POST['destinataire2'].', '.$_POST['destinataire3'].', '.$_POST['destinataire4'];
	$subject = '[Contact Tour de France - Non Stop]';
	$headers = 'From: '.$_POST['nom_expediteur'].' <'.$_POST['email_expediteur'].">\r\n" .'Reply-To:'. $_POST['email_expediteur'] . "\r\n" .'X-Mailer: PHP/' . phpversion(). "\r\n"."MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8"; 

	$message = 
	
"<html><body>" .
'<img alt="Baniere TDFNS" title="Baniere TDFNS" src="http://www.tourdefrance-nonstop.fr/img/utilitaire/banniere.png" style="width:100%;" />'.
"<h3>Vous avez reçu un nouveau message de <strong  style=\"color : #922e2e;\">".$_POST['nom_expediteur']."</strong></h3>".
"<p>-------------------------------------------------------------------------</p>".
"<strong>Objet : </strong>".stripslashes($_POST['objet_email_contact']).
"<p>-------------------------------------------------------------------------</p>".
nl2br(stripslashes($_POST['texte_email_contact'])).
"<p><br/>-------------------------------------------------------------------------</p>".
"<p>Tourdefrancenonstopeusement,<br/></p>".
"<p style=\"font-weight : 700; font-size : 15px; color : #93be3d;\">L'équipe du Tour de France NON-STOP</p>".
"<p style=\"font-weight : 200; font-size : 10px; font-style: italic;\">(Ne pas imprimer ce message s'il n'y en a pas besoin, merci !)</p>".
"</body></html><br/><br/>";

if(mail($destinataire, $subject, $message, $headers)){
?>
<section class="contenu">
<a href="?t=Contact" class="bouton_retour">Envoyer un autre mail</a>
			<h2>Message envoy&eacute;</h2>

			<p style="text-align : center;">Votre message a bien &eacute;t&eacute; envoy&eacute;.</p>
			<p style="text-align : center;">Merci et &agrave; bientôt.</p>
			
</section>
<?php
}
else
{
?>
<section class="contenu">
<a href="?t=Contact" class"">Envoyer un autre mail</a>
			<h2>Message non envoy&eacute;</h2>

			<p style="text-align : center;">Votre message n'a pas pu partir.</p>
			<p style="text-align : center;">Veuillez r&eacute;essayer avec une autre adresse ou plus tard.</p>
			
</section>
<?php
}
?>