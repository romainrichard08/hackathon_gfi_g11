<?php

class inscriptionModel extends CI_Model {

  public function checkUserInDatabase($email){

    $query = $this->db->query("SELECT * FROM candidats WHERE email = '".$email."' ;");

    if($query == NULL){
      return NULL;
    } else {
      return $query->row();
    }

  }

  public function insertUserInDatabase($nom, $prenom, $email, $motdepasse){

    $motdepasse = sha1($motdepasse);

    $query = $this->db->query("INSERT INTO candidats (nom, prenom, motdepasse, email) VALUES ('".$nom."', '".$prenom."', '".$motdepasse."', '".$email."' ); ");
    return $query->row();
  }


}


?>
