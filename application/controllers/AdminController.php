<?php
 Class AdminController extends CI_Controller{
 	public function index(){
 		$data["page"] = "admin";
		$this->load->view('templates/header', $data);
 		if($_SESSION["member_type"] == "admin"){
	 		$this->load->view('pages/admin_page');
 		}
 		else{
 			$this->load->view('pages/noAccess');
 		}
 		$this->load->view('templates/footer');
 		
 	}

 	function returnAllMember(){
 		if(isset($_GET['member_type'])){
 			$this->load->model('AdminModel', 'adminmodel');
 			$niz = $this->adminmodel->returnAllMember($_GET['member_type']);
 			$html ="";
 			foreach($niz as $member){
 				$html .= $member->print_html();
 			}
 			echo $html; 
 			}			
 		}

	 function returnMember(){
	 		if(isset($_GET['id'])){
	 			$this->load->model('AdminModel', 'adminmodel');
	 			$member = $this->adminmodel->returnMember($_GET['id']);
	 			echo json_encode($member);
	 		}
	 	}

 	function deleteMember(){
 		if(isset($_GET['id'])){
 			$this->load->model('AdminModel', 'adminmodel');
 			$member = $this->adminmodel->returnMember($_GET['id']);
 			if($member->member_image_id != 0){
 				$image_id = $member->member_image_id;
 				$this->adminmodel->deleteMember($_GET['id']);
 				$this->load->model('ImageModel', 'imagemodel');
 				echo $this->imagemodel->deleteImage($image_id);
 			}
 			else{
 				$this->adminmodel->deleteMember($_GET['id']);
 			}
 		}
 	}

 	function edit(){
 		if(isset($_GET['id'])){
 			$data = [];
 			$data["ID"] = $_GET['id'];
 			$this->load->view('templates/header');
 			$this->load->view('pages/edit_page', $data);
 		}
 	}
 	function editMember(){
 		if(isset($_FILES['images'])){
	 				$this->load->model('ImageModel', 'imageModel');
	 				$count = count($_FILES['images']['name']);
	 				if($count > 1){
	 					echo "Vise od jedne slike je izabrano za dodavanje";
	 					exit;
	 				}

	 				if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['member_name'])){
	 					if($_POST['member_image_id'] !=null){
	 						$this->imageModel->deleteImage($_POST['member_image_id']);  //ako korisnik ima pofilnu sliku i zeli da je promeni, ovde se brise stara iz baze
	 					}
 						$this->load->model('AdminModel', 'adminmodel');
 						$this->adminmodel->editMember($_POST['email'], $_POST['password'], $_POST['member_name'], $_POST['member_contact_mail'],$_POST['member_contact_phone'], $_POST['member_id']);

	 				for($i = 0; $i < $count; $i++){
	 					$file = array('name' => $_FILES['images']['name'][$i],
	 								'error' => $_FILES['images']['error'][$i],
	 								'tmp_name' => $_FILES['images']['tmp_name'][$i],
	 								'size' => $_FILES['images']['size'][$i],
	 								'type' => $_FILES['images']['type'][$i]
	 					 );
	 				}
	 					$id_member = hex2bin($_POST['member_id']);
	 				 	$result = $this->imageModel->upload_image_profile($file, $id_member);
	 				 	if($result > 0){
	 				 		$this->load->model('LoginModel', 'loginmodel');
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
 				$this->load->model('AdminModel', 'adminmodel');
 				echo $this->adminmodel->editMember($_POST['email'], $_POST['password'], $_POST['member_name'], $_POST['member_contact_mail'],$_POST['member_contact_phone'], $_POST['member_id']);
 				}
	 		}
 	}

 	function showMember(){
 		if(isset($_GET['num']) && isset($_GET['member'])){
 			$this->load->model('AdminModel', 'adminmodel');
 			$niz = $this->adminmodel->showMember($_GET['num'], $_GET['member']);
 			if($niz==null){
 				return;
 			}
 			$html ="";
 			foreach($niz as $member){
 				$html .= $member->print_html();
 			}
 			echo $html;
 			}
 		}
 	public function retrunImageName(){
 		if(isset($_GET['id']))
 		{
 			$this->load->model('ImageModel', 'imageModel');
 			echo $this->imageModel->returnImageName($_GET['id']);
 		}
 	}
}
?>