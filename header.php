<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "reservationsalles");

/*REDIRECTIONS SELON SESSION*/

if ($page_selected == "profil"  AND !$_SESSION['id'])
{
  header('location: connexion.php');
}
if (in_array($page_selected, ['connexion','inscription']) AND isset($_SESSION['id']))
{
  header('location: index.php');
}

/*FONCTION ERREURS*/

/**
  * @param $errors
  * @return string
  */
function renderErrors($errors)
{
  if (!empty($errors))
  {
    $output = "";
    if (count($errors) > 1)
    {
      $output .= "<ul>";
      foreach ($errors as $error)
      {
        $output .= "<li>" . $error . "</li>";
      }
      $output .= "</ul>";
    }
    else
    {
      $output = $errors[0];
    }
    return "<div class=\"ErrorMessage margin1\">"
      . $output .
      "</div>";
  }
  else
  {
    return "";
  }
}
 ?>

 <nav>
   <div class="header_1">
     <a href="index.php"><h1>Accueil</h1></a>
   </div>
   <div class="header_2">
     <a href="planning.php"><h1>Planning</h1></a>
   </div>
   <div class="header_3">
     <?php if (isset($_SESSION['id']))
     { ?>
       <ul>
         <li class="liste">
           <h1>Mon compte</h1>
           <ul class="sous-liste">
             <li><a href="profil.php">Modifier mes identifiants</a></li>
             <li><a href="delete_session.php">Déconnexion</a></li>
           </ul>
         </li>
       </ul>
     <?php }
     else { ?>
       <a href="connexion.php">Connexion</a>
       <p>/</p>
       <a href="inscription.php">Inscription</a>
    <?php } ?>
   </div>
 </nav>
