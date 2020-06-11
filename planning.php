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
            date_default_timezone_set('Europe/Paris');

            /*RESERVATION FORM*/

            if (!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['date']) AND !empty($_POST['heure_debut']))
            {
              $titre = $_POST['titre'];
              $description = $_POST['description'];
              $date = $_POST['date'];
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

              // JOURS DE LA SEMAINE
              $days = strtotime($date);
              $dayOfWeek = date("l", $days);
              if ($dayOfWeek == "Saturday" OR $dayOfWeek == "Sunday")
              {
                $errors[] = "Les réservations ne sont possibles que du lundi au vendredi.";
              }

              // EMPECHER POST RESERVATION

              $today_s_date = date('Y-m-d');
              if ($date <= $today_s_date)
              {
                if ($date == $today_s_date)
                {
                  $today_s_hour = date('H:i');
                  if ($heure_debut <= $today_s_hour)
                  {
                    $errors[] = "Vous ne pouvez pas réserver un créneaux sur une heure antérieure.";
                  }
                }
                else
                {
                  $errors[] = "La réservation ne peux pas se faire sur une date antérieure.";
                }
              }


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

              //VERIFICATION CRENAUX HORAIRE

              if ($heure_debut < 8 OR $heure_debut > 18)
              {
                $errors[] = "L'heure de début doit être comprise entre 08:00 et 18:00.";
              }
              if ($heure_fin < 9 OR $heure_fin > 19)
              {
                $errors[] = "L'heure de fin doit être comprise entre 09:00 et 19:00.";
              }

              if(empty($errors))
              {

                // /* RECUP ID FROM SESSION */
                // $request_id = "SELECT id from utilisateurs WHERE login = '" . $_SESSION['login'] . "';";
                // $query_id = mysqli_query($db, $request_id);
                // $user_id = mysqli_fetch_array($query_id);


                //ENVOI PLUSIEURS CRENAUX
                include 'hour_to_integer.php';

                $h_to_int_debut = heure_recup($heure_debut);
                $h_to_int_fin = heure_recup($heure_fin);

                if (($h_to_int_fin - $h_to_int_debut) > 1)
                {
                  $creneaux = $h_to_int_fin - $h_to_int_debut;
                  for ($i=0; $i < $creneaux; $i++)
                  {
                    $h1 = $h_to_int_debut + $i;
                    $debut = $date . " " . $h1;
                    $h2 = $h_to_int_debut + $i +1;
                    $fin = $date . " " . $h2;
                    $request = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES ('" . $titre . "', '" . $description . "', '" . $debut . "', '" . $fin . "', '" . $user_id['id'] . "');";
                    $query = mysqli_query($db, $request);
                  }
                }
                else
                {
                  $debut = $date . " " . $heure_debut;
                  $fin = $date . " " . $heure_fin;
                  $request = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES ('" . $titre . "', '" . $description . "', '" . $debut . "', '" . $fin . "', '" . $user_id['id'] . "');";
                  $query = mysqli_query($db, $request);
                }
                  header('location: planning.php');
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
