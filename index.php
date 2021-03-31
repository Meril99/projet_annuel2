<?php

const MYSQL_HOST = 'mysql.info.unicaen.fr'; // Votre hôte. (local = 127.0.0.1, fac = mysql.info.unicaen.fr)
const MYSQL_PORT = 3306; // par défaut MySQL = 3306 MariaDB = 3307
const MYSQL_DB = '21810784_dev'; // Votre database. (à vous de savoir à partir d'ici en fonction de votre config).
const MYSQL_USER = '21810784'; // Votre nom utilistateur.
const MYSQL_PASSWORD = 'Ciithoh1Fohyeijo'; // Votre mot de passe.


/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
try{
    $db = new PDO('mysql:host='.MYSQL_HOST.';port='.MYSQL_PORT.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASSWORD);
}catch(Exception $e){
    echo"Pdo exception ". $e; 
}


?>