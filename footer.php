<?php

mysqli_close($db);

?>

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
        <ul>
            <li><a href="facebook.com"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="instagram.com"><i class="fab fa-instagram-square"></i></a></li>
            <li> <a href="twitter.com"><i class="fab fa-twitter-square"></i></a></li>
            <li><a href="linkedin.com"><i class="fab fa-linkedin"></i></a></li>
        </ul>
    </div>
</section>
