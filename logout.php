<?php


session_start(); // initialise la session (id unique dans notre cookie pour pouvoir utiliser les variables de session) on veut detruire les variables de session lié à ce numero
session_unset();  // desactive la session
session_destroy(); //détruit la session


header('location: psg.php');
exit();


