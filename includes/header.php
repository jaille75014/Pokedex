<header>
    <nav>
        <div class="container">

        <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo.png" alt="Logo Pokedex">
        </a>

            <ul class="navbar">

                <li><a href="index.php">Accueil</a></li>
                <li><a href="collection.php">Collection</a></li>

                <?php 
                    if (!isset($_SESSION['email'])){
                        echo '<li><a href="connexion.php">Connexion / Inscription</a></li>';

                    }else {
                        echo '<li><a href="deconnexion.php">Deconnexion</a></li>';
                        echo '<li><a href="add_pokemon.php">Ajouter Pokemon</a></li>';
                        echo '<li><a href="profile.php">Mon compte</a></li>';
                    }
                ?>
                
            </ul>

        </div>
    </nav>

</header>