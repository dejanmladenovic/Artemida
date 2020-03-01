<div class="container">
	<div class="all-notifications-page" pagination-type="all">
		<div class="all-notifications">
			<div class="notification-list">
				<ul class="list-group">
					
				</ul>
				<div class="list-pagination">
					
				</div>
			</div>
		</div>		
	</div>
</div>


<div class="notification-pop-up">
  <div class="container">
  	<div class="close-popup">
  		<i class="fas fa-times" onclick="closePopUp()"></i>
  	</div>
    <div class="notification-sender-segment">
      <div class="row">
        <div class="col-6 notification-information">
          <div class="notification-participant-image">
            
          </div>
          <span></span>
        </div>
        <div class="col-6 notification-date">
          <span></span>
        </div>
      </div>
      <div class="row notification-map">
      	<div class="col-lg-10 col-md-9">
      		<div id="map">
        
        	</div>
      	</div>
        <div class="col-lg-2 col-md-3">
        	<div class="notification-gallery">
		        <div class="notification-gallery-wrapper">
		        </div>
		    </div>
        </div>
      </div>
      <div class="row notification-description">
        <p>
        </p>
      </div>
        
    </div>
    <div class="notification-responder-segment">
      <div class="row">
        <div class="col-6 notification-information">
          <div class="notification-participant-image">
            
          </div>
          <span></span>
        </div>
        <div class="col-6 notification-date">
          <span></span>
        </div>
      </div>

      <div class="row notification-response-description">
      	
  		<textarea name="notification-response">
        	
        </textarea>
      	
        
      </div>
    </div>
    <div class="row">
    	<div class="col">
    		<div class="notification-respond-button">
    			<button type="button" class="btn btn-primary">Odgovori</button>
    		</div>
    	</div>
    </div>
  </div>  
</div>






<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr4zcWEAVBlD5zV2jRLzX_Fl444Xl1V9k&libraries=geometry, drawing"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/light-box/js/lightbox.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/js/load-notifications.js"></script>