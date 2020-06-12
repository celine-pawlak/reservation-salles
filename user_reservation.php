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
        $requete = "SELECT titre, description, debut, fin FROM reservations WHERE id_utilisateur = '$user_id'";
        $query = mysqli_query($db, $requete);
        $user_reservations = mysqli_fetch_all($query);
        var_dump($user_reservations);
        ?>
    </header>
    <main>
        <?php
        foreach($user_reservations as $key => $value)
            {
                $titre = $user_reservations[$key][0];
                $description = $user_reservations[$key][1];
                $debut = $user_reservations[$key][2];
                $heure_debut = date('H', $debut);
                $date = date('d-m-Y', $debut);
                $fin = $user_reservations[$key][3];
                $heure_fin = date('H', $fin);
                ?>
                <p>Le <?= $date ?> de <?= $heure_debut ?> à <?= $heure_fin ?> :</p>
                <form action="user_reservation.php" method="post">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" value="<?=$titre?>" >
                    <label for="description">Description</label>
                    <input type="text" name="description" value=<?=$description?>" >
                    <button name="modify_reservation" type="submit">Modifier</button>
                    <p>ou</p>
                    <button type="submit"><i class="fad fa-trash-alt"></i></button>
                </form>
                <?php
            }
        ?>

    </main>
    <footer>

    </footer>

</body>
</html>
