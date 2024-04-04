<?php 
    session_start(); 
    include('includes/db.php');
?>

<!DOCTYPE html>
<html>

    <?php 
        $titre="Accueil";
        include("includes/head.php") ;
    ?>

	<body>

		<?php include("includes/header.php") ?>

		<main>
            <div class="center">
                <img src="assets/images/pikachu.png" alt="Pikachu_image" id="pikachu" title="Appuyez sur Pikachu en mettant votre son au maximum !" onclick="lancer_son()";>
            </div>
            
                
            <h1>Bienvenue sur le pokedex de l'esgi</h1>

		
        <script src="JS/script.js"></script>
        </main>
        <?php include("includes/footer.php") ?>
    </body>

</html>