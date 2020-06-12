<?php $page_selected = "inscription"; ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=yes"/>
        <link rel="stylesheet" href="styles/css/main.css">
        <link rel="stylesheet" href="styles/css/style.css">
        <script src="https://kit.fontawesome.com/217c9d0a4d.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
          <?php include 'header.php';
            $errors = [];
            if (isset($_POST['submit'])) {
                $login = htmlentities(trim($_POST['login']));
                $password = htmlentities(trim($_POST['password']));
                $mdpcheck = htmlentities(trim($_POST['mdp_check']));
                $password_modified =  password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

                if ($login && $password && $mdpcheck) {
                    /*LOGIN*/
                    $login_required = preg_match("/^(?=.*[A-Za-z0-9]$)[A-Za-z\d\-\_]{3,19}$/", $login);
                    if (!$login_required) {
                        $errors[] = "Le login doit :<br>- Contenir entre 4 et 20 caractères.<br>- Commencer par une lettre<br>- Finir par une lettre ou nombre.<br>- Ne contenir aucun caractère spécial (sauf - et _).";
                    }
                    $request = "SELECT login FROM `reservationsalles`.`utilisateurs` WHERE login = '$login';";
                    $query = mysqli_query($db, $request);
                    $login_check = mysqli_fetch_array($query);
                    if (!empty($login_check)) {
                        $errors[] = "Ce login existe déjà !";
                    }
                    /*PASSWORD*/
                    if ($password != $mdpcheck) {
                        $errors[] = "Les mots de passe ne sont pas identiques.";
                    }
                    $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $password);
                    if (!$password_required) {
                        $errors[] = "Le mot de passe doit :<br>- Contenir entre 8 et 20 caractères.<br>- Contenir au moins 1 caractère spécial, 1 nombre, 1 majuscule et 1 minuscule.";
                    }
                    /*ENVOI BDD*/
                    if (empty($errors)) {
                        $connexion = mysqli_connect('localhost', 'root', '', 'reservationsalles');
                        $requete = "INSERT INTO `reservationsalles`.`utilisateurs` (login,password) VALUES ('$login','$password_modified')";
                        $query = mysqli_query($connexion, $requete);
                        header('location:connexion.php');
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
                <input type="password" id="mdp_check" name="mdp_check" placeholder="Confirmer le mot de passe"> <br/>

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
