<?php
	require_once(APPPATH . 'libraries/Classes/Member_private.php');
	require_once(APPPATH . 'libraries/Classes/Image.php');
	class AdminModel extends CI_Model{
		public function __contruct(){
			$this->load->database();
		}

		public function returnMember($id){
			$this->load->model('ImageModel', 'imageModel');
			$ID = hex2bin("$id");
			$sql = "SELECT * FROM member WHERE member_id = '$ID'";
			$result = $this->db->query($sql);
			$member = Member_private::from_row($result->row());
			$member->member_image = $this->imageModel->get_image_by_id($result->row()->member_image_id);
			return $member;
		}

		public function deleteMember($id){
			$ID = hex2bin("$id");
			$sql = "DELETE FROM member WHERE member_id = '$ID'";
			$this->db->query($sql);
		}

		public function editMember($email, $password, $member_name, $member_contact_mail,$member_contact_phone,$member_id){
			$ID = hex2bin($member_id);
			$sql = "UPDATE member SET member_email = '$email', member_password = '$password', member_public_name = '$member_name', member_contact_mail = '$member_contact_mail', memeber_contact_phone = '$member_contact_phone' WHERE member_id = '$ID'";
			return $this->db->query($sql);
		}

		public function showMember($num, $member){
			$sql = "SELECT * FROM member WHERE member_type='$member'";
			$result1 = $this->db->query($sql);
			$br = $result1->num_rows()/10;
			if($num<$br){
				$NUM = $num*10;
				$sql = "SELECT * FROM member WHERE member_type='$member' limit $NUM,10";
				$result = $this->db->query($sql);
				if($result->num_rows() > 0){
					foreach($result->result() as $row){
						$members[] = Member_private::from_row($row);
					 }
					}
	 			
				return $members;
			}
		}
	}
?>