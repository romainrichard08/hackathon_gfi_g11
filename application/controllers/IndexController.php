<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {

  public function index()
  {
    $this->load->view('index');
  }

  public function search(){
    $this->load->model('rechercheCompetence');
    $result = $this->rechercheCompetence->search($_POST['tag']);
    print_r(json_encode($result));
  }

  public function findJobs(){
    $this->load->model('rechercheCompetence');
    $branche = $_POST['branche'];
    $contrat = $_POST['contrat'];
    $localisation = $_POST['localisation'];
    $competences = explode("/", $_POST['competences']);


    $offers = [];

    foreach ($competences as $competence){
      $result = $this->rechercheCompetence->getJobsFromForm($branche, $contrat, $localisation, $competence);
      array_push($offers, $result);
    }
    echo $offers;
  }
}
