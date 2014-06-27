<!-- Accueil -->

<section>
	<div>
		<a href="http://www.defidumekong.com" title="Site des D&eacute;fi du M&eacute;kong" target="_blank"><img alt="D&eacute;fi du M&eacute;kong" src="img/utilitaire/defi_mekong.png"  id="defi_mekong"/></a>

<?php
//Si l utilisateur est connecte, il n'a plus besoin de "participer", il va pouvoir choisir ou consulter son tron&ccedil;on
if(isset($_SESSION['email']))
{
?>
	<a href="?t=Choix_Troncon" title="Choisir son tron&ccedil;on" id="quel_troncon">Quel tron&ccedil;on ?</a>	

	<p><br/></p>
<?php
}
else
{
?>
	<a href="index.php?t=Participer" title="Participer au Tour de France" id="participer">Participer</a>
<?php
}
?>
	</div>
</section>