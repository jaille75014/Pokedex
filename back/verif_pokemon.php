<?php 
session_start(); // Démarrer la session

// Vérifier si tous les champs du formulaire sont remplis
if(empty($_POST['name']) || empty($_POST['pv']) || empty($_POST['attack']) || empty($_POST['defense']) || empty($_POST['speed']) || empty($_FILES['image']['name'])) {
    header("location: ../add_pokemon.php?messageError=Vous devez remplir tous les champs !");
    exit; //Interrompt le code
}

if(!is_numeric($_POST['pv'])||!is_numeric($_POST['attack'])||!is_numeric($_POST['defense'])||!is_numeric($_POST['speed'])){
    header("location: ../add_pokemon.php?messageError=Vous devez entrer que des nombres pour PV, Attaque, Défense et Vitesse !");
    exit; //Interrompt le code
}

include("../includes/db.php");

// Selectionner l'id de l'user
$id_user = 'SELECT id FROM users WHERE email=:email';
$req = $bdd->prepare($id_user);
$req->execute(['email' => $_SESSION['email']]);
$result_user = $req->fetch(PDO::FETCH_ASSOC);

// Vérifier si le nom du Pokémon est déjà utilisé
$q = 'SELECT id FROM pokemons WHERE name=:name';
$req = $bdd->prepare($q);
$req->execute(['name' => $_POST['name']]);
$results = $req->fetchAll();
if (!empty($results)) {
    header('location: ../add_pokemon.php?messageError=Nom déjà utilisé !'); 
    exit;
}

// Vérification du fichier reçu
if($_FILES['image']['error'] != 4) { // Si un fichier a été uploadé

    // Vérification de son type
    $acceptable = ['image/png', 'image/jpeg', 'image/gif'];
    if(!in_array($_FILES['image']['type'], $acceptable)) {
        header('location: ../add_pokemon.php?messageError=Le fichier doit être un jpeg, png ou gif, ne manipule pas mon code !&type=danger'); 
        exit;
    }

    $maxSize = 5 * 1024 * 1024; // Taille maximale autorisée : 5 Mo
    if($_FILES['image']['size'] > $maxSize) { 
        header('location: ../add_pokemon.php?messageError=Le fichier doit être inférieur à 5Mo !'); 
        exit;
    }

    if(!file_exists('../assets/uploads')) {
        mkdir('../assets/uploads'); // Créer le répertoire uploads s'il n'existe pas
    }

    // Enregistrement du fichier sur le serveur
    $from = $_FILES['image']['tmp_name']; 
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // Récupérer l'extension du fichier
    $fileName = 'image-' . time() . '.' . $ext; // Nom du fichier avec un timestamp pour éviter les doublons
    $to = '../assets/uploads/' . $fileName;
    move_uploaded_file($from, $to);
}

// Création de la requête SQL pour insérer le Pokémon
$q = 'INSERT INTO pokemons (id_user, name, pv, attack, defense, speed, image) VALUES (:id_user, :name, :pv, :attack, :defense, :speed, :image)';
$req = $bdd->prepare($q);
$result = $req->execute([
    'id_user' => $result_user['id'],
    'name' => $_POST['name'],
    'pv' => $_POST['pv'], 
    'attack' => $_POST['attack'], 
    'defense' => $_POST['defense'], 
    'speed' => $_POST['speed'],
    'image' => $fileName // Sauvegardez le nom du fichier dans la base de données
]);

if ($result) {
    header('location: ../add_pokemon.php?messageSuccess=Votre pokemon a bien été créé !');
    exit;
} else {
    header('location: ../add_pokemon.php?messageError=Erreur lors de la création du pokemon, veuillez recommencer !');
    exit;
}
?>