<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PetsPost extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header');
		if($this->session->userdata('member_logged_in') != NULL){
			
			$this->load->view('pages/petsPost');
			
		}
		else{
			$this->load->view('pages/noAccess');
		}
		$this->load->view('templates/footer');	
		
	}

	//f-ja za nabavljanje svih dozvoljenih tipova ljubimaca
	public function allowed_pet_types(){
		$this->load->model('PetsModel', 'pets_model');

		echo json_encode($this->pets_model->allowed_pet_types(), JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE je zato sto je rezultat u utf8 formatu
	}

	public function allowed_pet_races($race){
		$this->load->model('PetsModel', 'pets_model');

		echo json_encode($this->pets_model->allowed_pet_races($race), JSON_UNESCAPED_UNICODE);
	}

	public function post_pet(){
		if($this->session->userdata('member_logged_in') != NULL){
			$gallery_id = null;
			$this->load->model('PetsModel', 'pets_model');
			
			if(isset($_POST["pet_name"]) && isset($_POST["pet_description"]) && isset($_POST["pet_type"]) && isset($_POST["pet_race"]) && isset($_POST["pet_size"]) && isset($_POST["pet_sex"]) && isset($_POST["pet_taxonomy"])){
					$this->load->model('PetsModel', 'pets_model');
					$this->load->model('LoginModel', 'login_model');
					

					$gallery_id = null;

					$pet_captured = ($this->login_model->get_member_type($this->session->userdata('member_logged_in')) == "employee") ? 1 : 0;
					

					if(!in_array($_POST["pet_type"], $this->pets_model->allowed_pet_types())){
						echo "Pet type not supported.";
						return;
					}
					if(!in_array($_POST["pet_race"], $this->pets_model->allowed_pet_races($_POST["pet_type"]))){
						echo "Pet race not supported.";
						return;
					}
					if(!in_array($_POST["pet_size"], ["small", "medium", "large", "x-large"])){
						echo "Pet size not supported";
						return;
					}
					if(!in_array($_POST["pet_taxonomy"], ["lost", "found", "adoption"])){
						echo "Pet taxonomy not supported";
						return;
					}
					if(!in_array($_POST["pet_sex"], ["male", "female"])){
						echo "Pet sex not supported";
						return;
					}

					//da li treba slike?
					if(isset($_FILES["pet_images"])){
						$this->load->model('ImageModel', 'imageModel');
	 					
			 			$count = count($_FILES['pet_images']['name']); //koliko slika je poslato
			 			if($count > 5){
			 				echo "5 pictures max.";
			 				return;
			 			}

			 			$gallery_id = $this->imageModel->create_gallery();

			 			for($i = 0; $i < $count; $i++){
			 				$file = array('name' => $_FILES['pet_images']['name'][$i],
			 							'error' => $_FILES['pet_images']['error'][$i],
			 							'tmp_name' => $_FILES['pet_images']['tmp_name'][$i],
			 							'size' => $_FILES['pet_images']['size'][$i],
			 							'type' => $_FILES['pet_images']['type'][$i]
			 				 );
			 				 $result = $this->imageModel->upload_image($file, $gallery_id);
			 			}	
					}

					$this->pets_model->save_pet($_POST['pet_name'], $_POST['pet_description'], $_POST['pet_type'], $_POST['pet_race'], $_POST['pet_size'], $_POST['pet_sex'], $_POST['pet_taxonomy'], 0, $gallery_id);
			}
		}
		else{
			echo "morate biti ulogovani";
		}
	}
}
