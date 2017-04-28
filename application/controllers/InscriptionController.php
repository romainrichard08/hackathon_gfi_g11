<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InscriptionController extends CI_Controller {

  public function index()
  {
    $this->load->model('inscriptionModel');

    $nom = htmlentities($_POST['form']['nom']);
    $prenom = htmlentities($_POST['form']['prenom']);
    $email = htmlentities($_POST['form']['email']);
    $motdepasse = htmlentities($_POST['form']['motdepasse']);

    $result = $this->inscriptionModel->checkUserInDatabase($email);

    if($result == NULL){
      // CA VEUT DIRE QUIL TROUVE PAS DE USER A CET EMAIL
      $checkUser = 'NO';
      $result = $this->inscriptionModel->insertUserInDatabase($nom,$prenom,$email,$motdepasse);

    } else {
      // Il trouve un user!
      $checkUser = 'YES';
    }
    //echo $checkUser;
  }

}