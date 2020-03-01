<?php
	
	class Pet
	{
		public $pet_id;
		public $pet_name;
		public $pet_description;
		public $pet_type;
		public $pet_race;
		public $pet_size;
		public $pet_sex;
		public $pet_taxonomy;
		public $pet_captured;
		public $pet_post_date;
		public $pet_update_date;
		public $gallery;
		public $member;
		
		public static function from_row($row){
			$instance = new self();
			$instance->load_from_row($row);
			return $instance;
		}

		protected function load_from_row($row){
			$this->pet_id = (int)$row->pet_id;
			$this->pet_name = $row->pet_name;
			$this->pet_description = $row->pet_description;
			$this->pet_type = $row->pet_type;
			$this->pet_race = $row->pet_race;

			switch ($row->pet_size) {
				case 'small':
					$this->pet_size = "mali";
					break;
				case 'medium':
					$this->pet_size = "srednja";
					break;
				case 'large':
					$this->pet_size = "veliki";
					break;
				default:
					$this->pet_size = "veoma veliki";
					break;
			}
			$this->pet_sex = ($row->pet_sex = "male")? "mužijak" : "ženka";
			$this->pet_taxonomy = $row->pet_taxonomy;
			$this->pet_captured = (bool)$row->pet_captured;
			$this->pet_post_date = $row->pet_post_date;
			$this->pet_update_date = $row->pet_update_date;
		}

		public function print_html(){
			
			$str = '<div class="puzzle-box col-lg-3 col-md-4 col-sm-6">';
			if($this->pet_captured)
				$str.='<i class="fas fa-paw" title="Ovaj ljubimac se nalazi u sližbi"></i>';
			$str .=				'<div class="adoption-box-outer">
								<a href="'. base_url() . '/pets/single/'. $this->pet_id .'">
									<div class="adoption-box-inner">
										<div class="adoption-pet-image" style="background-image: url(' ."'" . $this->gallery[0]->url_medium ."'" . ')">
											
										</div>
										<div class="adoption-pet-information">
											<span class="pet-name">' . $this->pet_name . '</span>
											<span>' . $this->pet_race . '</span>
											<span>' . $this->pet_sex . '</span>
											<span>' . $this->pet_size . '</span>
										</div>
									</div>
								</a>
							</div>
						</div>';

			return $str;
		}

		public function print_list_html(){
			$str = '<tr>
				      <td><div class="pets-table-image" style="background-image: url(' ."'" . $this->gallery[0]->url_small ."'" . ')"></div></dh>
				      <td><a href="' . base_url() . 'pets/single/'. $this->pet_id . '">'. $this->pet_name .'</a></td>
				      <td>'. $this->pet_post_date .'</td>
				      <td><button type="button" class="btn btn-warning" onclick="updatePetStatus(' . $this->pet_id . ')"><i class="far fa-edit"></i></button></td>
				    </tr>';
			return $str;
		}
	}
?>