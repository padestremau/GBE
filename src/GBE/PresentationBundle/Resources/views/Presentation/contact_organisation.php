<!--  Contact -->

<section class="contenu">
	<a href="?t=Contact" id="bouton_retour">Retour</a>
			<h2>Contacter l'organisation</h2>

			<form action="?t=Contact_Traitement" method="post">
                <fieldset class="4u">
                    <legend><h3>Destinataire</h3></legend>
					<input type="checkbox" name="destinataire1" value="p.a.destremau@gmail.com" id="dest1"><label for="dest1">Pierre-Arnaud Destremau, WebMaster</label><br/>
					<input type="checkbox" name="destinataire2" value="augustin.dst@hotmail.fr" id="dest2"/><label for="dest2">Augustin Destremau, Génie</label><br/>
                    <input type="checkbox" name="destinataire3" value="adavout@enfantsdumekong.com" id="dest3"/><label for="dest3">Alban d'Avout, Directeur de Défi du Mékong</label><br/>
                    <input type="checkbox" name="destinataire4" value="gdaboville@enfantsdumekong.com" id="dest4"/><label for="dest4">Guillaume d'Aboville, Directeur de la Communication et du Développement des Ressources</label><br/>

<!--					<input type="checkbox" name="destinataire4" value="" id="dest4"/><label for="dest4">Gaby</label> -->
				
                    <legend><h3>Exp&eacute;diteur</h3></legend>
					Nom :<br/>
					<input type="input" name="nom_expediteur"/><br/>
					Adresse mail :<br/>
					<input type="email" name="email_expediteur" placeholder="adresse@nomdedomaine" required/><br/>
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



