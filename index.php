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

			<div class="container">

                <h1>BIENVENUE SUR LE POKEDEX DE L'ESGI</h1>

                <img src="assets/images/pikachu.png" alt="Pikachu" onclick="lancer_son();">
                <script src="JS/script.js"></script>

			</div>
		
        </main>
        <?php include("includes/footer.php") ?>
    </body>

</html>