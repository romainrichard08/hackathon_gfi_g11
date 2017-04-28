<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OfferController extends CI_Controller {

  public function index() {
    $this->load->model('offerModel');
    $idOffer = $_POST["idOffer"];
    $datasOffer = $this->offerModel->getDatasOffer($idOffer);
    echo json_encode($datasOffer);
/*    die;
    $this->load->view('offer', array('datasOffer' => $datasOffer));*/
  }

  public function testTechnique()
  {
      $id_offre= $_POST['idOffer'];
      $this->load->model('testTechnique');
      //Recuperation de l'id du test grâce à l'id de l'offre
      $test = $this->testTechnique->getTestById($id_offre);
      //Recuperation des questions grace à l'id de l'id de test
      $questions = $this->testTechnique->getQuestionsById($test->id_test);

      //Rassemble dans un tableau les questions et les réponses
      $result = [];
      foreach ($questions as $key => $value)
      {
          $q = $value;
          $result[$key] = [];
          array_push($result[$key], $q);
          // print_r($value);
          array_push($result[$key], $this->testTechnique->getReponsesById($value['id']));
      }


      echo json_encode($result);

  }

}
