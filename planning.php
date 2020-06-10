<?php
$page_selected = "planning";
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

            /*RESERVATION FORM*/

            if (!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['date_debut']) AND !empty($_POST['heure_debut']))
            {
              $titre = $_POST['titre'];
              $description = $_POST['description'];
              $date_debut = $_POST['date_debut'];
              $heure_debut = $_POST['heure_debut'];
              $heure_fin = $_POST['heure_fin'];

              /*TITRE*/
              $titre_required = preg_match("/^[A-Za-z]{1,}$/", $titre);
              if (!$titre_required)
              {
                $errors[] = "Votre titre doit commencer par une lettre.";
              }

              /*DESCRIPTION*/
              $description_required = preg_match("/^[A-Za-z]{1,}$/", $description);
              if (!$description_required)
              {
                $errors[] = "Votre description doit commencer par une lettre.";
              }

              /*DATE*/
              //conditions//

              /*HEURE*/
              $heure_pile = preg_match("/^.*[0][0]$/", $heure_debut);
              if (!$heure_pile)
              {
                $errors[] = "L'heure doit commencer à pile !";
              }
              $heure_pile2 = preg_match("/^.*[0][0]$/", $heure_fin);
              if (!$heure_pile2)
              {
                $errors[] = "L'heure doit finir à pile !";
              }
              if ($heure_debut >= $heure_fin)
              {
                $errors[] = "L'heure de début doit être inférieur à l'heure de fin.";
              }
              include 'heure.php';
              $heureonly_debut = heure_recup($heure_debut);
              $heureonly_fin = heure_recup($heure_fin);
              if ($heureonly_debut < 8 OR $heureonly_debut > 18)
              {
                $errors[] = "L'heure de début doit être comprise entre 08:00 et 18:00.";
              }
              if ($heureonly_fin < 9 OR $heureonly_fin > 19)
              {
                $errors[] = "L'heure de fin doit être comprise entre 09:00 et 19:00.";
              }
              $debut = $date_debut . " " . $heure_debut;
              $fin = $date_debut . " " . $heure_fin;

              if(empty($errors))
              {
                $debut = $date_debut . " " . $heure_debut;
                $fin = $date_debut . " " . $heure_fin;

                /*RECUP ID FROM SESSION*/
                $request_id = "SELECT id from utilisateurs WHERE login = '" . $_SESSION['login'] . "';";
                $query_id = mysqli_query($db, $request_id);
                $user_id = mysqli_fetch_array($query_id);

                /*ENVOI DONNEES BDD*/
                $request = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES ('" . $titre . "', '" . $description . "', '" . $debut . "', '" . $fin . "', '" . $user_id['id'] . "');";
                $query = mysqli_query($db, $request);
              }
            }
            elseif(!empty($_POST))
            {
              $errors[] = "Tous les champs doivent être remplis.";
            }

            ?>

        </header>
        <main>
            <div class="content">
                <?= renderErrors($errors) ?>
                <h2>Réserver un crénaux *</h2>
                <?php include 'reservation-form.php'; ?>
                <p><em> * Les réservations se font du lundi au vendredi et de 8h et 19h.<br>Les créneaux ont une durée fixe d’une heure.</em></p>
            </div>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>
