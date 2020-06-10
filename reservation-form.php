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
            $heure_min=date("h:i:s");
            $heure_max=date("h:i:s", strtotime('now +1 Hour'));
            
            
            
            if(isset($_SESSION['login'])){
                
                if(isset($_POST['submit'])){
                $titre=$_POST['title'];
                $description=$_POST['description'];
                $debut=$_POST['date_debut']." ".$_POST['heure_debut'];
                $fin=$_POST['date_fin']." ".$_POST['heure_fin'];
                    
                    if($titre && $description && $debut && $fin){
                        
                       
                        $connexion=mysqli_connect('localhost','root','','reservationsalles');
                        $requete="INSERT INTO reservations (titre,description,debut,fin) VALUES ('$titre','$description','$debut','$fin')";
                        $execution=mysqli_query($connexion,$requete);
                        
                        header('location:planning.php');
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
                    <input type="date" id="date-debut" name="date_debut" min="<?php echo $date_min; ?>" max="<?php echo $date_max; ?>">
                    
                    <label for="heure-debut">Heure de début</label>
                    <input type="time" id="heure" name="heure_debut"
       min="<?php $heure_min; ?>" max="00:00"><br>
                    
                    <label for="date-fin">Date de fin</label>
                    <input type="date" id="date-fin" name="date_fin" min="<?php echo $date_min; ?>" max="<?php echo $date_max; ?>"><br>
                    
                    
                    
                    
                    <input type="submit" name="submit" value="VALIDER">
                    
                </form>
            </div>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>