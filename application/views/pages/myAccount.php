<div class="container">
  <div class="container emp-profile">
      <form class="profile_form">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="profile-img">
              <img src="" id="image_profile_src" alt=""/>
               <div class="file btn btn-lg btn-primary">
                  Izmeni sliku
                  <input type="file" name="profile_image_edit"/>
               </div>
            </div>
          </div>

          <div class="col-md-8 col-sm-12">
            <div class="row">
              <div class="col-md-7">
                <div class="profile-head">
                  <h4 id="user_name">
                  </h4>
                  <h6 id="type">
                  </h6>
                  
                </div>
              </div>
              <div class="col-md-5 col-sm-12">
                 <button type="button" class="profile-edit-btn" name="btnAddMore" >Izmenite profil</button>
              </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                 <div class="tab-content profile-tab" id="myTabContent">
                   <div id="home">
                     <div class="row">
                       <div class="col-md-6">
                         <label>Korisnicko ime</label>
                       </div>
                       <div class="col-md-6">
                         <input type="text" id="txtUserName" name="txtUserName"/>
                         <!--<p id="user_Name"></p>-->
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <label>Email</label>
                       </div>
                       <div class="col-md-6">
                         <input type="email" id="txtEmail" name="txtEmail"/>
                         <!--  <p id="email"></p> -->
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <label>Lozinka</label>
                       </div>
                       <div class="col-md-6">
                         <input type="password" id="txtPassword" name="txtPassword"/>
                         <!-- <p id="contact_email"></p> -->
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <label>Datum registracije</label>
                       </div>
                       <div class="col-md-6">
                         <p id="data_registration"></p>
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <label>Kontakt email</label>
                       </div>
                       <div class="col-md-6">
                         <input type="text" id="txtContactEmail" name="txtContactEmail"/>
                         <!-- <p id="contact_email"></p> -->
                       </div>
                     </div>
                     <div class="row">
                       <div class="col-md-6">
                         <label>Kontakt telefon</label>
                       </div>
                       <div class="col-md-6">
                         <input type="text" id="txtContactPhone" name="txtContactPhone"/>
                         <!--<p id="number_phone"></p> -->
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
            </div>
          </div>

          </div>  
    </form> 



    <div class="row">
      <div class="col-12 my-notifications" pagination-type="personal">
        <span>Ovde možete pregledati vaša poslata obaveštenja</span>
        <div class="notification-list">
          <ul class="list-group">
            
          </ul>
          <div class="list-pagination">
            
          </div>
        </div>
      </div> 
    </div>

    <div class="row">
        <div class="my-pets col-12">
        <span>Ovde možete pregledati vaša objavljene ljubimce</span>
        <table class="pets-table table table-hover">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Ime</th>
              <th scope="col">Datum objave</th>
              <th scope="col">Izmeni</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <div class="list-pagination table-pegination">
          
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
  </div>  
</div>






<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDr4zcWEAVBlD5zV2jRLzX_Fl444Xl1V9k&libraries=geometry, drawing"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/js/load-notifications.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/profile_page.js"></script>  
<script>
                fill_in_form();
</script>  