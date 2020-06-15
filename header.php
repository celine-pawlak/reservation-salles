<?php

session_start();

$db = mysqli_connect("localhost", "root", "", "reservationsalles");

/*REDIRECTIONS SELON SESSION*/

if (in_array($page_selected, ['profil', 'user_reservation', 'reservation', 'form_multiples_creneaux', 'planning']) and !$_SESSION['user']) {
    header('location: connexion.php');
}
if (in_array($page_selected, ['connexion', 'inscription']) and isset($_SESSION['user'])) {
    header('location: index.php');
}

/*FONCTIONS*/

/*ERREURS*/
/**
 * @param $errors
 * @return string
 */
function renderErrors($errors)
{
    if (!empty($errors)) {
        $output = "";
        if (count($errors) > 1) {
            $output .= "<ul>";
            foreach ($errors as $error) {
                $output .= "<li>" . $error . "</li>";
            }
            $output .= "</ul>";
        } else {
            $output = $errors[0];
        }
        return "<div class=\"ErrorMessage margin1\">"
            . $output .
            "</div>";
    } else {
        return "";
    }
}

/* GENERE LE NOM DES JOURS DE LA SEMAINE */
include 'functions/get_week_days.php';

/* GENERE UN AFFICHAGE DE PLAGE HORAIRE */
include 'functions/slot_generator.php';

?>

<nav class="col-no-wrap">
    <div class="navbar z-10">
        <ul class="d-flex align-items-center ml-1">
            <?php if (!isset($_SESSION['user'])) : ?>
                <li><a href="index.php"><h1>Accueil</h1></a></li>
                <li><a href="connexion.php"><h1>Connexion</h1></a></li>
                <li><a href="inscription.php"><h1>Inscription</h1></a></li>
            <?php else : ?>
                <li><a href="index.php"><h1>Accueil</h1></a></li>
                <li><a href="planning.php"><h1>Planning</h1></a></li>
                <li class="liste">
                    <h1>Mon compte</h1>
                    <ul class="sous-liste">
                        <li><a href="profil.php">Modifier mes identifiants</a></li>
                        <li><a href="user_reservation.php">Modifier mes réservations</a></li>
                        <li><a href="delete_session.php">Déconnexion</a></li>
                    </ul>
                </li>

            <?php endif; ?>
        </ul>
    </div>
</nav>
