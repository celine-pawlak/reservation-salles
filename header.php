<?php

session_start();

$db = mysqli_connect("localhost", "root", "", "reservationsalles");

/*REDIRECTIONS SELON SESSION*/

if ($page_selected == "profil" and !$_SESSION['user']) {
    header('location: connexion.php');
}
if (in_array($page_selected, ['connexion', 'inscription']) and isset($_SESSION['user'])) {
    header('location: index.php');
}
// if ($page_selected == "planning" and !$_SESSION['user']) {
//     header('location: connexion.php');
// }

/*FONCTION ERREURS*/

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

?>

<nav class="col-no-wrap">
    <div class="navbar z-10">
        <ul class="d-flex align-items-center ml-1">
            <?php if (!isset($_SESSION['user'])) : ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            <?php else : ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="planning.php">Planning</a></li>
                <li><a href="profil.php">Modifier mes identifiants</a></li>
                <li><a href="delete_session.php">Deconnexion</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<!-- <nav>
   <div class="header_1">
     <a href="index.php"><h1>Accueil</h1></a>
   </div>
   <div class="header_2">
     <a href="planning.php"><h1>Planning</h1></a>
   </div>
   <div class="header_3">
     <?php /*if (isset($_SESSION['user'] )) { */ ?>
       <ul>
         <li class="liste">
           <h1>Mon compte</h1>
           <ul class="sous-liste">
             <li><a href="profil.php">Modifier mes identifiants</a></li>
             <li><a href="delete_session.php">Déconnexion</a></li>
           </ul>
         </li>
       </ul>
     <?php /*} else { */ ?>
       <a href="connexion.php">Connexion</a>
       <p>/</p>
       <a href="inscription.php">Inscription</a>
     <?php /*} */ ?>
   </div>
 </nav>-->
