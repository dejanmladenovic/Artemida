<div class="container">
	<div class="row">
		<div class="pet-post-form col-12">
			<form>
				<div class="row pet-post-row">
					<div class="pet-taxonomy-field col-12 pet-post-field">
						<div class="pet-post-field-wrapper">
							<span class="field-label">Kategorija u kojoj treba da se nalazi zivotinja</span>
							<select name="pet-taxonomy">
								<option value="lost">izgubljen</option>
								<option value="found">pronadjen</option>
								<option value="adoption">za usvajanje</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row pet-post-row">
					<div class="pet-name-field col-12 pet-post-field">
						<div class="pet-post-field-wrapper">
							<span class="field-label">Ime ljubimca</span>
							<input type="text" name="pet-name" maxlength="30">
						</div>
					</div>
				</div>
				<div class="row pet-post-row">
					<div class="pet-type-field col-12 col-sm-6 pet-post-field">
						<div class="pet-post-field-wrapper">
						<span class="field-label">Vrsta ljubimca</span>
							<select name="pet-type">
							</select>
						</div>
					</div>
				
					<div class=" pet-race-field col-12 col-sm-6 pet-post-field">
						<div class="pet-post-field-wrapper">
							<span class="field-label">Rasa ljubimca</span>
							<select name="pet-race">
								<option>Nisam siguran</option>
							</select>
						</div>
					</div>
				</div>
				
				
				
				<div class="row pet-post-row">
					<div class="pet-size-field col-12 col-sm-6 pet-post-field">
						<div class="pet-post-field-wrapper">
							<span class="field-label">Veličina ljubimca</span>
							<select name="pet-size">
								<option value='small'>mali (11kg ili manje)</option>
								<option value='medium'>srednji (od 11kg do 27kg)</option>
								<option value='large'>veliki (od 27kg do 45kg)</option>
								<option value='x-large'>veoma veliki (45kg ili više)</option>
							</select>
						</div>
					</div>

					<div class="pet-sex-field col-12 col-sm-6 pet-post-field">
						<div class="pet-post-field-wrapper">
							<span class="field-label">Pol ljubimca</span>
							<select name="pet-sex">
								<option value="male">mužjak</option>
								<option value="female">ženka</option>
							</select>
						</div>
					</div>
				</div>
				

				<div class="row pet-post-row">
					<div class="pet-description-field col-12 pet-post-field">
						<div class="pet-post-field-wrapper">
							<span class="field-label">Opis i dodatne informacije</span>
							<textarea name="pet-description"></textarea>
						</div>
					</div>
				</div>
				
				<div class="row pet-post-row">
					<div class="pet-images-field col-12 pet-post-field">
						<div class="upload-gallery">
							<div class="upload-gallery-wrapper">
							</div>
						</div>
						<span class="field-label">Otpremite fotografije ljubimca (maksimalno 5)</span>
						<div class="upload-button-wrapper">
							<span>Odaberi slike</span>
							<input type="file" id="images-input" name="images" multiple accept="image/*" />
						</div>
					</div>
				</div>

				<button type="button" class="pet-post-submit" name="submit">Postavi ljubimca</button>

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

<script type="text/javascript" src="<?php echo base_url() ?>/js/post-pet.js"></script>
