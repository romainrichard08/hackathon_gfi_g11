<?php

class connexionModel extends CI_Model {

  public function checkUserInDatabase($email, $motdepasse){
    $motdepasse = sha1($motdepasse);
    $query = $this->db->query("SELECT id FROM candidats WHERE email = '".$email."' AND motdepasse = '".$motdepasse."'");
    return $query->result_array();

  }


}


?>
