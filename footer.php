<?php

mysqli_close($db);

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
    </head>

    <section class="footer">
        <div class="logo">
           <h1>Roomy</h1>
        </div>
        <div class="menu">
            <?php
                if(isset($_SESSION['user'])){
                $user = $_SESSION['user']['login'];
                echo"
                    <ul>
                        <a href='index.php'><li>Accueil</li></a>
                        <a href='planning.php'><li>Planning</li></a>
                        <a href='profil.php'><li>Profil</li></a>
                    </ul>
                ";
                }else{
                    echo"
                    <ul>
                        <a href='index.php'><li>Accueil</li></a>
                        <a href='connexion.php'><li>Connexion</li></a>
                        <a href='inscription.php'><li>Inscription</li></a>
                    </ul>
                    ";
                }
            ?>
        </div>
        <div class="RS">
            <a href="facebook.com"><i class="fab fa-facebook-square"></i></a>
            <a href="instagram.com"><i class="fab fa-instagram-square"></i></a>
            <a href="twitter.com"><i class="fab fa-twitter-square"></i></a>
            <a href="linkedin.com"><i class="fab fa-linkedin"></i></a>
        </div>
    </section>

</html>
