<?php 

Class users extends CI_Controller{
 	public function my_account(){

 		$data["page"] = "my_account";
		$this->load->view('templates/header', $data);
 		$this->load->view('pages/myAccount');
 		$this->load->view('templates/footer');
 	}

 	public function returnMember(){
 		if($this->session->userdata('member_logged_in') !=NULL)
 		{
 			$this->load->model('AdminModel', 'adminmodel');
	 			$member = $this->adminmodel->returnMember($this->session->userdata('member_id'));
	 			echo json_encode($member);
 		}
 	}
}
?>