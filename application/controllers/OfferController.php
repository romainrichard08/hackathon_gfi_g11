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

}
