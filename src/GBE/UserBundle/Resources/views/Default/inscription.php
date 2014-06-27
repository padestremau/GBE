<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Inscription - Le Tour de France Non-Stop</title>
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/main_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/parcours_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/cv_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/inscription_style.css" />
		<link rel="stylesheet" media="screen" type="text/css" title="Main_Style" href="../css/police.css" />												
						
		<link rel="shortcut icon" href="../img/utilitaire/favicon_tdfns.ico" >
		<link rel="icon" type="image/gif" href="../img/utilitaire/favicon_tdfns.gif" >

		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="styleIE_red.css" id="link_stylesheet_ie"/>
		<![endif]-->

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	</head>

<body>
<!-- Importation du menu -->

		<?php include("../ajouts/menu_inscription.php"); ?>


<!-- Importation du haut de page -->

		<?php include("../ajouts/head_inscription.php"); ?>


<?php
//On verifie que l'utilisateur n'est pas connecte
if(isset($_SESSION['email']))
{

$choix_etape=array(
    "Choix_Troncon"=>"pages/choix_troncon.php",
    "Etape_"=>"etape_.php"
);

if (isset($_GET['c']))
{
	$choix=$_GET['c'];
    if (in_array($choix, array_keys($choix_etape)))
    {
        $contenu_etape=$choix_etape[$choix];
    }
    else{
        $contenu_etape='choix_troncon.php';
    }
}
else
{
    $contenu_etape='choix_troncon.php';
    $choix='Choix_Troncon';
}


// On ajoute le choix de tron&ccedil;on
		include($contenu_etape);
}
else
{
?>

<!--  move_uploaded_file($_FILES['file']['tmp_name'], "uploaded/".$filename[0].".".$filename[1]);   -->


<?php
//On verifie que le formulaire a ete envoye
if(isset($_POST['email']))
{
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$_POST['prenom'] = stripslashes($_POST['prenom']);
		$_POST['nom'] = stripslashes($_POST['nom']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['date_naissance'] = stripslashes($_POST['date_naissance']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['adresse1'] = stripslashes($_POST['adresse1']);
		$_POST['adresse2'] = stripslashes($_POST['adresse2']);
		$_POST['adresse3'] = stripslashes($_POST['adresse3']);
		$_POST['adresse4'] = stripslashes($_POST['adresse4']);
		$_POST['tel'] = stripslashes($_POST['tel']);
		$_POST['ecole'] = stripslashes($_POST['ecole']);

	}
	//On verifie si le mot de passe et celui de la verification sont identiques
	if($_POST['password']==$_POST['passverif'])
	{
		//On verifie si le mot de passe a 6 caracteres ou plus
		if(strlen($_POST['password'])>=6)
		{

			//On verifie que le telephone est bien de 10 chiffres
			if(strlen($_POST['tel'])>=10 and strlen($_POST['tel'])<=10)
			{
				//On verifie si lemail est valide
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				{
					//On echape les variables pour pouvoir les mettre dans une requette SQL
					$prenom = mysql_real_escape_string($_POST['prenom']);
					$nom = mysql_real_escape_string($_POST['nom']);
					$password = sha1(mysql_real_escape_string($_POST['password']));
					$date_naissance = mysql_real_escape_string($_POST['date_naissance']);
					$email = mysql_real_escape_string($_POST['email']);
					$adresse1 = mysql_real_escape_string($_POST['adresse1']);
					$adresse2 = mysql_real_escape_string($_POST['adresse2']);
					$adresse3 = mysql_real_escape_string($_POST['adresse3']);
					$adresse4 = mysql_real_escape_string($_POST['adresse4']);
					$tel = mysql_real_escape_string($_POST['tel']);
					$ecole = mysql_real_escape_string($_POST['ecole']);

					//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
					$dn = mysql_num_rows(mysql_query('select id from users where email="'.$email.'"'));
					if($dn==0)
					{
						//On recupere le nombre dutilisateurs pour donner un identifiant a lutilisateur actuel
						$dn2 = mysql_num_rows(mysql_query('select id from users'));
						$id = $dn2+1;
						
						//On enregistre les informations dans la base de donnee
						if(mysql_query('INSERT INTO users(prenom, nom, password, date_naissance, email, adresse1, adresse2, adresse3, adresse4, tel, ecole) VALUES ("'.$prenom.'", "'.$nom.'", "'.$password.'", "'.$date_naissance.'", "'.$email.'", "'.$adresse1.'", "'.$adresse2.'", "'.$adresse3.'", "'.$adresse4.'", "'.$tel.'", "'.$ecole.'")')) 
						{

 							$form = false; //Si le formulaire est bon, on ne l'affiche plus

 							$_SESSION['email'] = $email;  // On connecte l'utilisateur
?>

<section class="contenu">
<h2>Op&eacute;ration r&eacute;ussie</h2>
<div>
<p style="text-indent : 20px; margin-left : 30px;">Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant acc&eacute;der au site ou choisir votre tron&ccedil;on.</p>

	<a href="../index.php?t=Choix_Troncon" title="Choisir son tron&ccedil;on" id="quel_troncon">Quel tron&ccedil;on ?</a>	

</div>
</section>
<?php

// On envoie le mail de création de compte

	$destinataire = $_SESSION['email'];
	$subject = '[Tour de France - Non Stop] Création du compte';
	$headers = 'From: Contact Tour de France Non-Stop <contact@tourdefrance-nonstop.fr'.">\r\n" .'Reply-To: contact@tourdefrance-nonstop.fr'."\r\n" .'X-Mailer: PHP/' . phpversion()."\r\n"."MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8"; 

	$message = 
"<html><body>" .
'<img alt="Baniere TDFNS" title="Baniere TDFNS" src="http://www.tourdefrance-nonstop.fr/img/utilitaire/banniere.png" style="width:100%;" />'.
"<h3 style=\"text-align : center;\">Bienvenu cher(e) participant(e) ! </h3>".

"<p>Ton compte est créé. N'oublie pas de choisir à présent ton tronçon et de remplir ensuite les pages de collectes associées ! <p>".
"<p>N'oublies pas que tout est modifiable sur ton <a href=\"http://www.tourdefrance-nonstop.fr/index.php?t=Profil\" style=\"font-size : 15px;\">profil</a>.</p><br/><br/>".
'<p>Tourdefrancenonstopeusement,</p><br/>'.
"<p style=\"font-weight : 700; font-size : 15px; color : #93be3d;\">L'équipe du Tour de France NON-STOP</p>".
"<p style=\"font-weight : 200; font-size : 10px; font-style: italic;\">(Ne pas imprimer ce message s'il n'y en a pas besoin, merci !)</p>".
'</body></html>';
          
	mail($destinataire, $subject, $message, $headers);	


						}
						else
						{
							//Sinon on dit quil y a eu une erreur
							$form = true;
							$message = 'Une erreur est survenue lors de l\'inscription.';
						}
					}
					else
					{
						//Sinon, on dit que le pseudo voulu est deja pris
						$form = true;
						$message = 'Un autre utilisateur utilise d&eacute;j&agrave; l\'adresse mail que vous d&eacute;sirez utiliser.';
					}
				}
				else
				{
					//Sinon, on dit que lemail nest pas valide
					$form = true;
					$message = 'L\'email que vous avez entr&eacute; n\'est pas valide.';
				}
			}
			else
			{
				//Sinon, on dit que le tel n est pas valide
				$form = true;
				$message = 'Le numero de telephone que vous avez entr&eacute; n\'est pas valide. Il doit etre de 10 chiffres.';
			}
		}
		else
		{
			//Sinon, on dit que le mot de passe nest pas assez long
			$form = true;
			$message = 'Le mot de passe que vous avez entr&eacute; contient moins de 6 caract&egrave;res.';
		}
	}
	else
	{
		//Sinon, on dit que les mots de passes ne sont pas identiques
		$form = true;
		$message = 'Les mots de passe que vous avez entr&eacute;s ne sont pas identiques.';
	}
}
else
{
	$form = true;
}
if($form)
{
	//On affiche un message sil y a lieu, et on affiche le formulaire
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}

?>
<section class="contenu">
<h2>Tu veux participer ?</h2>

<div class="content"  id="formulaire_inscription">
    <form action="inscription.php" method="post">
    	<div>
            <label for="prenom">Pr&eacute;nom *</label>	<input type="text" name="prenom" required class="form_align" placeholder="Georges" value="<?php echo $_POST['prenom']; ?>"/><br />
            <label for="nom">Nom *</label>		<input type="text" name="nom" required  class="form_align" placeholder="d'Artichaut" value="<?php echo $_POST['nom']; ?>"/><br />
            <label for="password">Mot de passe *<span class="small">(6 caract&egrave;res min.)</span></label>
            									<input type="password" name="password" required  class="form_align"/><br />
            <label for="passverif">Mot de passe *<span class="small">(v&eacute;rification)</span></label>
            									<input type="password" name="passverif" required  class="form_align"/><br />
            <label for="date_naissance">Date de Naissance (aaaa-mm-jj)</label>
            									<input type="date" name="date_naissance"  class="form_align" placeholder="1990-06-04" value="<?php echo $_POST['date_naissance']; ?>"/><br />
            <label for="email">Email *</label>	<input type="email" name="email" required  class="form_align" placeholder="adresse@domaine" value="<?php echo $_POST['email']; ?>"/><br />
    	</div>
    	<div>
            <label for="adresse">Adresse</label>
            									<input type="number" name="adresse1" size="3" placeholder="54" value="<?php echo $_POST['adresse1']; ?>"/>,
            									<input type="text" name="adresse2" placeholder="rue d'Assas" value="<?php echo $_POST['adresse2']; ?>"/><br/>
            									<input type="number" name="adresse3" size="5" placeholder="75006" value="<?php echo $_POST['adresse3']; ?>"/><br/>
            									<input type="text" name="adresse4" placeholder="Paris" value="<?php echo $_POST['adresse4']; ?>"/><br />
    	</div>
    	<div>
            <label for="tel">Tel *</label>		<input type="tel" name="tel" required class="form_align" placeholder="0612345678" value="<?php echo $_POST['tel']; ?>"/><br />
            <label for="ecole">Ecole *</label>	
<?php
												include("../pages/liste_ecoles.php");	
?>
				<select style="width : 200px;" name="ecole">
						<option title="Choisis ton &eacute;cole" value="Modifie ton &eacute;cole !">Choisis ton &eacute;cole</option><br/>
					<optgroup label="Autre">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_autre) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_autre[$i].'" value="'.$liste_ecoles_autre[$i].'">'.$liste_ecoles_autre[$i].'</option><br/>';	
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Ecoles d'ing&eacute;nieur">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_ingenieur) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_ingenieur[$i].'" value="'.$liste_ecoles_ingenieur[$i].'">'.$liste_ecoles_ingenieur[$i].'</option><br/>';	
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Universit&eacute;s">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_universites) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_universites[$i].'" value="'.$liste_ecoles_universites[$i].'">'.$liste_ecoles_universites[$i].'</option><br/>';	
			}
?>
					</optgroup>
					<optgroup label=""></optgroup>
					<optgroup label="Ecoles de commerce">
<?php
			for($i=0 ; $i < sizeof($liste_ecoles_commerce) ; $i ++)
			{
				echo '<option title="'.$liste_ecoles_commerce[$i].'" value="'.$liste_ecoles_commerce[$i].'">'.$liste_ecoles_commerce[$i].'</option><br/>';	
			}
?>
					</optgroup>

				</select>
       </div>
            <input type="submit" value="Cr&eacute;er" id="creer_profil" />
    </form>
            <p>* : Information obligatoire</p>
</div>

</section>
<?php

}
}

?>




<!-- Bas de page -->
			<?php include("../ajouts/foot_inscription.php"); ?>

</body>
</html>