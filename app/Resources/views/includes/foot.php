<!-- Foot -->
<div id="footer">

<nav id="liens_footer">
	<ul>
		<li><a href="index.php?t=Accueil">Accueil</a></li> |
<?php 
//Si l utilisateur est connecte, il a acces a son profil et peut le modifier
if(isset($_SESSION['email']))
{
?>
		<li><a href="index.php?t=Profil">Profil</a></li> |
<?php
}
?>
		<li><a href="pages_footer/faq.php">FAQ</a></li> |
		<li><a href="pages_footer/mentions_legales.php">Mentions l&eacute;gales</a></li> |
		<li><a href="index.php?t=Contact">Contact</a></li>
	</ul>
	
</nav>

<p id="copyright"> Copyright - Tour de France Non-Stop &#169;</p>

</div>


<section id="partenaires_footer">

<div>
	<img alt=" Partenaire en cr&eacute;ation" title="Partenaire 1" src="" class="image_partenaires_footer"/>
</div>
<div>
	<img alt=" Partenaire en cr&eacute;ation" title="Partenaire 2" src="" class="image_partenaires_footer"/>
</div>

</section>