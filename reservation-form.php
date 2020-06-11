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
            
            $date_min=date("Y-m-d");
            $date_max=date("Y-m-d", strtotime("+1 year"));
            $heure=date("H");
            $date=date("D");

            
            if(isset($_SESSION['login'])){
                
                if(isset($_POST['submit'])){
                    
                $titre=$_POST['title'];
                $description=$_POST['description'];
                $debut=$_POST['date_debut']." ".$_POST['heure_debut'];
                $fin=$_POST['date_fin']." ".$_POST['heure_fin'];
                
                    
                    if($titre && $description && $debut){
                        
                        
                        
                        // Condition du lundi au vendredi
                        
                        if($date!="Sat" && $date!="Sun"){
                            if($date == (isset($_POST['date_debut']))){

                       // Condition entre 8h et 19h
                            if(isset($_POST['heure_debut'])==$heure){
                                if($heure >= "08" && $heure<= "19"){

                            // Condition 1h max de réservation
                            
                                $connexion=mysqli_connect('localhost','root','','reservationsalles');

                                $requete="INSERT INTO reservations (titre,description,debut,fin) VALUES ('$titre','$description','$debut','$fin')";
                                $execution=mysqli_query($connexion,$requete);
                        
                                header('location:planning.php');
                                    
                            }else echo "Réservation possible uniquement entre 08:00 et 19:00";
                                
                        }
                            
                            }else echo "Fermé le Samedi et Dimanche";
                    }
                    }else echo "Veuillez remplir tous les champs";

                }
            }
            
            
          ?>
        </header>
        <main>
            <div class="content">
                <?= renderErrors($errors) ?>
                
                <form action="reservation-form" method="post">
                    <label for="title">Titre</label><br>
                    <input type="text" name="title" id=title placeholder="titre"><br>
                    
                    <label for="description">Description</label><br>
                    <textarea id="description" name="description"></textarea><br>
                    
                    <label for="date-debut">Date début</label>
                    <input type="date" id="date_debut" name="date_debut" min="<?php $date_min; ?>" max="<?php $date_max; ?>">
                    
                    <label for="heure-debut">de</label>
                    <input type="time" id="heure_debut" name="heure_debut" min="<?php $heure_min; ?>"><br>
                    
                    <label for="date-fin">Date fin</label>
                    <input type="date" id="date_fin" name="date_fin" min="<?php $date_min; ?>" max="<?php $date_max; ?>" >
                    
                    <label for="heure-fin">à</label>
                    <input type="time" id="heure_fin" name="heure_fin" ><br>
                    
                    
                    
                    
                    <input type="submit" name="submit" value="VALIDER">
                    
                </form>
            </div>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>