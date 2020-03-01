<?php
 Class Home extends CI_Controller{
 	public function index(){
 		$this->load->view('templates/header');
 		$this->load->view('pages/homePage');
 		$this->load->view('templates/footer');
 	}
 }

 ?>