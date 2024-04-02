<?php 
    session_start();
    // Vérifier si l'utilisateur n'est pas connecté
    if (!isset($_SESSION['email'])) {
        header('location: connexion.php'); // Redirection vers "connexion.php"
        exit;
    }
?>

<!DOCTYPE html>
<html>

    <?php 
        $titre="Ajouter un Pokemon";
        include("includes/head.php") ;
    ?>

	<body>

		<?php include("includes/header.php") ?>

		<main>

            <h1> <?= $titre ?> </h1>

            <div class="container">

                <!-- Formulaire inscription -->
                <div class="form-container add-pokemon">
                    <form method="post" action="back/verif_pokemon.php" enctype="multipart/form-data">
                        <div>
                            <input type="text" name="name" placeholder="Nom">
                        </div>
                        <div>
                            <input type="text" name="pv" placeholder="PV">
                        </div>
                        <div>
                            <input type="text" name="attack" placeholder="Attaque">
                        </div>
                        <div>
                            <input type="text" name="defense" placeholder="Défense">
                        </div>
                        <div>
                            <input type="text" name="speed" placeholder="Vitesse">
                        </div>
                        <div>
                            <label for="image">Image :</label>
                            <input type="file" name="image" accept="image/png, image/jpeg, image/gif">
                        </div>
                        <button type="submit">Ajouter</button>
                    </form>
                </div>

            </div>

        </main>

        <?php include("includes/footer.php") ?>

    </body>

</html>