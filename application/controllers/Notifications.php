<?php
 Class Notifications extends CI_Controller{
 	public function new(){

 		$data["page"] = "send_notification";
 		$this->load->view('templates/header', $data);
 		if($this->session->userdata('member_logged_in') != NULL){
 			$this->load->view('pages/createNotification');
 		}
 		else{
 			$this->load->view('pages/noAccess');
 		}
 		$this->load->view('templates/footer');
 	}

 	public function show_notification($id){
 		$this->load->model("LoginModel", "loginModel");
 		$this->load->model("NotificationModel", "notificationModel");
 		$data = array( 
 			"notification" => $this->notificationModel->get_notification_by_id($id),
 			"viewer_type" => $this->loginModel->get_member_type($_SESSION['member_id'])
 		);
 		$this->load->view('pages/notificationSingle', $data);
 	}

 	public function save_new_notification(){
 		if($this->session->userdata('member_logged_in') != NULL){
 			if(isset($_POST['notification_tittle']) && isset($_POST['notification_description']) && isset($_POST['notification_lat']) && isset($_POST['notification_lng']) && isset($_POST['notification_radius']))
 			{
 				$this->load->model("NotificationModel", "notificationModel");

 				$notification = array(
 					"notification_tittle" => $_POST['notification_tittle'],
 					"notification_description" => $_POST['notification_description'],
 					"notification_lat" => $_POST['notification_lat'],
 					"notification_lng" => $_POST['notification_lng'],
 					"notification_radius" => $_POST['notification_radius'],
 					"notification_sender_id" =>  hex2bin($_SESSION['member_id']),
 					"notification_send_date" => date("Y-m-d H:i:s")
 				);


 				//da li treba slike?
				if(isset($_FILES["notification_images"])){
					$this->load->model('ImageModel', 'imageModel');
 					
		 			$count = count($_FILES['notification_images']['name']); //koliko slika je poslato
		 			if($count > 5){
		 				echo "5 pictures max.";
		 				return;
		 			}

		 			$gallery_id = $this->imageModel->create_gallery();

		 			for($i = 0; $i < $count; $i++){
		 				$file = array('name' => $_FILES['notification_images']['name'][$i],
		 							'error' => $_FILES['notification_images']['error'][$i],
		 							'tmp_name' => $_FILES['notification_images']['tmp_name'][$i],
		 							'size' => $_FILES['notification_images']['size'][$i],
		 							'type' => $_FILES['notification_images']['type'][$i]
		 				 );
		 				 $result = $this->imageModel->upload_image($file, $gallery_id);
		 			}

		 			$notification["notification_gallery_id"] = $gallery_id;	
				}


				echo $this->notificationModel->save_notification($notification);
 			}
 		}
 		else{
 			echo "morate biti ulogovani";
 		}
 	}

 	public function save_response(){
 		if($this->session->userdata('member_logged_in') != NULL){
 			$this->load->model("LoginModel", "loginModel");

 			if( $this->loginModel->get_member_type($_SESSION['member_id']) != 'member'){
 				if(isset($_POST["notification_id"]) && isset($_POST["notification_response"])){
 					$this->load->model("NotificationModel", "notificationModel");

 					$response = array(
 						"notification_response" => $_POST["notification_response"],
 						"notification_responder_id" => hex2bin($_SESSION['member_id']),
 						"notification_respond_date" => date("Y-m-d H:i:s")
 					);
 					echo $this->notificationModel->save_response($_POST["notification_id"], $response);
 				}
 			}
 			else{
 				echo "nemate prava pristupa.";
 			}
 		}
 	}

 	public function pagination($type, $page = 1){

 		if($this->session->userdata('member_logged_in') != 1){
 			echo "morate biti ulogovani.";
 			return;
 		}

 		$filters=[];
		$per_page;

		if(isset($_GET["panding_only"])){
 			$filters["notification_responder"] = null;
 		}
 		if(isset($_GET['per_page']))
 			$per_page = $_GET['per_page'];
		else{
			$per_page= 10;
		}

		$type = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$this->load->model("LoginModel", "loginModel");

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = "#";
		$config["per_page"] = $per_page;
		$config['uri_segment'] = 4;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
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
		$config["num_links"] = 1;
		$config["last_link"] = "<i class='fas fa-angle-double-right'></i>";
		$config["first_link"] = "<i class='fas fa-angle-double-left'></i>";
		$config['first_tag_open'] = '<li class="first-page" onclick="loadPage(this)">';
		$config['attributes']['rel'] = TRUE;
		$config['first_tag_close'] = '</li>';

		if($type == "personal"){
			
			$this->load->model("NotificationModel", "notificationModel");

	 		$list = "";
			$start = ($page - 1) * $per_page;
			$result = $this->notificationModel->get_my_notifications_by_filter($filters, $start, $per_page);
			if($result != null){
				foreach ($result as $notification) {
					$list .= $notification->print_as_list_item();
				};
			}
			else{
				$list = "<span>Nema obaveštenja</span>";
			}

			$config["total_rows"] = $this->notificationModel->count_my_notifications($filters);
			$this->pagination->initialize($config);

			$return_array = array(
				"list" => $list,
				"links" => $this->pagination->create_links()
			);


			echo json_encode($return_array);
			
		}
		elseif($type == "all"){
			if($this->loginModel->get_member_type($_SESSION['member_id']) != 'member'){
				$this->load->model("NotificationModel", "notificationModel");

		 		$list = "";
				$start = ($page - 1) * $per_page;
				$result = $this->notificationModel->get_notifications_by_filter($filters, $start, $per_page);
				if($result != null){
					foreach ($result as $notification) {
						$list .= $notification->print_as_list_item();
					};
				}
				else{
					$list = "<span>Nema obaveštenja</span>";
				}

				$config["total_rows"] = $this->notificationModel->count_all_notifications($filters);
				$this->pagination->initialize($config);

				$return_array = array(
					"list" => $list,
					"links" => $this->pagination->create_links()
				);


				echo json_encode($return_array);
			}
			else{
				echo "nemate prava za pristup.";
			}
		}
 	}

 	public function get_notification($id){
 		$this->load->model("NotificationModel", "notificationModel");
 		echo json_encode($this->notificationModel->get_notification_by_id($id));
 	}

 	public function view_all(){
 		$this->load->model("LoginModel", "loginModel");
 		$data["page"] = "menage_notifications";
 		$this->load->view('templates/header', $data);
 		if($this->session->userdata('member_logged_in') != NULL){
	 		if( $this->loginModel->get_member_type($_SESSION['member_id']) == 'member'){
	 			$this->load->view('pages/noAccess');
	 		}
	 		else{
				$this->load->view('pages/allNotifications');
	 		}
 		}
		$this->load->view('templates/footer');
 	}


 }