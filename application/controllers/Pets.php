<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Classes/Image.php');
require_once(APPPATH . 'libraries/Classes/Pet.php');

class Pets extends CI_Controller {

	public function index()
	{
		$data = [];
		if (isset($_GET['taxonomy'])) {
			$data["taxonomy"] = $_GET['taxonomy'];
		}
		else{
			$data["taxonomy"] = 'adoption';
		}
		$data["page"] = "pets";
		$this->load->view('templates/header', $data);
		$this->load->view('pages/browsePets', $data);
		$this->load->view('templates/footer');
	}

	public function pagination($type, $page=1){
		$filters=[];

		
		
		if(isset($_GET['per_page']))
 			$per_page = $_GET['per_page'];
		else{
			$per_page= 20;
		}

		$type = $this->uri->segment(3);

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = "#";
		$config['uri_segment'] = 4;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		
		$config["num_links"] = 1;
		$config["last_link"] = "<i class='fas fa-angle-double-right'></i>";
		$config["first_link"] = "<i class='fas fa-angle-double-left'></i>";
		$config['attributes']['rel'] = TRUE;
		$config['first_tag_close'] = '</li>';

		if($type == "personal"){
			
			$this->load->model("PetsModel", "petsModel");

			$puzzle = "";
			$per_page = 10;
 			$start = ($page - 1) * $per_page;
			$result = $this->petsModel->get_my_pets($start, $per_page);
			if($result != null){
				foreach ($result as $pet) {
					$puzzle .= $pet->print_list_html();
				};
			}
			else{
				$puzzle = "<span>Nema objavljenih ljubimaca</span>";
			}

			$config["total_rows"] = $this->petsModel->count_my_pets();
			$config["per_page"] = $per_page;
			$config["first_tag_open"] = '<li onclick="loadPetsPage(this)">';
			$config["first_tag_close"] = '</li>';
			$config["last_tag_open"] = '<li onclick="loadPetsPage(this)">';
			$config["last_tag_close"] = '</li>';
			$config['next_link'] = '<i class="fas fa-arrow-right"></i>';
			$config["next_tag_open"] = '<li onclick="loadPetsPage(this)">';
			$config["next_tag_close"] = '</li>';
			$config["prev_link"] = "<i class='fas fa-arrow-left'></i>";
			$config["prev_tag_open"] = "<li onclick='loadPetsPage(this)'>";
			$config["prev_tag_close"] = "</li>";
			$config["cur_tag_open"] = "<li class='active'>";
			$config["cur_tag_close"] = "</li>";
			$config["num_tag_open"] = "<li onclick='loadPetsPage(this)'>";
			$config["num_tag_close"] = "</li>";
			$config['first_tag_open'] = '<li class="first-page" onclick="loadPetsPage(this)">';
			$this->pagination->initialize($config);

			$return_array = array(
				"list" => $puzzle,
				"links" => $this->pagination->create_links()
			);


			echo json_encode($return_array);
			
		}
		elseif($type == "all"){

	 		$this->load->model("PetsModel", "petsModel");

	 		if(isset($_GET['pet_taxonomy']))
				$filters["pet_taxonomy"] = $_GET['pet_taxonomy'];
			if(isset($_GET['pet_name']))
				$filters["pet_name LIKE"] = $_GET['pet_name'];
			if(isset($_GET['pet_type']))
				$filters["pet_type"] = $_GET['pet_type'];
			if(isset($_GET['pet_race']))
				$filters["pet_race"] = $_GET['pet_race'];
			if(isset($_GET['pet_size']))
				$filters["pet_size"] = $_GET['pet_size'];
			if(isset($_GET['pet_sex']))
				$filters["pet_sex"] = $_GET['pet_sex'];

			$filters["pet_status"] = 0;

			$puzzle = "";
			$start = ($page - 1) * $per_page;
			$result = $this->petsModel->get_pets_by_filter($filters, $start, $per_page);
			if($result != null){
				foreach ($result as $pet) {
					$puzzle .= $pet->print_html();
				};
			}
			else{
				$puzzle = "<span>Nema rezultata sa unetim filterima</span>";
			}
			$config["first_tag_open"] = '<li onclick="loadPage(this)">';
			$config["first_tag_close"] = '</li>';
			$config["last_tag_open"] = '<li onclick="loadPage(this)">';
			$config["last_tag_close"] = '</li>';
			$config['next_link'] = '<i class="fas fa-arrow-right"></i>';
			$config["next_tag_open"] = '<li onclick="loadPage(this)">';
			$config["next_tag_close"] = '</li>';
			$config["prev_link"] = "<i class='fas fa-arrow-left'></i>";
			$config["prev_tag_open"] = "<li onclick='loadPage(this)'>";
			$config["prev_tag_close"] = "</li>";
			$config["cur_tag_open"] = "<li class='active'>";
			$config["cur_tag_close"] = "</li>";
			$config["num_tag_open"] = "<li onclick='loadPage(this)'>";
			$config["num_tag_close"] = "</li>";
			$config['first_tag_open'] = '<li class="first-page" onclick="loadPage(this)">';
			$config["total_rows"] = $this->petsModel->count_all_pets($filters);
			$config["per_page"] = $per_page;
			$this->pagination->initialize($config);

			$return_array = array(
				"puzzle" => $puzzle,
				"links" => $this->pagination->create_links()
			);


			echo json_encode($return_array);
		}

	}

	public function getPet($id){
		$this->load->model("PetsModel", "petsModel");
		echo $this->petsModel->get_pets_by_filter();
	}

	public function single($id){
		$this->load->model("PetsModel", "petsModel");
		$data = array("pet" => $this->petsModel->get_pet_by_id($id));
		$this->load->view('templates/header');
		
		if($data["pet"] == null){
			$this->load->view('pages/404');
		}
		else{
			$this->load->view('pages/petSingle', $data);
		}

		$this->load->view('templates/footer');
	}

	public function update_pet($id){
		$this->load->model("PetsModel", "petsModel");
		echo $this->petsModel->update_pet($id);
	}
}
