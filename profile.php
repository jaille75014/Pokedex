<?php 
    session_start(); // Démarrer la session

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['email'])) {
        header('location: connexion.php?messageError=Monsieur Sombié arretez de hacker notre site svp !');
        exit;
    }

    include("includes/db.php");


    // Requête pour récupérer les informations de l'utilisateur
    $q = 'SELECT id,pseudo, image, email FROM users WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute(['email' => $_SESSION['email']]);
    $user_info = $req->fetch(PDO::FETCH_ASSOC);

    // Vérifier si des informations ont été trouvées
    if (!isset($user_info)) {
        echo "Aucune information trouvée pour cet utilisateur.";
        exit;
    }

    $q2='SELECT name,pv,attack,defense,speed,image FROM pokemons WHERE id_user = ? ;';
    $req2= $bdd->prepare($q2);
    $req2->execute([
        $user_info['id']
    ]);
    $pokemons = $req2->fetchAll(PDO::FETCH_ASSOC);
    
    

?>

<!DOCTYPE html>
<html>

    <?php 
        $titre="Mon compte";
        include("includes/head.php") ;
    ?>    
    
    <body>

        <?php include("includes/header.php") ?>

        <main>
            <div class="container">

                

                <h1>MON COMPTE</h1>

                <h2>Mes infos</h2>

                <p><span class="gras">Pseudo:</span> <?= $user_info['pseudo'] ?></p>
                <p><span class="gras">Email:</span> <?= $user_info['email'] ?></p>
                <figure>
                    <figcaption><p><span class="gras">Image de profil:</span> </p></figcaption>
                    <img class="img_profile" src="assets/uploads/<?=$user_info['image']?>" alt="Image de profil">
                </figure>
                

                <hr>
                <h2>Mes pokemons</h2>
                    <div class="pokemon">
                        <?php 
                        foreach($pokemons as $pokemon){
                            echo '
                            <figure>
                                <figcaption>
                                    <ul class="ul_profile">
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
        </main>
        

        <?php include("includes/footer.php") ?>

        

    </body>
</html>