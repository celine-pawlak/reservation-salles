<?php $page_selected = "reservation"; ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes"/>
    <link rel="stylesheet" href="fa.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/217c9d0a4d.js" crossorigin="anonymous"></script>
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
    <?php include("footer.php") ?>
</footer>
</body>
</html>
