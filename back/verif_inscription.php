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
        || empty ($_POST['password'])) {
            header("location: ../connexion.php?message=Vous devez remplir les 2 champs !" ); // Redirection vers connexion.php
            exit; //Interrompt le code
        }

    // Si email invalide > redirection vers le formulaire avec un paramètre get "message" : "email invalide"
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        header('location: ../connexion.php?message=Email invalide !'); 
        exit;
    }
    
    // Vérification de la longueur du mot de passe
    if (strlen($_POST['password']) < 8){
        header('location: ../connexion.php?message=Votre mot de passe doit faire 8 caractères minimum dont une majuscule, une minuscule et un chiffre !'); 
        exit;
    }

    // Vérification de la présence d'au moins une majuscule, une minuscule et un chiffre
    if (!preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[a-z]/', $_POST['password']) || !preg_match('/[0-9]/', $_POST['password'])) {
        header('location: ../connexion.php?message=Votre mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre !'); 
        exit;
    }


    // Si on arrive ici, c'est que tout est ok ! 
    // Inscription de l'utilisateur dans la BDD

    //Connexion à la BDD
    include("../includes/db.php");


    // Si l'email est déja utilisé alors redirection

    $q = 'SELECT id FROM users WHERE email=:email';
    $req = $bdd->prepare($q);
    $req->execute(['email' => $_POST['email']]);
    $results = $req->fetchAll();
    if (!empty($results)) {
        header('location: ../connexion.php?message=Email déjà utilisé !'); 
        exit;
    }


    // Vérification du fichier reçu
    if($_FILES['image']['error']!=4){ // Si un fichier a été uploadé

        // Vérification de son type
        $acceptable=['image/png','image/jpeg','image/gif'];
        if(!in_array($_FILES['image']['type'],$acceptable)){ // Permet de savoir si une valeur est dans un tableau, renvoie true si c'est le cas et non si ce n'est pas le cas
            header('location: ../connexion.php?message=Le fichier doit être un jpeg, png ou gif, ne manipule pas mon code !&type=danger'); 
            exit;
        }

        $maxSize = 1024;
        if($_FILES['image']['size'] > $maxSize){ //  On vérifie si la taille est supérieure à 1Mo
            header('location: ../connexion.php?message=Le fichier doit être inférieur à 1Mo !'); 
            exit;
        }

        if(!file_exists('../assets/uploads')){  // Permet de savoir si un fichier / dossier existe, renvoie true si il existe
            mkdir('../assets/uploads'); // Crée le fichier uploads 
        }
    
        // Enregistrement du fichier sur le serveur
        $from=$_FILES['image']['tmp_name']; // Enplacement temporaire du fichier

        $array=explode('.',$_FILES['image']['name']); //Transformer une chaîne de caractère selon un séparateur, fonction implode() pour concaténer des éléments d'un tableau selon un séparateur
        $ext=end($array); // Récupérer le dernier élément du tableau
        $fileName='image-'.time().'.'.$ext;
        // Risque de doublon si 2 personnes s'inscrit à la même seconde avec la même extension


        $to='asset/uploads/'.$fileName; // Nom original du fichier
        move_uploaded_file($from,$to);

    }

    
    //Salage du mdp
    $salt="ViveL3ProJetDeW3B!:;<3";
    $mdp_salt=$_POST['password'].$salt;
    $passHash= hash('sha256',$mdp_salt);


    // Création de la requête SQL
    $q= 'INSERT INTO users (pseudo, email, password, image) VALUES (:pseudo, :email, :password, :image)';
    $req=$bdd->prepare($q);
    $result=$req->execute([
        'pseudo'=>$_POST['pseudo'],
        'email'=>$_POST['email'], 
        'password'=>$passHash,
        'image'=>isset($fileName)?$fileName : 'default.svg'
        ]);

    if ($result){
        header('location: ../connexion.php?message=Votre compte a bien été créé, veuillez vous connecter !');
        exit;
    } else {
        header('location: ../connexion.php?message=Erreur lors de la création du compte, veuillez recommencer !');
        exit;
    }



?>