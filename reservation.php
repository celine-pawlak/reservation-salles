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
    $user =  $_SESSION['user']['login'];

    
    if(isset($_SESSION['$user'])){

        
        //CONNEXION BDD
        $db = mysqli_connect('localhost','root','','reservationsalles');

        //CREATION REQUETE
        $requete = "SELECT utilisateurs.login, reservations.titre, reservations.description, reservations.debut, reservations.fin FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur";
        
        //EXECUTION REQUETE
        $query = mysqli_query($db,$requete);
        
        //RECUPERATION DONNEES
        $fusion = mysqli_fetch_all($query); 
        
    }
        ?>
        
        

</header>
<main>
    <div class="content">
        <?= renderErrors($errors) ?>
    </div>
    
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
            <?php foreach ($fusion as $info){?>
            <tr>
                <td><?= $info [0] ?></td>
                <td><?= $info [1] ?></td>
                <td><?= $info [2] ?></td>
                <td><?= $info [3] ?></td>
                <td><?= $info [4] ?></td>
            </tr><?php  } ?>
        </tbody>
    </table>
    

   
</main>
<footer>
    <?php include("footer.php") ?>
</footer>
</body>
</html>
