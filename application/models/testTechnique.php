<?php

class testTechnique extends CI_Model
{


  public function getTestById($id_offre)
  {
		$query = $this->db->select('id_test')
      					->from('offres')
      					->where('id', $id_offre);

		$query = $this->db->get();
		return $query->row();

  }

  public function getQuestionsById($id_test)
  {
		$query = $this->db->select('*')
      					->from('questions')
      					->where('id_test', $id_test);

		$query = $this->db->get();
		return $query->result();

  }


  public function getReponsesById($id_question)
  {
		$query = $this->db->select('*')
      					->from('reponses')
      					->where('id_question', $id_question);

		$query = $this->db->get();
		return $query->result();

  } 

  public function getReponsesCorrect($id_question)
  {
    
    $query = $this->db->select('*')
                ->from('reponses')
                ->where('id_question', $id_question)
                ->where('correct', 1);

    $query = $this->db->get();
    return $query->result();

  } 


}



