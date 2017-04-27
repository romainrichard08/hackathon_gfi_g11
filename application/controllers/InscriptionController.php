<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InscriptionController extends CI_Controller {

  public function index()
  {
    $idOffer = $_GET['idOffer'];
    $this->load->view('incriptionView', $idOffer);
  }

}