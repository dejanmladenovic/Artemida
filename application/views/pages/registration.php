<div class="col-xs-12 registration-page">
	<div class="registration">
		<div class="row">
			<form class="registration-form">
				<div class="registration-form-header">
					<span class="instruction-registration">Registruj se</span>
				</div>
				<div class="login-field">
					<span>E-mail:</span>
					<input type="email" name="registration-email">
				</div>
				<div class="login-field" id="registration-password">
					<span>Lozinka:</span>
					<input type="password" name="registration-password">
				</div>
				<div class="login-field" id="registration_password_replay">
					<span>Ponovite lozinku:</span>
					<input type="password" name="registration-password-replay">
				</div>
				<div class="login-field">
					<span>Korisnicko ime:</span>
					<input type="text" name="registration-member-name">
				</div>
				<div class="login-field">
					<span>Kontaknt e-mail:</span>
					<input type="email" name="member-contact-mail">
				</div>
				<div class="login-field">
					<span>Kontakt telefon:</span>
					<input type="text" name="member-contact-phone">
				</div>
				<div class="profile-image">
					<span>Profilna slika:</span>
					<input type="file" name="images-profile" multiple accept="image/*"/>
				</div>
				<div class="registration-submit-button">
					<button type="button" name="registration-submit">Registruj</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url()?>js/registration.js"></script>
</div>