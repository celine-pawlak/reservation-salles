<?php
$page_selected = "index";
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=yes"/>
        <link rel="stylesheet" href="styles/css/main.css">
        <link rel="stylesheet" href="styles/css/style.css">
    </head>
    <body>
        <header>
          <?php include("header.php");
            $errors = [];
            
            ?>

        </header>
        <main>
            <div class="content">
                <?= renderErrors($errors) ?>
            </div>
        </main>
        <footer>
          <?php include("footer.php")?>
        </footer>
    </body>
</html>
