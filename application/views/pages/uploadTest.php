<form>
	<progress name="upload-progress" value="0" max="100"></progress>
	<input type="file" name="images" multiple accept="image/*"/>
	<button type="button" name="submit">Odpremi</button>

	<div class="images-preview">
		<div class="images-vrapper">
			
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url()?>js/upload.js"></script>
</form>