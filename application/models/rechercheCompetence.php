<?php

class rechercheCompetence extends CI_Model
{


  public function search($tag){
      $query = $this->db->query("SELECT * FROM competences where label like '%".$tag."%' order by label limit 6");
      return $query->result_array();

  }


}



 ?>
