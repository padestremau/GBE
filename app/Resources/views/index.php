<?php
include('espace_membre/config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Le Tour de France Non-Stop</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/main_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/parcours_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/cv_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/inscription_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/autre_style.css" />						
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/police.css" />						

		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="css/imZoom.css" />						

		<link rel="shortcut icon" href="img/utilitaire/favicon_tdfns.ico" >
		<link rel="icon" type="image/gif" href="img/utilitaire/favicon_tdfns.gif" >

		<!-- Pour les mobiles -->
		<meta name="viewport" content="width=device-width, initial-scale=0.4, minimum-scale=0.1, maximum-scale=3.0, target-densitydpi=device-dpi"/>
		<link rel="stylesheet" media="site_mobile" href="css/mobile.css" />

				
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="styleIE_red.css" id="link_stylesheet_ie"/>
		<![endif]-->

<!--
	<script src="js/imZoom.v3.2.1.src.js" type="text/javascript"></script>
	<script type="text/javascript">imZoom.applyTo( seek('.photo_souvenir') );</script>
-->

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	</head>
<body>

<!-- Importation du menu -->

		<?php include("ajouts/menu.php"); ?>

<!-- Importation du haut de page -->

		<?php include("ajouts/head.php"); ?>
		
<!-- Importation du contenu de page -->		
		<?php 
				include($content);
		?>

<!-- Importation du bas de page -->

		<?php 
			if($page!='Accueil')
			{
				include("ajouts/foot.php"); 
			}
			else
			{
			?>
				<p><br/><br/><br/><br/><br/></p>
			<?php
				include("ajouts/foot.php"); 
			}
		?>

</body>
</html>