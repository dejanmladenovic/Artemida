<?php
 Class Login extends CI_Controller{
 	public function index(){
 		$data["page"] = "login";
		$this->load->view('templates/header', $data);
 		$this->load->view('pages/login');
 		$this->load->view('templates/footer');
 	}

 	public function email_exists(){
 		if(isset($_GET['email'])){
 			$this->load->model('LoginModel', 'loginmodel');
 			echo $this->loginmodel->email_exists($_GET['email']);
 			exit;
 		}
 	}

 	public function check_user(){

 		if(isset($_POST['email']) && isset($_POST['password'])){
 			$this->load->model('LoginModel', 'loginmodel');
 			echo $this->loginmodel->check_user($_POST['email'], $_POST['password']);
 			exit;
 		}
 	}

 }
?>