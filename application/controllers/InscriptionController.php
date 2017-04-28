<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InscriptionController extends CI_Controller {

  public function index()
  {

  }

  public function inscription(){
    $this->load->model('inscriptionModel');
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    $result = $this->inscriptionModel->checkUserInDatabase($email);

    if(!$result){
      // CA VEUT DIRE QUIL TROUVE PAS DE USER A CET EMAIL
      $checkUser = false;
      $this->inscriptionModel->insertUserInDatabase($nom,$prenom,$email,$motdepasse);
    } else {
      // Il trouve un user!
      $checkUser = true;
    }
    echo $checkUser;
  }

}
