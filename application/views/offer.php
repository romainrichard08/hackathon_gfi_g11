<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div>

  <div>
    <p>Libellé: <?php echo $datasOffer->libelle; ?></p>
  </div>

  <div>
    <p>Description: <?php echo $datasOffer->description; ?></p>
  </div>

  <div>
    <p>Metier: <?php echo $datasOffer->metier; ?></p>
  </div>

  <div>
    <p>Contrat: <?php echo $datasOffer->contrat; ?></p>
  </div>

  <div>
    <p>Departement: <?php echo $datasOffer->departement; ?></p>
  </div>

  <div>
    <p>Profil: <?php echo $datasOffer->profil; ?></p>
  </div>

  <div>
    <p>Entite: <?php echo $datasOffer->entite; ?></p>
  </div>

  <div>
    <p>Expérience mini: <?php echo $datasOffer->experience_min; ?></p>
  </div>

  <div>
    <button type="button">POSTULER !</button>
  </div>

</div>