<?php 
	class Image
	{
		public $url_small;
		public $url_medium;
		public $url_large;
		public $url_full;

		
		function __construct($image_name = null)
		{
			if($image_name != null){
				$this->url_small = base_url() . "uploads/small/" . $image_name;
				$this->url_medium = base_url() . "uploads/medium/" . $image_name;
				$this->url_large = base_url() . "uploads/large/" . $image_name;
				$this->url_full = base_url() . "uploads/full/" . $image_name;
			}
			else{
				$this->url_small = base_url() . "images/noimage.jpg";
				$this->url_medium = base_url() . "images/noimage.jpg";
				$this->url_large = base_url() . "images/noimage.jpg";
				$this->url_full = base_url() . "images/noimage.jpg";			}
			
		}

	}
?>