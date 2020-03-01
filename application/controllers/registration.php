<?php
	Class Registration extends CI_Controller{
		public function index(){
			$this->load->view("templates/header");
			$this->load->view("pages/registration");
		}
		public function registration_email_exists(){
		if(isset($_GET['email'])){
 			$this->load->model('LoginModel', 'loginmodel');
 			echo $this->loginmodel->email_exists($_GET['email']);
 			exit;
 			}
 		}
 		public function registration_member_name_exists(){
 			if(isset($_GET['member_name'])) 
 			{
 				$this->load->model('LoginModel', 'loginmodel');
 				echo $this->loginmodel->registration_member_name_exists($_GET['member_name']);
 				exit;
 			}
 		}
 		public function add_member(){
 					if(isset($_FILES['images'])){
	 				$this->load->model('ImageModel', 'imageModel');
	 				$count = count($_FILES['images']['name']);
	 				if($count > 1){
	 					echo "Vise od jedne slike je izabrano za dodavanje";
	 					exit;
	 				}

	 				if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['member_name'])){
 						$this->load->model('LoginModel', 'loginmodel');
 						$id_member =  $this->loginmodel->add_member($_POST['email'], $_POST['password'], $_POST['member_name'], $_POST['member_contact_mail'],$_POST['member_contact_phone'], $_POST['member_type']);

	 				for($i = 0; $i < $count; $i++){
	 					$file = array('name' => $_FILES['images']['name'][$i],
	 								'error' => $_FILES['images']['error'][$i],
	 								'tmp_name' => $_FILES['images']['tmp_name'][$i],
	 								'size' => $_FILES['images']['size'][$i],
	 								'type' => $_FILES['images']['type'][$i]
	 					 );
	 				}
	 				 	$result = $this->imageModel->upload_image_profile($file, $id_member);
	 				 	if($result > 0){
	 				 		$ID= $result;
	 				 		//echo $ID;
	 				 		$this->loginmodel->add_id_profile_image_member($ID, $id_member);
	 				 	}
	 				 	else{
	 				 		echo $result;
	 				 	}
	 				}
	 			}
	 			else{
	 				if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['member_name'])){
 				$this->load->model('LoginModel', 'loginmodel');
 				$id_member =  $this->loginmodel->add_member($_POST['email'], $_POST['password'], $_POST['member_name'], $_POST['member_contact_mail'],$_POST['member_contact_phone'],$_POST['member_type']);
 				}
	 		}
 		}
 	}
?>