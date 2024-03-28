<?php 

$id_user = $_SESSION['user_id'];

// Vérifier si tous les champs du formulaire sont remplis
if(empty($_POST['name']) || empty($_POST['pv']) || empty($_POST['attack']) || empty($_POST['defense']) || empty($_POST['speed']) || empty($_FILES['image']['name'])) {
    header("location: ../add_pokemon.php?message=Vous devez remplir tous les champs !");
    exit; //Interrompt le code
}

include("../includes/db.php");

// Vérifier si le nom du Pokémon est déjà utilisé
$q = 'SELECT id FROM pokemons WHERE name=:name';
$req = $bdd->prepare($q);
$req->execute(['name' => $_POST['name']]);
$results = $req->fetchAll();
if (!empty($results)) {
    header('location: ../add_pokemon.php?message=Nom déjà utilisé !'); 
    exit;
}

// Vérification du fichier reçu
if($_FILES['image']['error'] != 4) { // Si un fichier a été uploadé

    // Vérification de son type
    $acceptable = ['image/png', 'image/jpeg', 'image/gif'];
    if(!in_array($_FILES['image']['type'], $acceptable)) {
        header('location: ../add_pokemon.php?message=Le fichier doit être un jpeg, png ou gif, ne manipule pas mon code !&type=danger'); 
        exit;
    }

    $maxSize = 5 * 1024 * 1024; // Taille maximale autorisée : 5 Mo
    if($_FILES['image']['size'] > $maxSize) { 
        header('location: ../add_pokemon.php?message=Le fichier doit être inférieur à 5Mo !'); 
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
    'id_user' => $id_user,
    'name' => $_POST['name'],
    'pv' => $_POST['pv'], 
    'attack' => $_POST['attack'], 
    'defense' => $_POST['defense'], 
    'speed' => $_POST['speed'],
    'image' => $fileName // Sauvegardez le nom du fichier dans la base de données
]);

if ($result) {
    header('location: ../add_pokemon.php?message=Votre pokemon a bien été créé !');
    exit;
} else {
    header('location: ../add_pokemon.php?message=Erreur lors de la création du pokemon, veuillez recommencer !');
    exit;
}
?>