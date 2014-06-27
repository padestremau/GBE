<!--  Contact -->

<section class="contenu">

	<a href="?t=Contact" id="bouton_retour">Retour</a>

<?php
if(isset($_SESSION['email']))
{
	$perso = $_SESSION['email'] ;
	$req = mysql_query("SELECT prenom, nom FROM users WHERE email = '$perso'");
	$dnn = mysql_fetch_array($req);
	
	$prenom_utilisateur = htmlentities($dnn['prenom']);
	$nom_utilisateur = htmlentities($dnn['nom']);

?>
			<h2>Contacter un chef d'&eacute;quipe</h2>
			<form action="?t=Contact_Traitement" method="post">
                <fieldset>
                    <legend><h3>Chef d'&eacute;quipe destinataire</h3></legend>
                    
                    <select name="destinataire1" id="dest1">
<?php
							$liste_chefs = mysql_query("SELECT prenom, nom, email, equipe, rang FROM users WHERE rang = '2' ORDER BY nom");
							while($liste_chef = mysql_fetch_array($liste_chefs))
							{
								echo '<option value="'.$liste_chef['email'].'">'.$liste_chef['nom'].' '.$liste_chef['prenom'].', chef de '.$liste_chef['equipe'].'</option>';
							}
?>
				         </select>
					
					<input type="hidden" name="nom_expediteur" value="<?php echo $prenom_utilisateur.' '.$nom_utilisateur; ?>"/><br/>
					<input type="hidden" name="email_expediteur" value="<?php echo $perso; ?>"/><br/>
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
<?php
}
else
{
?>
			<h2>Attention</h2>
			<p>Il faut &ecirc;tre connect&eacute; pour pouvoir joindre un chef d'&eacute;quipe.</p>

			<p  style="	text-align: center;"><a href="espace_membre/connexion.php">Se Connecter</a></p>
<?php
}

?>


</section>



