<?php 
    session_start(); 
    include('includes/db.php');
    //lknrveklvn
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
                <img src="assets/images/pikachu.png" alt="Pikachu" title="Clique !" width="37%" onclick="lancer_son();">
                </div>
                <h1>BIENVENUE SUR LE POKEDEX DE L'ESGI</h1>
                <script src="JS/script.js"></script>

			</div>
		
        </main>
        <?php include("includes/footer.php") ?>
    </body>

</html>