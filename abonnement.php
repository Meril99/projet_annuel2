<?php 
session_start();



require('index.php');
// require('src/log.php');


	/*ENVOI FORMULAIRE*/
	if (!empty($_POST['email']) && !empty($_POST['password']) 
	&& !empty($_POST['password_two'])  && !empty($_POST['IBAN']) && !empty($_POST['expiration']) && !empty($_POST['CVC'])  ) {


		// SECURISER LES DONNEES RECUPEREES
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$password_two = htmlspecialchars($_POST['password_two']);
		$IBAN = htmlspecialchars($_POST['password_two']);
		$expiration = htmlspecialchars($_POST['expiration']);
		$CVC = htmlspecialchars($_POST['CVC']);


		/*TEST MDP identiques*/
		if ($password != $password_two) {
			header('location:abonnement.php?error=1&message=Les deux mots de passe sont pas identiques !');
			exit();
		}

		// ADRESSE EMAIL SYNTAXE(valide ou pas)
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	header('location:abonnement.php?error=1&message=Votre adresse email est invalide.');
    	exit();
    	}

    	/*ADRESSE MAIL DEJA UTILISEE*/

		// compter le nombre de fois où l'email est dans la base de donnée


    	$req = $db->prepare("SELECT COUNT(*) as numberEmail FROM 21810784_dev.user WHERE email = ?");
    	$req->execute(array($email));


		// récupérer les lignes de notre requête
		// on sera redirigé autiomatiquement si email déjà en bdd
    	while ($user_data = $req->fetch()) {
			if ($user_data['numberEmail'] != 0 ) {
				header('location:abonnement.php?error=1&message=Adresse email déjà prise.');
				exit();
			}
		}

		/*HASH*/
		// securiser les mdp etc
		$secret = sha1($email).time();
		$secret = sha1($secret).time().time();

		/*CRYPTAGE MDP*/
		$password = "ad4".sha1($password."1254")."45";

		/*ENVOIE DE LA REQUÊTE */				
		$req = $db->prepare('INSERT INTO 21810784_dev.user(email,password,secret, IBAN, expiration, CVC) VALUES(? , ?, ?, ?, ?, ?)');
				
		$req->execute(array($email, $password, $secret, $IBAN, $expiration, $CVC));

		header('location: abonnement.php?success=1');
		exit();
		}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>TOPLIGUE1</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<!-- Place favicon.ico in the root directory -->
		<link rel="shortcut icon" type="image/x-icon" href="images/fav.png">    
		<!-- bootstrap v3.3.6 css -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- font-awesome css -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- animate css -->
		<link rel="stylesheet" href="css/animate.css">
		<!-- Main Menu css -->
		<link rel="stylesheet" href="css/rsmenu-main.css">
		<!-- rsmenu transitions css -->
		<link rel="stylesheet" href="css/rsmenu-transitions.css">
		<!-- hover-min css -->
		<link rel="stylesheet" href="css/hover-min.css">
		  <!-- magnific-popup css -->
		<link rel="stylesheet" href="css/magnific-popup.css">
		<!-- owl.carousel css -->
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/time-circles.css">
		<!-- Slick css -->
		<link rel="stylesheet" href="css/slick.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
		<link rel="stylesheet" href="css/responsive.css">
</head>
   <body class="home-two">
  
        <!-- le header avec le menu et les icônes -->
		<header>
			<div class="header-top-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="header-top-left">                            
								<ul>
									<li><a href="mailto:topligue1@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> topligue1@gmail.com</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="social-media-area">
								<nav>
									<ul>
										<li><a href="#" class="active"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <sup>1</sup></a></li>
										<li class="log"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li> 
										<li class="sign"><a href="abonnement.php"><span>/</span> Sign Up</a></li>
										<li class="sign"><a href="logout.php"><span>/</span> Logout</a></li>

									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-middle-area menu-sticky">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-md-10 col-sm-12 col-xs-12 mobile-menu">
                            <div class="main-menu">
                                <a class="rs-menu-toggle"><i class="fa fa-bars"></i>Menu</a>
                                <nav class="rs-menu">
                                    <ul class="nav-menu">
                                
									
                                        <!-- Drop Down Clubs -->
                                        <li class="menu-item-has-children">
                                            <a href="#">Club List</a>
                                            <ul class="sub-menu">
											<li><a href="psg.php">PSG </a></li> 

                                               <li><a href="lille.html">Lille LOSC</a></li> 
                                               <li><a href="ol.html">Olympique Lyonnais OL</a></li> 
                                               <li><a href="om.html">Olympique de Marseille OM</a></li> 
                                            </ul>
                                        </li>
                                         <!-- Drop Down -->
                                        

                                       
                                        <!-- Classement & resultats -->
                                        <li><a href="point-table.html">Classement actuel</a></li> 

                                        <li><a href="result.html">Résultats</a>

										<li><a href="psg.php">Home</a>

                                        
                                        </li>

                                        

                                    </ul>
                               </nav>
                            
                           </div>
                       </div>
                    </div>
                </div>
            </div>
		</header>
		<!-- fin du header-->
	<section>
		<div id="login-body">
			<h1>S'abonner</h1>

			<?php
			// si variable erreru existe dans adresse url
			if (isset($_GET['error'])) {
				// si la variable message existe
				if (isset($_GET['message'])) {
					echo '<div class=" alert error ">'.htmlspecialchars($_GET['message']).'</div>';
				}
			}
			if (isset($_GET['success'])) {
					echo '<div class=" alert success ">'.'Bienvenue !'.'</div>';
				
			}
			?>
	
			<?php /*Si utilisateur déjà connecté, empêcher qu'il accède à page d'inscription*/
				if (isset($_SESSION['connect'])) {
					echo " Vous êtes connecté et déjà inscrit avec cet email ! "; } else { ?>
						<form method="post" action="abonnement.php" id="register_form">
							<input type="email" name="email" placeholder="Votre adresse email" required />
							<input type="password" name="password" placeholder="Mot de passe" required />
							<input type="password" name="password_two" placeholder="Retapez votre mot de passe" required />
							<input type="text" name="IBAN" placeholder="Numéro de carte sans espaces" required />
							<input type="text" name="expiration" placeholder="month/year" required />
							<input  name="CVC" placeholder="CVC" required />
							<button type="submit" id="submit_register">S\'abonner</button>'
						</form>
						<p class="grey">'.'Accédez à notre contenu exclusif pour encore plus de top actualité ! Ou sinon : '.'<a href="login.php">Connectez-vous</a></p> 
				<?php	 } ?>
		</div>
	</section>

		<!-- Start scrollUp  -->
		<div id="return-to-top">
			<span>Top</span>
		</div>
		<!-- End scrollUp  -->

		<!-- all js here -->
		<!-- jquery latest version -->
		<script src="js/jquery.min.js"></script>
		<!-- Menu js -->
		<script src="js/rsmenu-main.js"></script> 
		 <!-- jquery-ui js -->
		<script src="js/jquery-ui.min.js"></script>
		<!-- bootstrap js -->
		<script src="js/bootstrap.min.js"></script>
		<!-- meanmenu js -->
		<script src="js/jquery.meanmenu.js"></script>
		<!-- wow js -->
		<script src="js/wow.min.js"></script>
		<!-- Slick js -->
		<script src="js/slick.min.js"></script>
		<!-- masonry js -->
		<script src="js/masonry.js"></script>
		<!-- magnific-popup js -->
		<!-- owl.carousel js -->
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/time-circle.js"></script>
		<!-- magnific-popup js -->
		<script src="js/jquery.magnific-popup.js"></script>
		<!-- main js -->
		<script src="js/main.js"></script>
</body>

</html>