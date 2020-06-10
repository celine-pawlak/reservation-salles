<?php
$page_selected = "conexion";
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
            
            if(isset($_POST['submit'])){
                $login=$_POST['login'];
                $password=$_POST['password'];
                    
                if($login && $password){
                    $connexion=mysqli_connect('localhost','root','','reservationsalles');
                    
                    $requete="SELECT * FROM utilisateurs WHERE `login`='$login'";
                    $execution=mysqli_query($connexion,$requete);
                    
                   $user=mysqli_fetch_array($execution); 
                    var_dump($user);
                    echo $password;
                    
                    var_dump(password_verify($password,$user[2]));
                    
                    var_dump($password,$user[2] );
                    if(password_verify($password,$user[2])){
                        echo "yes ça fonctionne";
                                header('location:reservation-form.php');
                        
                            }else{echo "Login ou mot de passe incorrect";} 
                    
                        }else{echo "Veuillez remplir tous les champs";} 
                    }

            ?>
        </header>
        <main>
            <div class="content">
                <?= renderErrors($errors) ?>
            </div>
            <form action="connexion.php" method="post">
                <h1> CONNEXION </h1><br/>

                <label for="login">Identifiant</label>
                <input type="text" id="login" name="login" placeholder="Créez votre pseudo"> <br/>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Entrer un mot de passe"> <br/>

                <div class="button" >
                    <input type="submit" value="VALIDER" name="submit">
                </div>

             </form>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>
