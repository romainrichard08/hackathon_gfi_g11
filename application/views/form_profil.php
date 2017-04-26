<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Bienvenue sur l'espace Carrières de GFI</h1>

	<form action="#" method="post">
		<fieldset>
		<legend>Dans quelle branche souhaitez-vous nous rejoindre?</legend>
		<select id="branche" required>
		  <option value="Commercial">Commercial</option>
		  <option value="Informatique">Informatique</option>
		  <option value="Ressources-humaines">Ressources Humaines</option>
		</select>

		<legend>Quel type de contrat recherchez-vous?</legend>
		<select id="contrat" required>
		  <option value="CDI">CDI</option>
		  <option value="CDD">CDD</option>
		  <option value="Stage">Stage</option>
		  <option value="Alternance">Stage</option>
		</select>

		<legend>Quelles compétences avez-vous? (Entrée pour ajouter)</legend>
		<input type="text" name="competences"><br>

		<input type="submit" value="Rechercher">
		</fieldset>
	</form>