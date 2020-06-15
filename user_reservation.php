<?php $page_selected = "user_reservation"; ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="styles/css/main.css">
    <link rel="stylesheet" href="styles/css/style.css">
    <script src="https://kit.fontawesome.com/217c9d0a4d.js" crossorigin="anonymous"></script>
    <title>Modifier réservations - Réservation salles</title>
</head>
<body>
    <header>
        <?php
        include 'header.php';
        $errors = [];
        $user_id = $_SESSION['user']['id'];
        $requete = "SELECT titre, description, cast(debut as time), cast(fin as time), cast(debut as date), id FROM reservations WHERE id_utilisateur = '$user_id'";
        $query = mysqli_query($db, $requete);
        $user_reservations = mysqli_fetch_all($query);

        if (empty($user_reservations)){
            $errors[] = " Vous n'avez réservé aucun créneau.<br>Veuillez en réserver <a href=\"planning.php\"> ici</a>";
        }

        foreach ($user_reservations as $key => $value) {
            /*SUPPRIMER CRENEAU */
            if (isset($_POST["suppress_reservation_$key"])) {
                $id_reservation = $user_reservations[$key][5];
                $requete2 = "DELETE FROM reservations WHERE id = '$id_reservation'";
                $query = mysqli_query($db, $requete2);
                header('user_reservation.php');
            }
            /* MODIFIER CRENEAU */
            if (isset($_POST["modify_reservation_$key"])) {
                $id_reservation = $user_reservations[$key][5];
                if (!empty($_POST['titre']) AND !empty($_POST['description'])) {
                    $titre = htmlentities(trim($_POST['titre']));
                    $description = htmlentities(trim($_POST['description']));

                    /*TITRE*/
                    $titre_required = preg_match("/^[A-Za-z]{1,}.{0,29}$/", $titre);
                    if (!$titre_required) {
                        $errors[] = "Votre titre doit:<br>- Commencer par une lettre.<br>- Contenir 30 caractères maximum.";
                    }

                    /*DESCRIPTION*/
                    $description_required = preg_match("/^[A-Za-z]{1,}.{0,29}$/", $description);
                    if (!$description_required) {
                        $errors[] = "Votre description doit: <br>- Commencer par une lettre.<br>- Contenir 30 caractères maximum.";
                    }

                    if ($titre == $user_reservations[$key][0] AND $description == $user_reservations[$key][1] ) {
                        $errors[] = "Vous n'avez rien modifié !";
                    }
                    if(empty($errors)) {
                        if ($titre != $user_reservations[$key][0] AND $description != $user_reservations[$key][1]) {
                            $requete3 = "UPDATE reservations SET titre = '$titre', description = '$description' WHERE id = '$id_reservation'";
                            $query = mysqli_query($db, $requete3);
                            header('user_reservation.php');
                        }
                        if ($titre != $user_reservations[$key][0]) {
                            $requete4 = "UPDATE reservations SET titre = '$titre' WHERE id = '$id_reservation'";
                            $query = mysqli_query($db, $requete4);
                            header('user_reservation.php');
                        }
                        if ($description != $user_reservations[$key][1]) {
                            $requete5 = "UPDATE reservations SET description = '$description' WHERE id = '$id_reservation'";
                            $query = mysqli_query($db, $requete5);
                            header('user_reservation.php');
                        }
                    }

                }
                else {
                    $errors[] = "Les deux champs doivent être remplis.";
                }


            }
        }

        /*REFRESH REQUETE*/
        $query = mysqli_query($db, $requete);
        $user_reservations = mysqli_fetch_all($query);
        ?>
    </header>
    <main>
        <?= renderErrors($errors) ?>
        <?php
        foreach($user_reservations as $key => $value)
            {
                $titre = $user_reservations[$key][0];
                $description = $user_reservations[$key][1];
                $heure_debut = $user_reservations[$key][2];
                $heure_fin = $user_reservations[$key][3];
                $date = $user_reservations[$key][4];
                ?>
                <p>Le <?= $date ?> de <?= $heure_debut ?> à <?= $heure_fin ?> :</p>
                <form action="user_reservation.php" method="post">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" value="<?=$titre?>" >
                    <label for="description">Description</label>
                    <input type="text" name="description" value="<?=$description?>" >
                    <button name="modify_reservation_<?=$key?>" type="submit">Modifier</button>
                    <p>ou</p>
                    <button name="suppress_reservation_<?=$key?>" type="submit"><i class="fad fa-trash-alt"></i></button>
                </form>
                <?php
            }
        ?>

    </main>
    <footer>

    </footer>

</body>
</html>
