<div class="container">
	<div class="row">
		<div class="col notification-form">
			<form>
				<div class="notification-form-field">
					<div class="notification-field-wrapper">
						<span class="notification-field-label">Naslov obaveštenja</span>
						<input type="text" name="notification-tittle" maxlength="50">
					</div>
				</div>

				<div class="notification-form-field">
					<div class="notification-field-wrapper">
						<span class="notification-field-label">Opis obaveštenja</span>
						<textarea name="notification-description">
							
						</textarea>
					</div>
					
				</div>
				
				<div class="notification-form-field">
					<div class="notification-image-upload-field">
						<span class="notification-field-label">Slike(maksimalno 5)</span>
						<div>
							<div class="upload-gallery">
								<div class="upload-gallery-wrapper">

								</div>
							</div>
						</div>
						<div class="upload-button-wrapper">
								<span>Odaberi slike</span>
								<input type="file" id="images-input" name="images" multiple accept="image/*" />
						</div>	
					</div>
					
				</div>

				<div class="notification-map-field">
					<span class="notification-field-label">Odaberite na mapi površinu na kojoj ste videli psa</span>
					<div id="map">
	
					</div>
				</div>

				<button type="button" class="pet-post-submit" name="submit">Pošalji obaveštenje</button>


				<div class="loading-animation-wrapper">
					
				</div>
			</form>
			
			<div class="post-status post-success">
				<i class="fas fa-check-circle"></i>
				<span>Uspesno poslato obaveštenje.</span>
			</div>
			<div class="post-status post-error">
				<i class="fas fa-exclamation-circle"></i>
				<span>Došlo je do greške tokom slanja.</span>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript" src="<?php echo base_url()?>/js/notifications.js"></script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr4zcWEAVBlD5zV2jRLzX_Fl444Xl1V9k&callback=initMap">
</script>

<script type="text/javascript" src="<?php echo base_url()?>/js/image-upload-thumbnail.js"></script>