<?php
session_start(); 
include("includes/db.php");


$q = 'SELECT name, pv, attack, defense, speed, image FROM pokemons';

if(isset($_GET['tri'])) {
    $tri = $_GET['tri'];
    if ($tri == 'pv' || $tri == 'attack') {
        $q .= ' ORDER BY ' . $tri . ' ASC';
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

        <div class="container">
            

            <h1>TOUS LES POKÉMONS</h1>

            <form method="GET" class="centre">
                <label for="tri" class="trier_par">Trier par :</label>
                <select name="tri" class="barre">
                    <?php if(!isset($_GET['tri'])||empty($_GET['tri'])) {
                    ?>
                    <option value="pv">PV</option>
                    <option value="attack">Attaque</option>
                    <?php } else {?>
                        <option value="pv" <?= $_GET['tri']=='pv'?'selected="select"':''; ?>>PV</option>
                        <option value="attack" <?= $_GET['tri']=='attack'?'selected="select"':''; ?>>Attaque</option>
                    <?php } ?>

                </select>
                <button type="submit" class="trie">Trier</button>
            </form>



            <div class="pokemon">
                    <?php 
                    foreach($pokemons as $pokemon){
                        echo '
                        <figure class="figure_pokemon">
                            <figcaption>
                                <ul class="ul_pokemon">
                                    <li><h3>'.$pokemon['name'].'</h3></li>
                                    <li>PV : '.$pokemon['pv'].'</li>
                                    <li>Attaque : '.$pokemon['attack'].'</li>
                                    <li>Défense : '.$pokemon['defense'].'</li>
                                    <li>Vitesse : '.$pokemon['speed'].'</li>
                                        
                                </ul>
                            </figcaption>
                            <img class="image_pokemon" alt="image pokemon" src="assets/uploads/'.$pokemon['image'].'">
                        
                            
                        </figure>';
                    }
                
                
                    ?>
                </div>

            

        
        </div>
        <?php include("includes/footer.php") ?>

    </body>
</html>