<?php
	/**
	 * 
	 */
	class Member
	{
		public $member_public_name;
		public $member_contact_mail;
		public $member_contact_phone;
		public $member_image;
		

		public static function from_row($row){
			$instance = new self();
			$instance->load_from_row($row);
			return $instance;
		}

		protected function load_from_row($row){
			$this->member_public_name = $row->member_public_name;
			$this->member_contact_mail = $row->member_contact_mail;
			$this->member_contact_phone = $row->memeber_contact_phone;
		}
	}
?>