<?php
$page_selected = "incription";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=yes"/>
        <link rel="stylesheet" href="styles/css/main.css">
        <link rel="stylesheet" href="styles/css/style.css">
    </head>
    <body>
        <header>

          <?php include("header.php");
            
            $errors = [];

            if (isset($_POST['submit'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $mdpcheck = $_POST['mdp-check'];
                $password_modified =  password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

                if ($login && $password && $mdpcheck) {
                    if ($password == $mdpcheck) {
                        $connexion = mysqli_connect('localhost', 'root', '', 'reservationsalles');
                        $requete = "INSERT INTO `reservationsalles`.`utilisateurs` (login,password) VALUES ('$login','$password_modified')";

                        $query = mysqli_query($connexion, $requete);

                        header('location:connexion.php');
                    } else {
                        $errors[] = "Les mots de passe doivent être identiques";
                    }
                } else {
                    $errors[] = "Veuillez saisir tous les champs";
                }
            }

            ?>

        </header>
        <main>
            <div class="content">
             <?= renderErrors($errors)?>
            </div>

            <form class="form-inscription" action="inscription.php" method="post">
                <h1> INSCRIPTION </h1><br/>

                <label for="login">Identifiant</label>
                <input type="text" id="login" name="login" placeholder="Créez votre pseudo"> <br/>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Entrer un mot de passe"> <br />

                <label for="mdp-check">Confirmation mot de passe</label>
                <input type="password" id="mdp-check" name="mdp-check" placeholder="Confirmer le mot de passe"> <br/>

                <div class="button" >
                    <input type="submit" value="VALIDER" name="submit">
                </div>

                <br><p>Vous avez déjà un compte ?<a href="connexion.php">Connectez-vous</a></p><br>

             </form>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>
