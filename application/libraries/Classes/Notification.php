<?php
	/**
	 * 
	 */
	class Notification
	{
		public $notification_id;
		public $notification_tittle;
		public $notification_description;
		public $notification_sender;
		public $notification_lat;
		public $notification_lng;
		public $notification_radius;
		public $notification_response;
		public $notification_responder;
		public $notification_gallery;
		public $notification_send_date;
		public $notification_respond_date;

		public static function from_row($row){
			$instance = new self();
			$instance->load_from_row($row);
			return $instance;
		}

		protected function load_from_row($row){
			$this->notification_id = $row->notification_id;
			$this->notification_tittle = $row->notification_tittle;
			$this->notification_description = nl2br($row->notification_description);
			$this->notification_lat = $row->notification_lat;
			$this->notification_lng = $row->notification_lng;
			$this->notification_radius = $row->notification_radius;
			$this->notification_response = nl2br($row->notification_response);
			$this->notification_send_date = $row->notification_send_date;
			$this->notification_respond_date = $row->notification_respond_date;
		}

		public function print_as_list_item(){
			$str = '<li class="notification_list_item '; 
				if($this->notification_responder != null)
					$str .= 'answered'; 
				else
					$str .= 'pending';
			$str .= ' list-group-item" onclick="loadNotificationView('. $this->notification_id . ')"><div class="notification-tittle">' . $this->notification_tittle . '</div><div class="notification-send-date">' . $this->notification_send_date . '</div></li>';
			return $str;
		}
	}
?>