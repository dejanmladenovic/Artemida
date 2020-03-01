<div class="col-xs-12 edit-page">
	<div class="edit">
		<div class="row">
			<form class="edit-form">
					
				<div class="edit-form-header">
					<span class="instruction-edit">Izmena</span>
				</div>
				<div class="dd">
					 <div class="image-for-profil">
							<img src="" id="src_profile_image">
					</div>
				</div>
				<div class="login-field">
					<span>E-mail:</span>
					<input type="email" name="email" >
				</div>
				<div class="login-field" id="password">
					<span>Lozinka:</span>
					<input type="password" name="password">
				</div>
				<div class="login-field">
					<span>Korisnicko ime:</span>
					<input type="text" name="user-name">
				</div>
				<div class="login-field">
					<span>Kontaknt e-mail:</span>
					<input type="email" name="contact-mail">
				</div>
				<div class="login-field">
					<span>Kontakt telefon:</span>
					<input type="text" name="contact-phone">
				</div>
				<div class="profile-image">
					<span>Nova profilna slika:</span>
					<input type="file" name="images-profile" multiple accept="image/*"/>
				</div>
				<div class="submit-button">
					<button type="button" name="submit">Izmeni</button>
				</div>
			</form>
		</div>
	</div>

	<script src="<?php echo base_url(); ?>js/edit_member.js" type="text/javascript"></script>
	<script>
						var id = "<?= $ID ?>";
						console.log(id);
						fill_in_form(id);
	</script>
</div>
