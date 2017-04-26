<?php

class offerModel extends CI_Model {

  public function getDatasOffer($idOffer){
    $query = $this->db->query("SELECT * FROM offres WHERE id = '".$idOffer."' ;");
    return $query->row();
  }






}


?>
