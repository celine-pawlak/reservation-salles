<?php


 ?>

<form class="" action="reservation-form.php" method="post">
  <div class="form_element">
    <label for="titre">Titre</label>
    <input type="text" name="titre" value="" required placeholder="Titre">
  </div>
  <div class="form_element">
    <label for="description">Description</label>
    <input type="text" name="description" value="" required placeholder="Description">
  </div>
  <div class="form_element">
    <label for="date_debut">Date de début</label>
    <input type="datetime" name="date_debut" value="" required>
  </div>
  <div class="form_element">
    <label for="date_fin">Date de fin</label>
    <input type="datetime" name="date_fin" value="" required>
  </div>
  <button type="submit" name="reservation_button">Réserver</button>
</form>
