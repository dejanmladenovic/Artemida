<?php


	class Member_private{
		public $member_email;
		public $member_image_id;
		public $member_public_name;
		public $member_register_date;
		public $member_type;
		public $member_password;
		public $member_contact_mail;
		public $memeber_contact_phone;
		public $member_id;
		public $member_image;


	public static function from_row($row){
		$instance = new self();
		$instance->load_from_row($row);
		return $instance;
	}

	protected function load_from_row($row){
		$this->member_email = $row->member_email;
		$this->member_image_id = $row->member_image_id;
		$this->member_public_name =$row->member_public_name;
		$this->member_register_date = $row->member_register_date;
		$this->member_type = $row->member_type;
		$this->member_password = $row->member_password;
		$this->member_contact_mail = $row->member_contact_mail;
		$this->memeber_contact_phone = $row->memeber_contact_phone;
		$this->member_id = bin2hex("$row->member_id");
	}

	public function print_html(){
		$str  = '<tr>
					<td>'.$this->member_public_name.'</td>
					<td>'.$this->member_email.'</td>
					<td>'.$this->member_register_date.'</td>
					<td>'.$this->member_password.'</td>
					<td>'.$this->member_contact_mail.'</td>
					<td>'.$this->memeber_contact_phone.'</td>
					<td> <button type="button" id="editButton" name="edit" value="'.$this->member_id.'">Izmeni</button></td>
					<td><button type="button" id="deleteButton" name="delete" value="'.$this->member_id.'">Ukloni</button></td>
				</tr>';
		return $str;
	}

}



?>