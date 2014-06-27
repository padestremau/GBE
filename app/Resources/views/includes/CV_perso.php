<div class="CV">

		<div id="portrait_CV">
			<a  href="index.php?t=Profil">
			<div>
			<img id="photo_portrait_CV" src="
					<?php if(isset($_SESSION['email'])){
						$pers = $_SESSION['email'] ;
						$photo = mysql_query("SELECT avatar FROM users WHERE email = '$pers'");
						$pht = mysql_fetch_array($photo);
						if($pht['avatar']!=null)
						{
							echo $pht['avatar'];
						}
						else
						{
							echo 'img/profils/profil_defaut.png';
						}
						}
					?>" alt=""  style="width:50px;"/>
			</div>
			<div>
				<?php if(isset($_SESSION['email'])){
						$pers = $_SESSION['email'] ;
						$donnees = mysql_query("SELECT prenom, nom FROM users WHERE email = '$pers'");
						$don = mysql_fetch_array($donnees);
						echo $don['prenom'].'<br/>'.$don['nom'];
						}
					?>
			</div>
			</a>
			<div>
				<form action="espace_membre/connexion.php?z=1" method="post">
					<input type="submit" value="D&eacute;connexion"/>
				</form>
			</div>

		</div>

</div