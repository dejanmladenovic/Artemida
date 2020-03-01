<?php
	require_once(APPPATH . 'libraries/Classes/Member.php');

	class LoginModel extends CI_Model{
		public function __contruct(){
			$this->load->database();
		}

		public function get_member_name($id){
			$sql="SELECT member.member_type from member WHERE member.member_id = unhex('" . $id . "')";
			$result = $this->db->query($sql);
			if($result->num_rows() == 1){
				return $result->row()->member_public_name;
			}
			else{
				return null;
			}

		}

		public function get_member_type(){
			$this->db->select("member_type");
			$this->db->from("member");
			$this->db->where("member_id = UNHEX('". $_SESSION['member_id'] ."')");
			$result = $this->db->get();

			if($result->result() == null){
				return null;
			}
			return $result->row()->member_type;
		}

		public function email_exists($mail){
			$sql = "SELECT member_public_name FROM member WHERE member_email = '$mail'";
			$result = $this->db->query($sql);
			if($result->num_rows() == 1){
				return $result->row()->member_public_name;
			}
			else
				return "error";
		}

		public function check_user($mail, $pass){
			$sql = "SELECT HEX(member_id) AS member_id, member_type FROM member WHERE member_email = '$mail' AND member_password = '$pass'";
			$result = $this->db->query($sql);
			if($result->num_rows() == 1){
				$row = $result->row();
				$session_data = array('member_id' => $row->member_id,
									'member_logged_in' => 1,
									'member_type' => $row->member_type);
				$this->session->set_userdata($session_data);
				return "success";
			}
			else
				return "error"; 

		}

		public function get_member_by_id($id){
			$this->load->model("ImageModel", "imageModel");
			$this->db->from("member");
			$this->db->where("member_id = '$id'");
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}
			$member = Member::from_row($result->row());
			$member->member_image = $this->imageModel->get_image_by_id($result->row()->member_image_id);
			return $member;
		}

		public function registration_member_name_exists($member_name){
			$sql = "SELECT member_public_name FROM member WHERE  member_public_name = '$member_name'";
			$result = $this->db->query($sql);
			if($result->num_rows() == 1){
				return $result->row()->member_public_name;
			}
			else
				return "error";
		}

		public function add_member($email, $password, $member_name, $member_contact_email, $member_contact_phone, $member_type){
			$sql = "INSERT INTO member(member_id, member_public_name, member_email, member_password, member_register_date, member_contact_mail, memeber_contact_phone, member_type) VALUES(UNHEX(REPLACE(UUID(), '-', '')),'$member_name', '$email', '$password',CURDATE(), '$member_contact_email', '$member_contact_phone','$member_type')";
			$result= $this->db->query($sql);
			$sql = "SELECT member_id FROM member WHERE member_public_name = '$member_name'";
			$result= $this->db->query($sql);
			return $result->row()->member_id;
		}

		public function add_id_profile_image_member($ID, $id_member){
			//$sql = "UPDATE member SET member_image_id = '$ID' WHERE member_id = CAST($id_member AS BINARY)";
			$sql = "UPDATE member SET member_image_id = '$ID' WHERE member_id = CAST('$id_member'AS BINARY)";
			$result = $this->db->query($sql);
		}
	}
?>