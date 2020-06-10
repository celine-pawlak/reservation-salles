<?php
$page_selected = "index";
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=yes"/>
        <link rel="stylesheet" href="fa.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
          <?php include("header.php");
            $errors = [];
            
            if (isset($_SESSION['login'])){
            echo'
                <div>
                    <h1>Bienvenue ' .$_SESSION['login'].'</h1>
                </div>
                <div>
                    
                </div>
                
                ';
        }else{
            echo"
                <div>
                    <h1>
                        Inscrivez-vous pour accéder à l'espace réservation. 
                    </h1>
                </div>
                <div class='index-button'>
                    <a id='connex-button' href='connexion.php'>Se connecter</a>
                    <a id='inscri-button' href='inscription.php'>S'inscrire</a>
                </div>
                ";
        }
            ?>

        </header>
        <main>
            <div class="content">
                <?= renderErrors($errors) ?>
            </div>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>
