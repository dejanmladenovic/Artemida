<?php
	require_once(APPPATH . 'libraries/Classes/Pet.php');


	class PetsModel extends CI_Model{
		public function __contruct(){
			$this->load->database();
		}

		public function allowed_pet_types(){
			$allowed_pets = null;
			$sql = "SELECT DISTINCT pet_type FROM allowed_pets";
			$result = $this->db->query($sql);
			foreach ($result->result() as $row){
				$allowed_pets[] = $row->pet_type;
			}
			return $allowed_pets;
		}

		public function allowed_pet_races($pet_type){
			$allowed_pets = null;
			$sql = "SELECT DISTINCT pet_race FROM allowed_pets WHERE pet_type = '" . urldecode($pet_type) . "'";
			//urldecode($pet_type) jer je utf8 u url-u
			$result = $this->db->query($sql);
			foreach ($result->result() as $row){
				$allowed_pets[] = $row->pet_race;
			}
			return $allowed_pets;
		}

		public function save_pet($pet_name, $pet_description, $pet_type, $pet_race, $pet_size, $pet_sex, $pet_taxonomy, $pet_captured, $gallery_id){
			
			if($gallery_id == null){
				$gallery_id = 'NULL';
			}
			/*
			$data = array(
				'pet_name' => $pet_name,
				'pet_description' => $pet_description,
				'pet_type' => $pet_type,
				'pet_race' => $pet_race,
				'pet_size' => $pet_size,
				'pet_sex' => $pet_sex,
				'pet_taxonomy' => $pet_taxonomy,
				'pet_captured' => $pet_captured,
				'gallery_id' => $gallery_id,
				'member_id' => hex2bin('B7981AFD676111E99C9794DE8021B409')
			);*/

			$taxonomy = ($_SESSION['member_type']!="member")? 1 : 0;

			$sql = "INSERT INTO `pet`(`pet_name`, `pet_description`, `pet_type`, `pet_race`, `pet_taxonomy`, `pet_post_date`, `pet_update_date`, `member_id`, `pet_size`, `pet_sex`, `pet_captured`, `gallery_id`) VALUES ('$pet_name', '$pet_description', '$pet_type', '$pet_race', '$pet_taxonomy', CURDATE(), CURDATE(), UNHEX('" .  $_SESSION['member_id'] . "'), '$pet_size', '$pet_sex', $taxonomy, $gallery_id)";
			
			
			$result = $this->db->query($sql);

			if($this->db->affected_rows() != 1){
				echo "error";
			}
			else{
				echo "succes";
			}

		}

		public function update_pet($id){
			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");
			$this->db->where("pet_id = $id");
			$this->db->where("member_id = '" . hex2bin($_SESSION["member_id"]). "'");
			$data = array(
				"pet_status" => 1,
				"pet_update_date" => date("Y-m-d")
			);
			$this->db->update('pet', $data);
			
			return ($this->db->affected_rows() != 1) ? "error" : "succes";
		}

		public function count_all_pets($filters){
			
			$this->db->from("pet");
			$this->db->where($filters);

			return $this->db->count_all_results();

		}

		public function get_pets_by_filter($filters, $start, $per_page){
			$petsArray = [];
			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");
			$this->db->from("pet");
			$this->db->where($filters);
			$this->db->limit($per_page, $start);
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}
			foreach ($result->result() as $row) {
				$petsArray[] = Pet::from_row($row);
				end($petsArray)->gallery = $this->imageModel->get_gallery($row->gallery_id);
				end($petsArray)->member = $this->loginModel->get_member_by_id($row->member_id);
			}


			return $petsArray;
		}

		public function get_my_pets($start, $per_page){
			$petsArray = [];
			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");
			$this->db->from("pet");
			$this->db->where("member_id = '" . hex2bin($_SESSION["member_id"]). "' AND pet_status = 0");
			$this->db->limit($per_page, $start);
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}
			foreach ($result->result() as $row) {
				$petsArray[] = Pet::from_row($row);
				end($petsArray)->gallery = $this->imageModel->get_gallery($row->gallery_id);
				end($petsArray)->member = $this->loginModel->get_member_by_id($row->member_id);
			}

			return $petsArray;
		}

		public function count_my_pets(){
			$this->db->from("pet");
			$this->db->where("member_id = '" . hex2bin($_SESSION["member_id"]). "'");

			return $this->db->count_all_results();
		}

		public function get_pet_by_id($id){
			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");
			$this->db->from("pet");
			$this->db->where("pet_id = $id");
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}
			$pet = Pet::from_row($result->row());
			$pet->gallery = $this->imageModel->get_gallery($result->row()->gallery_id);
			$pet->member = $this->loginModel->get_member_by_id($result->row()->member_id);
			return $pet;
		}
	}