<?php 
    session_start(); // Démarrer la session

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['email'])) {
        header('location: connexion.php?messageError=Monsieur Sombié arretez de hacker notre site svp !');
        exit;
    }

    include("includes/db.php");


    // Requête pour récupérer les informations de l'utilisateur
    $q = 'SELECT pseudo, image, email FROM users WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute(['email' => $_SESSION['email']]);
    $user_info = $req->fetch(PDO::FETCH_ASSOC);

    // Vérifier si des informations ont été trouvées
    if (!$user_info) {
        echo "Aucune information trouvée pour cet utilisateur.";
        exit;
    }
?>

<!DOCTYPE html>
<html>

    <?php 
        $titre="Mon compte";
        include("includes/head.php") ;
    ?>    
    
    <body>

        <?php include("includes/header.php") ?>

        <h1>MON COMPTE</h1>

        <h3>Mes infos</h3>

        <p><strong>Pseudo:</strong> <?= $user_info['pseudo'] ?></p>
        <p><strong>Email:</strong> <?= $user_info['email'] ?></p>
        <p><strong>Image de profil:</strong> <img src="<?= $user_info['image'] ?>" alt="Image de profil"></p>

        <hr>

    </body>
</html>