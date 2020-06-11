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

            /* RECUP ID FROM SESSION */

            $request_id = "SELECT id from utilisateurs WHERE login = '" . $_SESSION['login'] . "';";
            $query_id = mysqli_query($db, $request_id);
            $user_id = mysqli_fetch_array($query_id);

            /* SI FORM MULTIPLES CRENEAUX EXISTE */

            if (isset($_POST['fill_creneaux']))
            {
              $titre = $_SESSION['titre'];
              $description = $_SESSION['description'];
              $date = $_SESSION['date'];
              for ($i=0; $i < 11; $i++)
              {
                if (isset($_POST["choice$i"]))
                {
                  $h1 = $_POST["choice$i"];
                  $h2 =  $_POST["choice$i"] + 1;
                  $debut = $date . " " . $h1;
                  $fin = $date . " " . $h2;
                  $request = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES ('" . $titre . "', '" . $description . "', '" . $debut . "', '" . $fin . "', '" . $user_id['id'] . "');";
                  $query = mysqli_query($db, $request);
                  unset($_SESSION['titre']);
                  unset($_SESSION['description']);
                  unset($_SESSION['date']);
                }
              }
            }

            /*RESERVATION FORM*/

            if (!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['date']) AND !empty($_POST['heure_debut']))
            {
              $titre = $_POST['titre'];
              $description = $_POST['description'];
              $date = $_POST['date'];
              $heure_debut = $_POST['heure_debut'];
              $heure_fin = $_POST['heure_fin'];

              $_SESSION['titre'] = $titre;
              $_SESSION['description'] = $description;
              $_SESSION['date'] = $date;

              /*VERIF CRENEAUX DEJA EXISTANT*/

                //CRENEAU UNIQUE
              $debut = $date . " " . $heure_debut;
              $fin = $date . " " . $heure_fin;
              $request = "SELECT debut, fin FROM reservations WHERE debut = '" . $debut . "' AND fin = '" . $fin . "';";
              $query = mysqli_query($db, $request);
              $is_creneaux_av = mysqli_fetch_array($query);

              if (!empty($is_creneaux_av))
              {
                $errors[] = "Ce créneaux est déjà réservé !";
              }
                //PLUSIEURS CRENEAUX
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
                    $request = "SELECT debut, fin FROM reservations WHERE debut = '" . $debut . "' AND fin = '" . $fin . "';";
                    $query = mysqli_query($db, $request);
                    $is_creneaux_av[$i] = mysqli_fetch_row($query);
                  }

                }

              /*TITRE*/
              $titre_required = preg_match("/^[A-Za-z]{1,}.{0,29}$/", $titre);
              if (!$titre_required)
              {
                $errors[] = "Votre titre doit:<br>- Commencer par une lettre.<br>- Contenir 30 caractères maximum.";
              }

              /*DESCRIPTION*/
              $description_required = preg_match("/^^[A-Za-z]{1,}.{0,29}$/", $description);
              if (!$description_required)
              {
                $errors[] = "Votre description doit: <br>- Commencer par une lettre.<br>- Contenir 30 caractères maximum.";
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

              if (!empty($is_creneaux_av) AND empty($errors))
              {
                include 'form_multiples_creneaux.php';
              }

              if(empty($errors))
              {

                //ENVOI PLUSIEURS CRENAUX

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
                    $request = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES ('" . $titre . "', '" . $description . "', '" . $debut . "', '" . $fin . "', '" . $user_id['id'] . "');";
                    $query = mysqli_query($db, $request);
                }
                  header('location: planning.php');
              }
            }
            elseif(isset($_POST['reservation_button']) AND !empty($_POST))
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
