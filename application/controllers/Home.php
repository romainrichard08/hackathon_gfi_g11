<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->view('header');
        $this->load->view('footer');

    }


	public function index()
	{
		$this->load->view('form_profil');
	}

  public function test(){
    echo 'coucou';
  }

}
