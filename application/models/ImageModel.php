<?php
	require_once(APPPATH . 'libraries/ImageResize/ImageEditor.php');

	class ImageModel extends CI_Model
	{
		
		public function upload_image($file, $gallery_id){

			$fullPath = "uploads/full/";
			$largePath = "uploads/large/";
			$mediumPath = "uploads/medium/";
			$smallPath = "uploads/small/";

			
			//proverada da nije doslo do errora
			if($file["error"] !== UPLOAD_ERR_OK){
				echo "Image failed upload. " . $file['error'];
				return;
			}

			//proverava tip, tmp name je mesto na serveru gde se privremeno pamti
			$info = getimagesize($file["tmp_name"]);
			if($info === FALSE){
				echo "Cant determinate image type.";
				return;
			}
			if(($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_PNG) && ($info[2] !== IMAGETYPE_JPEG)){
				echo "File type is not suppored.";
				return;
			}

			//proverava velicina da nije veca od 1.5 MB

			if($file['size'] > 1572864){
				echo "Image size is too large.";
				return;
			}

			$newFileName = $this->generateName($file['name']);
			
			if(move_uploaded_file($file['tmp_name'], $fullPath . $newFileName)){
				//upis imena u bazu
				$sql = "INSERT INTO image(image_upload_date, image_owner, image_name, gallery_id) VALUES (CURDATE(), UNHEX('" .  $_SESSION['member_id'] . "'), '$newFileName', " . $gallery_id . ")";
				$this->db->query($sql);

			
				$smaller_image = new ImageEditor($fullPath . $newFileName);

				$smaller_image->resizeToWithin(1200, 1200)->saveAs($largePath . $newFileName);

				$smaller_image->resizeToWithin(600, 600)->saveAs($mediumPath . $newFileName);

				$smaller_image->resizeToWithin(200, 200)->saveAs($smallPath . $newFileName);

				//vracanje id nove slike
				
				return $this->db->insert_id();
			}			
		}


		//generisanje novog imena za sliku kako ne bi doslo do gazenja
		private function generateName($fileName){
			$fullPath = "uploads/full/";

			if(file_exists($fullPath . $fileName)){
				if($pos = strrpos($fileName, '.')) {
		           $name = substr($fileName, 0, $pos);
		           $ext = substr($fileName, $pos);
			    }else{
			        $name = $fileName;
			    }

			    $counter = 0;
			    
			    do{
			    	$counter++;
					$newName = $name . "_" . $counter . $ext;
					$newPath = $fullPath . $newName;
			    }while(file_exists($newPath));

			    return $newName;
			}
			else{
				return $fileName;
			}
		}


		public function create_gallery(){
			$sql = "INSERT INTO gallery(member_id) VALUES(" . "UNHEX('" . $_SESSION['member_id'] . "')" . ")";
			$this->db->query($sql);

			return $this->db->insert_id();
		}


		public function get_gallery($gallery_id){
			$image_array = null;

			if($gallery_id == null){
				$image_array[] = new Image();
				return $image_array;
			}

			$this->db->select('image_name');
			$this->db->from("image");
			$this->db->where("gallery_id = $gallery_id");
			$result = $this->db->get();
			if($result->result() == null){
				$image_array[] = base_url() . "images/noimage.jpg";
			}
			else{
				foreach ($result->result() as $row) {
					$image_array[] = new Image($row->image_name);
				}
			}
			return $image_array;
		}

		public function get_image_by_id($image_id){
			$this->db->select('image_name');
			$this->db->from("image");
			$this->db->where("image_id = $image_id");
			$result = $this->db->get();
			if($result->result() == null){
				return new Image(null);
			}
			return new Image($result->row()->image_name);
		}

		public function deleteImage($image_id){
			$sql = "DELETE FROM image WHERE image_id = '$image_id'";
			return $this->db->query($sql);
		}

		public function returnImageName($id){
			$sql = "SELECT image_name FROM image WHERE image_id = '$id'";
			$result = $this->db->query($sql);
			return $result->row()->image_name;
		}

		public function upload_image_profile($file, $id_member){
			$fullPath = "uploads/full/";
			$largePath = "uploads/large/";
			$mediumPath = "uploads/medium/";
			$smallPath = "uploads/small/";

			
			//proverada da nije doslo do errora
			if($file["error"] !== UPLOAD_ERR_OK){
				echo "Image failed upload. " . $file['error'];
				return;
			}

			//proverava tip, tmp name je mesto na serveru gde se privremeno pamti
			$info = getimagesize($file["tmp_name"]);
			if($info === FALSE){
				echo "Cant determinate image type.";
				return;
			}
			if(($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_PNG) && ($info[2] !== IMAGETYPE_JPEG)){
				echo "File type is not suppored.";
				return;
			}

			//proverava velicina da nije veca od 1.5 MB

			if($file['size'] > 1572864){
				echo "Image size is too large.";
				return;
			}

			$newFileName = $this->generateName($file['name']);
			
			if(move_uploaded_file($file['tmp_name'], $fullPath . $newFileName)){
				//upis imena u bazu
				$sql = "INSERT INTO image(image_upload_date, image_owner, image_name) VALUES (CURDATE(), '$id_member', '$newFileName')";
				$this->db->query($sql);

			
				$smaller_image = new ImageEditor($fullPath . $newFileName);

				$smaller_image->resizeToWithin(1200, 1200)->saveAs($largePath . $newFileName);

				$smaller_image->resizeToWithin(600, 600)->saveAs($mediumPath . $newFileName);

				$smaller_image->resizeToWithin(200, 200)->saveAs($smallPath . $newFileName);

				//vracanje id nove slike
				
				$sql = "SELECT image_id FROM image WHERE image_name = '$newFileName'";
				$result = $this->db->query($sql);
				return $result->row()->image_id;
			}			
		}
	}

?>