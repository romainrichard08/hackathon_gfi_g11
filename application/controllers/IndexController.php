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
}
