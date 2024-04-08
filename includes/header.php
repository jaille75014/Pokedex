<header>
    <nav>
        <div class="containerHeader">

        <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo.png" alt="logo_pokedex">
        </a>

            <ul>

                <li><a href="index.php">Accueil</a></li>
                <li><a href="collection.php">Collection</a></li>

                <?php 
                    if (!isset($_SESSION['email'])){
                        echo '<li><a href="connexion.php">Connexion</a></li>';

                    }else {
                        echo '<li><a href="add_pokemon.php">Ajouter Pokemon</a></li>';
                        echo '<li><a href="profile.php">Mon compte</a></li>';
                        echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
                    }
                ?>
                
            </ul>

        </div>
    </nav>

</header>