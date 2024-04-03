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

			<div class="container_index">
                <div class="centre">
                <img src="assets/images/pikachu.png" alt="Pikachu" onclick="lancer_son();">
                </div>
                <script src="JS/script.js"></script>
                <h1>BIENVENUE SUR LE POKEDEX DE L'ESGI</h1>

			</div>
		
        </main>
        <?php include("includes/footer.php") ?>
    </body>

</html>