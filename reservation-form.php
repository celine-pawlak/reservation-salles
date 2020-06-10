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
            
            if(isset($_SESSION['login'])){
                
                if(isset($_POST['submit'])){
                $titre=$_POST['title'];
                $description=$_POST['description'];
                $debut=$_POST['date-debut'];
                $fin=$_POST['date-fin'];
                    
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
                    
                    <label for="date-debut">Date début</label><br>
                    <input type="datetime-local" id="meeting-time" name="meeting-time" value="2018-06-12T19:30"><br>
                    
                    <label for="date-fin">Date de fin</label><br>
                    <input type="datetime-local" id="meeting-time" name="meeting-time" value="2018-06-12T20:30"><br>
                    
                    <input type="submit" name="submit" value="VALIDER">
                    
                </form>
            </div>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>