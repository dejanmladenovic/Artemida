
<div class="container">
	<div class="row">
		<div class="view-pet-page col-12">
			<div class="view-pet-landing">
				<div class="row pet-name">
					<h3><?php echo $pet->pet_name; ?></h3>
				</div>
				<div class="row">
					<div class="pet-photos-slider col-lg-8 col-md-12">
						<div class="pet-photos-slider-slides shadow">
						<?php
							foreach ($pet->gallery as $image) { ?>
								
								<div class="mySlides fade-slide" style="background-image: url('<?php echo $image->url_large?>')">
									
									<a href="<?php echo $image->url_full ?>" data-lightbox="full"><i class="fas fa-search"></i></a>
								</div>

							<?php
							}

							if(count($pet->gallery) > 1){?>
								<a class="prev-slide" onclick="plusSlides(-1)">&#10094;</a>
  								<a class="next-slide" onclick="plusSlides(1)">&#10095;</a>
							<?php
							}
						?>

						</div>
						<div class="pet-photos-slider-bullets">
						<?php
							for($i = 0; $i < count($pet->gallery); $i++) {?>
								<span class="bullet" onclick="currentSlide(1)"></span> 
						<?php }
						?>
						</div>
					</div>
					<div class="pet-facts col-lg-4 col-md-12 shadow">
						<ul class="pet-information-list">
							<li><span>Tip ljubimca: </span><?php echo $pet->pet_type; ?></li>
							<li><span>Rasa ljubimca: </span><?php echo $pet->pet_race; ?></li>
							<li><span>Pol ljubimca: </span><?php echo $pet->pet_sex; ?></li>
							<li><span>Veličina ljubimca: </span><?php echo $pet->pet_size; ?></li>
						</ul>

						<div class="owner-information">
							<span>Postavio: </span>
							<div class="owner-image" style="background-image: url('<?php echo $pet->member->member_image->url_small?>')">
								
							</div>
							<span class="owner-name"><?php echo $pet->member->member_public_name?></span>
						</div>
					</div>
				</div>
			</div>

			<?php if($pet->pet_description != null || $pet->pet_description != "") {?>
				<div class="row">
					<div class="col-12 pet-description shadow ">
						<h4>Opis</h4>
						<article>
							<?php  echo nl2br($pet->pet_description) ?>
						</article>
					</div>
				</div>
			<?php } ?>
			

			<div class="row">
				<div class="col-12 owner-contact shadow">
					<h4>Kontakt</h4>
					<div class="row">
						<?php if($pet->member->member_contact_phone != null || $pet->member->member_contact_phone !=""){ ?>

							<div class="col-lg col-sm-12 contact-phone">
								<span>Telefon:</span>
								<a href="tel:<?php echo $pet->member->member_contact_phone?>"> <?php echo $pet->member->member_contact_phone?> </a>
							</div>
						<?php		
						}
						if($pet->member->member_contact_mail != null || $pet->member->member_contact_mail !=""){ ?>

							<div class="col-lg col-sm-12 contact-phone">
								<span>E-mail:</span>
								<a href="mailto:<?php echo $pet->member->member_contact_mail?>"> <?php echo $pet->member->member_contact_mail?> </a>
							</div>
						<?php		
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>/js/fade-slider.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/light-box/js/lightbox.js"></script>
</script>