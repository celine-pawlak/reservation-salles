<?php

  $h1 = $h_to_int_debut;
  $h2 = $h_to_int_debut + 1;
  ?><div class="reserve_box">
    <p>Certains créneaux sont déjà réservés, veuillez en sélectionner parmi les suivants:</p>
    <form class="" action="planning.php" method="post">
    <?php
  foreach ($is_creneaux_av as $key => $value)
  {
    if ($value == null)
    {
      ?><input type="checkbox" id="choice<?= $key ;?>" name="choice<?= $key ;?>" value="<?= $h1 ;?>" checked>
        <label for="choice<?= $key ;?>"><?= "De " . $h1 ,"h à " . $h2 ,"h";?></label>
      <?php
        $no_null = true;
    }
    $h1++;
    $h2++;
  }
  if (!isset($no_null))
  {
    $errors[] = "Aucun créneau dans les horaires choisis n'est disponible.";
  }
  else
  {
?>
    <button type="submit" name="fill_creneaux">Confirmer</button>
    <?php
  }
  ?>
</form>
</div>
