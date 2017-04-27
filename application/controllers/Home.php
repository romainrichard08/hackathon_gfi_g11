<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->view('header');
        $this->load->view('footer');

    }

	public function index()
	{
		$this->load->view('form_profil');
	}

    public function testTechnique()
    {
        $id_offre= $_GET['idOffer'];
        $this->load->model('testTechnique');
        //Recuperation de l'id du test grâce à l'id de l'offre
        $id_test = $this->testTechnique->getTestById($id_offre);
        //Recuperation des questions grace à l'id de l'id de test
        $questions = $this->testTechnique->getQuestionsById($id_test->id_test);

        //Rassemble dans un tableau les questions et les réponses
        $result = [];
        foreach ($questions as $key => $value)
        {
            $q = $value;
            $result[$key] = [];
            array_push($result[$key], $q);
            array_push($result[$key], $this->testTechnique->getReponsesById($value->id));

        }

        $this->load->view('form_test_technique', array('result' => $result));

    }

}
