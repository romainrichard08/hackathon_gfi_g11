<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
  </head>


  <body>

    <h1>Bienvenue sur l'espace Carrières de GFI</h1>


  <form action="/FormProfileController" method="post">
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

    <legend>Ou êtes-vous ?</legend>
    <select id="localisation" required>
      <option value="Paris">(75) - Paris</option>
      <option value="Marseille">(13) - Marseille</option>
      <option value="Lyon">(69) - Lyon</option>
    </select>

    <legend>Quelles compétences avez-vous? (Entrée pour ajouter)</legend>
    <input type="text" name="competences"><br>

    <input type="submit" value="Rechercher">
  </form>



  </body>
</html>