<!-- Head -->

<section>
	<div  id="head">
		<img alt="Logo TDFNS" src="../img/utilitaire/logo_tdfns.png" title="Tour de France NON-STOP" class="logo_tdfns"/>
		<h1>Le Tour de France NON-STOP</h1>
		<img alt="Logo TDFNS" src="../img/utilitaire/logo_tdfns.png" title="Tour de France NON-STOP" class="logo_tdfns"/>
	</div>
	
<!--BOUTON TWEET de TWEETER-->          
<iframe allowtransparency="true" frameborder="0" scrolling="no"
src="http://platform.twitter.com/widgets/tweet_button.html?url=http://www.tourdefrance-nonstop.fr"
style="float : right; border:none; overflow:hidden; width:100px; height:20px; margin-top : 5px; margin-right : 370px;; display:inline-block;"></iframe>


<!--BOUTON J'AIME DE FACEBOOK-->          
<iframe src="http://www.facebook.com/plugins/like.php?href=https://www.facebook.com/TourDeFranceNonStop&amp;layout=standard&amp;show_faces=false&amp;width=400&amp;action=like&amp;colorscheme=light&amp;height=24" scrolling="no" frameborder="0" style="float : left; border:none; overflow:hidden; width:440px; height:28px; margin-left : 80px; margin-top : 5px; margin-bottom : 5px; display : inline-block; background-color : rgba(255,255,255,0.62); border-radius : 4px;" allowTransparency="true"></iframe> 
<!--FIN DU BOUTON J'AIME-->


	<div id="partie_droite">


		<a href="https://www.facebook.com/TourDeFranceNonStop" target="_blank"><img alt="FB" src="../img/utilitaire/fb.png" title="Nous suivre sur Facebook" class="reseau_social"/></a>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
		<a href="http://twitter.com/share" target="_blank" rel="external"><img alt="Twitter" src="../img/utilitaire/tw.png" title="Nous suivre sur Twitter" class="reseau_social"/></a>

		<h2>du 23 Octobre au 2 Novembre</h2>

		<p style="font-size : 15px; color : #93be3d;">
<?php
				$num = mysql_query("SELECT id FROM users");
				$nu = mysql_num_rows($num);
				echo 'Nombre de participants : '.$nu;
?>
		</p>

				
		<div id="nous_suivre">
			<a target="_blank" href="?t=Nous_suivre">Nous suivre en live</a>
		</div>

		<h3>Viens soutenir les Enfants du M&eacute;kong avec ton &eacute;cole !</h3>
		
		<div id="don">
			<a target="_blank" href="http://defidumekong-tourdefrance-nonstop.alvarum.net">Faire un don</a>
		</div>
	</div>
</section>