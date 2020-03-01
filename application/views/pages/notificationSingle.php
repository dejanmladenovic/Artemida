<div class="container">
	<div class="notification-sender-segment">
		<div class="row">
			<div class="col-lg-6 notification-information">
				<div class="notification-participant-image" style="background-image: url('<?php echo $notification->notification_sender->member_image->url_small?>')">
					
				</div>
				<span><?php echo $notification->notification_sender->member_public_name?></span>
			</div>
			<div class="col-lg-6 send-date">
				<span><?php echo $notification->notification_send_date ?></span>
			</div>
		</div>
		<div class="row notification-map">
			<div id="map">
			
			</div>
		</div>
		<div class="row notification-description">
			<p>
				<?php echo nl2br($notification->notification_description) ?>
			</p>
		</div>
		<div class="notification-gallery">
			<div class="notification-gallery-wrapper">
			<?php foreach($notification->notification_gallery as $image){ ?>
				<a href="<?php $image->url_full?>"  data-lightbox="full" style="background-image: url('<?php $image->url_small ?>');"></a>
			<?php	
			} ?>
			</div>
		</div>	
	</div>
	<div class="notification-responder-segment">
		<?php if($viewer_type == 'member'){ 
				if($notification->notification_responder != null) {?>
					<div class="row no-response">
						<span>Nema dostupnog odgovora.</span>
					</div>
		<?php } else {?>
					<div class="row">
						<div class="col-lg-6 notification-information">
							<div class="notification-participant-image" style="background-image: url('<?php echo $notification->notification_responder->member_image->url_small?>')">
								
							</div>
							<span><?php echo $notification->notification_responder->member_public_name?></span>
						</div>
						<div class="col-lg-6 notification-date">
							<span><?php echo $notification->notification_respond_date ?></span>
						</div>
					</div>
					<div class="row notification-response-description">
						<p>
							<?php echo nl2br($notification->notification_response) ?>
						</p>
					</div>
		<?php } 
			}else{ ?>
				<span>Unesite odgovor</span>
				<textarea name="notification-response">
					
				</textarea>

		<?php } ?>
	</div>
</div>

<script>
	function showMap(){
		var location = {lat: <?php echo $notification->notification_lat ?>, lng: <?php echo $notification->notification_lng ?>};
  		var map = new google.maps.Map(
      	document.getElementById('map'), {zoom: 15, center: location});
		var marker = new google.maps.Marker({map: map, position: location});
		var radius = new google.maps.Circle({map: map,
			radius: <?php echo $notification->notification_radius ?>,
			fillColor: '#777',
			fillOpacity: 0.1,
			strokeColor: '#AA0000',
			strokeOpacity: 0.8,
			strokeWeight: 2,
		});
		radius.setCenter(location);
	}
</script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr4zcWEAVBlD5zV2jRLzX_Fl444Xl1V9k&callback=showMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/light-box/js/lightbox.js"></script>