<?php 
// Déterminer les identifiants de connexions en fonction du nom de la db
$host=$_SERVER['SERVER_NAME']=='localhost'?'localhost:3306':'hoteDeProd';
$user=$_SERVER['SERVER_NAME']=='localhost'?'root':'zkpoekf';
$mdp=$_SERVER['SERVER_NAME']=='localhost'?'root':'zdazzadqsdqd';
$arg=$_SERVER['SERVER_NAME']!='localhost'?[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]:[];

try {
    $bdd=new PDO('mysql:host='.$host.';dbname=pokedex',$user,$mdp,$arg);
} catch (Exception $e){
    die('Erreur : '. $e->getMessage());
}
?>