<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ConnexionController extends CI_Controller {

  public function index()
  {

  }

  public function connexion(){
    $this->load->model('connexionModel');

    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    $result = $this->connexionModel->checkUserInDatabase($email, $motdepasse);

    if($result == NULL){
      // CA VEUT DIRE QUIL TROUVE PAS DE USER A CET EMAIL
      $checkUser = false;
    } else {
      // Il trouve un user! :)
      $checkUser = true;
    }
    echo $checkUser;
  }

}
