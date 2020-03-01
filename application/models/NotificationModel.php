<?php
	require_once(APPPATH . 'libraries/Classes/Notification.php');
	require_once(APPPATH . 'libraries/Classes/Image.php');


	class NotificationModel extends CI_Model{
		public function __contruct(){
			$this->load->database();
		}

		public function save_notification($notification){
			$this->db->set($notification);
			$this->db->insert("notification");

			return ($this->db->affected_rows() != 1) ? "error" : "succes";
		}

		public function get_notification_by_id($id){

			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");

			$this->db->from("notification");
			$this->db->where("notification_id = $id");
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}

			if($this->loginModel->get_member_type() != 'member' || $result->row()->notification_sender_id == hex2bin($_SESSION['member_id'])){
				$notification = Notification::from_row($result->row());
				$notification->notification_gallery = $this->imageModel->get_gallery($result->row()->notification_gallery_id);
				$notification->notification_sender = $this->loginModel->get_member_by_id($result->row()->notification_sender_id);
				$notification->notification_responder = $this->loginModel->get_member_by_id($result->row()->notification_responder_id);
				return $notification;
			}
			else{
				return "nemate pravo pristupa.";
			}

			
			
		}

		public function count_all_notifications($filters){
			$this->db->from("notification");
			$this->db->where($filters);

			return $this->db->count_all_results();
		}

		public function count_my_notifications(){
			$this->db->from("notification");
			$this->db->where("notification_sender_id = '" . hex2bin($_SESSION["member_id"]). "'");

			return $this->db->count_all_results();
		}

		public function get_my_notifications_by_filter($filters, $start, $per_page){
			$notificationArray = [];
			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");
			$this->db->from("notification");
			$this->db->where($filters);
			$this->db->where("notification_sender_id = '" . hex2bin($_SESSION["member_id"]). "'");
			$this->db->limit($per_page, $start);
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}
			foreach ($result->result() as $row) {
				$notificationArray[] = Notification::from_row($row);
				end($notificationArray)->notification_gallery = $this->imageModel->get_gallery($row->notification_gallery_id);
				end($notificationArray)->notification_sender = $this->loginModel->get_member_by_id($row->notification_sender_id);
				end($notificationArray)->notification_responder = $this->loginModel->get_member_by_id($row->notification_responder_id);
			}

			return $notificationArray;
		}

		public function get_notifications_by_filter($filters, $start, $per_page){
			$notificationArray = [];
			$this->load->model("ImageModel", "imageModel");
			$this->load->model("LoginModel", "loginModel");
			$this->db->from("notification");
			$this->db->where($filters);
			$this->db->limit($per_page, $start);
			$result = $this->db->get();
			if($result->result() == null){
				return null;
			}
			foreach ($result->result() as $row) {
				$notificationArray[] = Notification::from_row($row);
				end($notificationArray)->notification_gallery = $this->imageModel->get_gallery($row->notification_gallery_id);
				end($notificationArray)->notification_sender = $this->loginModel->get_member_by_id($row->notification_sender_id);
				end($notificationArray)->notification_responder = $this->loginModel->get_member_by_id($row->notification_responder_id);
			}

			return $notificationArray;
		}

		public function save_response($id, $response){
			$this->db->where('notification_id', $id);
			$this->db->update('notification', $response);
			
			return ($this->db->affected_rows() != 1) ? "error" : "succes";
		}


	}