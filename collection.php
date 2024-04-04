<?php
session_start(); // Démarrer la session
include("includes/db.php");

$q = 'SELECT name, pv, attack, defense, speed, image FROM pokemons';

if(isset($_GET['tri'])) {
    $tri = $_GET['tri'];
    if ($tri == 'pv' || $tri == 'attack') {
        $q .= ' ORDER BY ' . $tri;
    }
}

$req = $bdd->prepare($q);
$req->execute();
$pokemons = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

    <?php 
    $titre="Collection";
    include("includes/head.php");
    ?>

    <body>

        <?php include("includes/header.php") ?>

        <h1>TOUS LES POKÉMONS</h1>

        <ul>
            <?php foreach ($pokemons as $pokemon): ?>
                <li>
                    Nom: <?= $pokemon['name'] ?><br>
                    PV: <?= $pokemon['pv'] ?><br>
                    Attaque: <?= $pokemon['attack'] ?><br>
                    Défense: <?= $pokemon['defense'] ?><br>
                    Vitesse: <?= $pokemon['speed'] ?><br>
                    Image: <img src="assets/uploads/<?= $pokemon['image'] ?>" alt="Image de <?= $pokemon['name'] ?>" style="max-width: 200px; max-height: 200px;"><br>
                </li>
            <?php endforeach; ?>
        </ul>

        <form method="GET">
            <label for="tri">Trier par:</label>
            <select name="tri" id="tri">
                <option value="pv">PV</option>
                <option value="attack">Attaque</option>
            </select>
            <button type="submit">Trier</button>
        </form>

    </body>
</html>