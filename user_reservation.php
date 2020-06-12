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
        $user_reservations = mysqli_fetch_array($query);
        var_dump($user_reservations);
        ?>
    </header>
    <main>
<!--        <?php
/*        foreach($user_reservations)
            {
                */?>
                <form>

                </form>
                --><?php
/*            }
        */?>

    </main>
    <footer>

    </footer>

</body>
</html>
