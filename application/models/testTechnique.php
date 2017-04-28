<?php

class testTechnique extends CI_Model
{


  public function getTestById($id_offre)
  {
		$query = $this->db->query('SELECT id_test FROM offres where id ='.$id_offre);
		return $query->row();
  }

  public function getQuestionsById($id_test)
  {
		$query = $this->db->query('SELECT * FROM questions where id_test ="'.$id_test.'"');
		return $query->result_array();

  }


  public function getReponsesById($id_question)
  {
		$query = $this->db->query('SELECT * FROM reponses where id_question ='.$id_question);
		return $query->result_array();

  }

  public function getReponsesCorrect($id_question)
  {

    $query = $this->db->select('*')
                ->from('reponses')
                ->where('id_question', $id_question)
                ->where('correct', 1);

    return $query->result_array();

  }


}
