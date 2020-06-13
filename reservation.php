<?php $page_selected = "reservation"; ?>


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
    
   
        
    $servname="localhost";
    $dbname="reservationsalles";
    $user="root";
    
    try{
        $dbco=new PDO("mysql:host=$servname;dbname=$dbname",$user);
        
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sth = $dbco -> prepare("SELECT utilisateurs.login, reservations.titre, reservations.description, reservations.debut, reservations.fin FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur");
        
        $sth -> execute();
        
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
            
        
    }
    
    catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        
        ?>
    <table>
        <thead>
            <tr>
                <th>Nom du créateur</th>
                <th>Titre de l'événement</th>
                <th>Description</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultat as $info => $value){?>
            <tr>
                <td><?= $value['login'] ?></td>
                <td><?= $value['titre'] ?></td>
                <td><?= $value['description'] ?></td>
                <td><?= $value['debut'] ?></td>
                <td><?= $value['fin'] ?></td>
            </tr>
        </tbody>
    </table>
        <?php  
    }
            
    ?>

        
        

</header>
<main>
    <div class="content">
        <?= renderErrors($errors) ?>
    </div>

</main>
<footer>
    <?php include("footer.php") ?>
</footer>
</body>
</html>

<!--
    $user =  $_SESSION['user']['login'];

    
    if(isset($_SESSION['$user'])){

        
        //CONNEXION BDD
        $db = mysqli_connect('localhost','root','','reservationsalles');

        //CREATION REQUETE
        $requete = "SELECT utilisateurs.login, reservations.titre FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur";
        
        //EXECUTION REQUETE
        $query = mysqli_query($db,$requete);
        
        //RECUPERATION DONNEES
        $fusion = mysqli_fetch_all($query); 
        
    }
-->


<!--

    $servname="localhost";
    $dbname="reservationsalles";
    $user="root";
    
    try{
        $dbco=new PDO("mysql:host=$servname;dbname=$dbname",$user);
        
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sth = $dbco->prepare("SELECT utilisateurs.login, reservations.titre, reservations.description, reservations.debut, reservations.fin FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur");
        
        $sth -> execute();
        
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        print_r($resultat);    
    }
    
    catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }

-->
