<?php


 ?>

<form class="" action="planning.php" method="post">
  <div class="form_element">
    <label for="titre">Titre</label>
    <input type="text" name="titre" value="" required placeholder="Titre">
  </div>
  <div class="form_element">
    <label for="description">Description</label>
    <input type="text" name="description" value="" required placeholder="Description">
  </div>
  <div class="form_element">
    <div class="">
      <label for="date_debut">Le</label>
      <input type="date" name="date" value="" required>
      <label for="heure_debut">de</label>
      <input type="time" name="heure_debut" value="" step="3600" min="08:00:00" max="18:00:00" required>
      <label for="heure_fin">à</label>
      <input type="time" name="heure_fin" value="" step="3600" min="09:00:00" max="19:00:00" required>
    </div>

  <button type="submit" name="reservation_button">Réserver</button>
</form>
