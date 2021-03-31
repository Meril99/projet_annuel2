<?php
session_start();


// require('src/log.php');
require('index.php');

if (!empty($_POST['email']) && !empty($_POST['password'])) {
 	
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	/*SYNTAXE ADRESSE MAI verifier si adresse mail bien écriteL*/
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	header('location:login.php?error=1&message=Votre adresse email est invalide.');
    	exit();
    }

    $password = "ad4".sha1($password."1254")."45";

    /*EXISTE IL QQN AVEC CETTE ADRESSE MAIL*/
    $req = $db->prepare("SELECT count(*)  as numbermail FROM 21810784_dev.user WHERE email = ?");
    $req->execute(array($email));

    while ($email_verification = $req->fetch()) {
			if ( $email_verification['numbermail'] != 1) {
				header('location:login.php?error=1&message=Inscrivez vous.');
				exit();
			} 
	}

	/*CONNEXION*/
	$req = $db->prepare("SELECT *  FROM 21810784_dev.user WHERE email = ? ");
	$req->execute(array($email));
    while ($usermail = $req->fetch()) {
			if ( $password == $usermail['password'] && $usermail['blocked']==0  ) {
				
				$_SESSION['connect'] = 1; // savoir si utilisateur connecté ou pas
				$_SESSION['email'] = $usermail['email'];
               // $_SESSION['pseudo'] = $user['pseudo'];

				// /*CONNEXION AUTOMATQIE AVEC SYSTEME DE COOKIES*/
				// if (isset($_POST['auto'])) { /// si checkbox a été cochée
				// 	setcookie('auth', $usermail['secret'], time() + 365*24*3600, '/', 'null', 'false', 'true');
				// 	# code...
				// }


				header('location:login.php?success=1&message=Vous etes maintenant connecter.');
				exit();
			}
			else{
				header('location:login.php?error=1&message=Impossible de vous authentifier correctement.');
                exit();
			}
	}













} 

 ?>



<!DOCTYPE html>
<html>
<head>
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
                                         <li><a href="lille.html">Lille LOSC</a></li> 
                                         <li><a href="psg.php">PSG</a></li> 
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
  <divs>
		<div id="login-body">

			
			<h1>S'identifier</h1>

            <!-- on affiche les messages d'erreurs liés à l'echec de connexion -->
			<?php
				if (isset($_GET['error'])) {
					if (isset($_GET['message'])) {
						echo '<div >'.htmlspecialchars($_GET['message']).' <form method="post" action="login.php">
						<input type="email" name="email" placeholder="Votre adresse email" required />
						<input type="password" name="password" placeholder="Mot de passe" required />
						<button type="submit">S\'identifier</button>
						<label id="option"><input type="checkbox" name="auto"  />Se souvenir de moi</label>'.'</div>';}
                    else {
                        ?>

                        <form method="post" action="login.php">
						<input type="email" name="email" placeholder="Votre adresse email" required />
						<input type="password" name="password" placeholder="Mot de passe" required />
						<button type="submit">S'identifier</button>
						<label id="option"><input type="checkbox" name="auto"  />Se souvenir de moi</label>
					</form>
					<?php } 
                } 
                elseif (isset($_GET['success'])) {
                    echo 'Vous êtes bien connecté';
                    echo '<a href="logout.php"> Déconnexion </a>';
                }
                elseif (isset($GET['connect'])) {
                    echo ' Vous êtes déjà connecté ! Qui sera le top joueur du mois ? ' ;
                    echo '<a href="logout.php"> Déconnexion </a>';


                }
                else {
			?>

            <form method="post" action="login.php">
			<input type="email" name="email" placeholder="Votre adresse email" required />
			<input type="password" name="password" placeholder="Mot de passe" required />
			<button type="submit">S'identifier</button>
			<label id="option"><input type="checkbox" name="auto"  />Se souvenir de moi</label>
			</form> <?php } ?>

					
				

			</div>
		</section>

	</body>
	</html>