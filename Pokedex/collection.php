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

        <div class="collection">

            <h1>TOUS LES POKÉMONS</h1>

            <form method="GET" class="centre">
            <label for="tri" class = "trier_par">Trier par :</label>
            <select name="tri" class="barre">
                <option value="pv">PV</option>
                <option value="attack">Attaque</option>
            </select>
            <button type="submit" class="trie">Trier</button>
        </form>

        <ul>
            <?php foreach ($pokemons as $pokemon): ?>
                <li class="flexbox">
                    <img src="assets/uploads/<?= $pokemon['image'] ?>" alt="Image de <?= $pokemon['name'] ?>" style="max-width: 200px; max-height: 200px;">
                    <div class="text">
                        <strong><?= $pokemon['name'] ?></strong><br><br>
                        PV: <?= $pokemon['pv'] ?><br>
                        Attaque: <?= $pokemon['attack'] ?><br>
                        Défense: <?= $pokemon['defense'] ?><br>
                        Vitesse: <?= $pokemon['speed'] ?><br>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        </div>



        

    </body>
</html>