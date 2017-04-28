<?php

class inscriptionModel extends CI_Model {

  public function checkUserInDatabase($email){

    $query = $this->db->query("SELECT * FROM candidats WHERE email = '".$email."' ;");

    if($query == NULL){
      return false;
    } else {
      return $query->row();
    }
  }

  public function insertUserInDatabase($nom, $prenom, $email, $motdepasse){

    $motdepasse = sha1($motdepasse);

    $query = $this->db->query("INSERT INTO candidats VALUES (null,'".$nom."', '".$prenom."', '".$email."',0,1, '".$motdepasse."' ); ");
  }


}


?>
