<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConnexionController extends CI_Controller {

  public function index()
  {
    $this->load->model('connexionModel');

    $email = htmlentities($_POST['form']['email']);
    $motdepasse = htmlentities($_POST['form']['motdepasse']);

    $result = $this->connexionModel->checkUserInDatabase($email, $motdepasse);

    if($result == NULL){
      // CA VEUT DIRE QUIL TROUVE PAS DE USER A CET EMAIL
      $checkUser = 'NO';
    } else {
      // Il trouve un user! :)
      $checkUser = 'YES';
    }
    echo $checkUser;
  }

}