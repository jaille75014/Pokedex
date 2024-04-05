<?php 

    // Si un email a été envoyé et n'est pas vide > créer un cookie 'email'
    if (isset($_POST['email'])&& !empty($_POST['email'])){
        setcookie('email', $_POST['email'], time()+30*24*3600); // Cookie expire dans 30 jours
    }

    // Si l'email ou le mot de passe sont inexistants ou vides > redirection vers connexion.php
    // avec un msg dans l'url

    if(!isset($_POST['email'])
        || empty($_POST['email'])
        || !isset($_POST['password'])
        || empty ($_POST['password'])){
            header('location: ../connexion.php?message=Vous devez remplir les 2 champs !'); // Redirection vers connexion.php
            exit; //Interrompt le code
        }

    // Si email invalide > redirection vers le formulaire avec un paramètre get "message" : "email invalide"
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        header('location: ../connexion.php?message=Email invalide !'); 
        exit;
    }
    
    //Si les identifients ne correspondent pas à un utilisateurs alors redirection
    
    // 1- Connexion bdd

    include("../includes/db.php");
    
    $salt="ViveL3ProJetDeW3B!:;<3";
    $mdp_salt=$_POST['password'].$salt;
    $passHash= hash('sha256',$mdp_salt);

    // 2- Requête trou
    $q= 'SELECT id FROM users WHERE email=:email AND password=:password';
    // 3- preparation requête
    $req=$bdd->prepare($q);
    // 4- Executer la requête
    $req->execute([
        'email'=>$_POST['email'], 
        'password'=>$passHash
        ]);
    // 5- Récupérer tout les résultats 
    $results=$req->fetchAll();
    // 6-Si results est vide alors on redirige
    if (empty($results)){
        header('location: ../connexion.php?message=Adresse mail ou mot de passe incorrect !'); 
        exit;
    }


    // Si on arrive ici, c'est que tout est ok ! 
    // Connexions utilisateurs
    // Ouverture ou création d'une session utilisateurs
    session_start();
    $_SESSION['email'] = $_POST['email']; // Ajout d'une clé email et d'une valeur


    // Redirection vers l'accueil 
    header('location: ../index.php?messageSuccess=Vous êtes bien connecté');
    exit;
?>
