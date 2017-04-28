<?php

class connexionModel extends CI_Model {

  public function checkUserInDatabase($email, $motdepasse){

    $motdepasse = sha1($motdepasse);

    $query = $this->db->query("SELECT * FROM candidats WHERE email = '".$email."' AND motdepasse = '".$motdepasse."' ;");
    return $query->row();

  }


}


?>
