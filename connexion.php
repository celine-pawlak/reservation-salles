<?php

$page_selected = "connexion";

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/css/style.css">
    <script src="https://kit.fontawesome.com/217c9d0a4d.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
<header>
    <?php
    include("header.php");
    $errors = [];

    if (isset($_POST["signin"])) {
        // Form login variables
        $login = htmlentities(trim($_POST["login"]));
        $password = htmlentities(trim($_POST["password"]));

        if ($login && $password) {
            $db = new mysqli("localhost", "root", "", "reservationsalles");

            // User Info Select Query
            $userExistCheckQry = "select `id`, `login`, `password` from `reservationsalles`.`utilisateurs` where `login`='$login'";
            $userExistCheckQryExec = $db->query($userExistCheckQry);

            $userPwdCheckQryExec = $db->query($userExistCheckQry);
            $password_bdd = $userPwdCheckQryExec->fetch_assoc();

            if (password_verify($password, $password_bdd['password'])) {
                if ($userExistCheckQryExec->num_rows == 0) {
                    $errors[] = "L'utilisateur et/ou le mot de passe est erroné";
                } elseif ($userExistCheckQryExec->num_rows == 1) {
                    $userExistFetchQryExec = $userExistCheckQryExec->fetch_assoc();
                    $_SESSION['user'] = $userExistFetchQryExec;
                    $db->close();
                }
            } else {
                $errors[] = "L'utilisateur et/ou le mot de passe est erroné";
            }
        } elseif (!$login || !$password) {
            echo "Tous les champs n'ont pas été renseignés";
        }
    }

    if (!empty($_SESSION['user'])) {
        header('Location: planning.php');
        exit();
    }

    ?>
</header>
<main>
    <div class="content">
        <?= renderErrors($errors) ?>
    </div>
    <div class="signin-section vh-100 row-no-wrap bg-light">
        <div class="signin-main-container row-no-wrap w-90 h-90 m-auto bx-shad-light b-radius-2 box-shadow-light">
            <div class="signin-left-container col bg-alpine-blue bl-radius-2">
                <form action="connexion.php" method="POST"
                      class="col-no-wrap align-items-center justify-content-center">
                    <div class="form-group w-70">
                        <label for="login">Identifiant</label>
                        <input class="no-border" id="login" name="login" type="text" required>
                    </div>
                    <div class="form-group w-70">
                        <label for="password">Mot de Passe</label>
                        <input class="no-border" id="password" name="password" type="password" required>
                    </div>
                    <div class="form-group w-70 align-items-center">
                        <button class="btn btn-md mb-05" type="submit" name="signin">Se connecter</button>
                    </div>
                </form>
            </div>
            <div class="signin-right-container col bg-delta-green br-radius-2">
                <h1 class="light m-auto">Connexion</h1>
            </div>
        </div>
    </div>
</main>
<footer>
    <?php include("footer.php") ?>
</footer>
</body>
</html>
