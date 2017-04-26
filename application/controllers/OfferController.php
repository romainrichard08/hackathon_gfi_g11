<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfferController extends CI_Controller {

  public function index() {
    $this->load->model('offerModel');
    //$idOffer = 1;
    $datasOffer = $this->offerModel->getDatasOffer($idOffer);
    $this->load->view('offer', array('datasOffer' => $datasOffer));
  }

}
