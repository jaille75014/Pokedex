<?php 
    session_start();
    if (isset($_SESSION['email'])){
        header('location:index.php'); // Redirection vers l'accueil
        exit;
    }
?>

<!DOCTYPE html>
<html>

    <?php 
        $titre="Connexion";
        include("includes/head.php") ;
    ?>

	<body>

		<?php include("includes/header.php") ?>

		<main>

            <h1> <?= $titre ?> </h1>

            <div class="container">

                <!-- Formulaire connexion -->
                <div class="form-container form-connexion" >
                    <h3>Je possède un compte</h3>
                    <form method="post" action="back/verif_connexion.php">
                        <div>
                            <input type="email" name="email" placeholder="Email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email']:''; ?> ">
                        </div>
                        <div>
                        <input type="password" name="password" placeholder="Votre mot de passe ">
                        </div>
                        <input type="submit" value="Connexion">
                    </form>
                </div>

                <!-- Formulaire inscription -->
                <div class="form-container form-inscription">
                    <h3>Je crée un compte</h3>
                    <form method="post" action="back/verif_inscription.php" enctype="multipart/form-data">
                        <div>
                            <input type="text" name="pseudo" placeholder="Pseudo">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email']:''; ?> ">
                        </div>
                        <div>
                            <input type="password" name="password" placeholder="Mot de passe ">
                        </div>
                        <div>
                            <label for="image">Image de profil :</label>
                            <input type="file" name="image" accept="image/png, image/jpeg, image/gif">
                        </div>
                        <button type="submit">Inscription</button>
                    </form>
                </div>

            </div>

        </main>

        <?php include("includes/footer.php") ?>

    </body>

</html>