<?php

class rechercheCompetence extends CI_Model
{


  public function search($tag, $branche){
      $query = $this->db->query("SELECT * FROM competences where type = '".$branche."' and label like '%".$tag."%' order by label limit 6");
      return $query->result_array();

  }

  public function getJobsFromForm($branche, $contrat, $localisation, $competence){
      $query = $this->db->query("SELECT offres.*, competences.label
                                 FROM offres, competences, competences_offre
                                 where competences_offre.id_competences = competences.id
                                 AND competences_offre.id_offres = offres.id
                                 and competences_offre.id_competences = ".$competence."
                                 and offres.metier = '".$branche."'
                                 AND offres.contrat = '".$contrat."'
                                 AND offres.departement = '".$localisation."'

                                 GROUP by offres.id ;");

      return $query->result_array();
  }


}



 ?>
