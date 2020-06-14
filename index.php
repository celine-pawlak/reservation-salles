<?php
$page_selected = "index";
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=yes"/>
        <link rel="stylesheet" href="styles/css/main.css">
        <link rel="stylesheet" href="styles/css/style.css">
        <script src="https://kit.fontawesome.com/217c9d0a4d.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
          <?php include("header.php");
            $errors = [];
        
            ?>
            <section class='banniere'>
                <i class='fas fa-heart-circle'></i><h1>Roomy</h1>
            </section>
            
        </header>
        <main>
            <div class="content">
                <?= renderErrors($errors) ?>
            </div>
            
            
            
            <?php
    
            if(isset($_SESSION['user'])){
                $user = $_SESSION['user'];
            echo"

                <section class='column'>
                    <h2> Bonjour Machin, sélectionnez la salle idéale pour votre événement </h2><br>
                    <section class='ligne'>
                        <div class='card'>
                            <div class='image'>
                                <img src='ressources/salle1.jpg' height='250px' alt='salle 1'>
                            </div>
                            <div class='espace'>
                                <h3> Salle de mariage </h3><br>
                                <p>
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. 
                                </p><br>
                                <div class='index-button'>
                                    <a href='planning.php'>Réservation</a>
                                </div>
                            </div> 
                        </div>
                        <div class='card'>
                            <div class='image'>
                                <img src='ressources/salle2.jpg' height='250px' alt='salle 2'>
                            </div>
                            <div class='espace'>
                                <h3> Salle d'anniversaire </h3><br>
                                <p>
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. 
                                </p><br>
                                <div class='index-button'>
                                    <a href='planning.php'>Réservation</a>
                                </div>
                            </div> 
                        </div>
                        <div class='card'>
                            <div class='image'>
                                <img src='ressources/salle3.jpg' height='250px' alt='salle 3'>
                            </div>
                            <div class='espace'>
                                <h3> Salle de conférence </h3><br>
                                <p>
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. 
                                </p><br>
                                <div class='index-button'>
                                    <a href='planning.php'>Réservation</a>
                                </div>
                            </div> 
                        </div>
                </section>
            </section>
                
                ";
        }else{
            echo"
                <section class='column'>
                    <h2>Sélectionnez la salle idéale pour votre événement </h2><br>
                    <section class='ligne'>
                        <div class='card'>
                            <div class='image'>
                                <img src='ressources/salle1.jpg' height='250px' alt='salle 1'>
                            </div>
                            <div class='espace'>
                                <h3> Salle de mariage </h3><br>
                                <p>
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. 
                                </p><br>
                                <div class='index-button'>
                                    <a href='inscription.php'>S'inscrire</a>
                                    <a href='connexion.php'>Se connecter</a>
                                </div>
                            </div> 
                        </div>
                        <div class='card'>
                            <div class='image'>
                                <img src='ressources/salle2.jpg' height='250px' alt='salle 2'>
                            </div>
                            <div class='espace'>
                                <h3> Salle d'anniversaire </h3><br>
                                <p>
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. 
                                </p><br>
                                <div class='index-button'>
                                    <a href='inscription.php'>S'inscrire</a>
                                    <a href='connexion.php'>Se connecter</a>
                                </div>
                            </div> 
                        </div>
                        <div class='card'>
                            <div class='image'>
                                <img src='ressources/salle3.jpg' height='250px' alt='salle 3'>
                            </div>
                            <div class='espace'>
                                <h3> Salle de conférence </h3><br>
                                <p>
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. 
                                </p><br>
                                <div class='index-button'>
                                    <a href='inscription.php'>S'inscrire</a>
                                    <a href='connexion.php'>Se connecter</a>
                                </div>
                            </div> 
                        </div>
                </section>
            </section>
                ";
        }
    
    
            ?>
            
            
            
            
            
            
            
            
            
            
            

        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>
