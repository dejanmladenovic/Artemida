     
<div class="admin-page">
        <title>Upravljanje</title>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <div class = "sidebarView">
                <nav id="sidebar">
                    <ul class="list-unstyled components">
                        <p>Upravljanje clanovima</p>
    					 <li class>
                            <a href="#" name="show_members">Prikazi korisnike</a>
                        </li>
                        <li>
                            <a href="#" name="show_worker">Prikazi radnike</a>
                        </li>
                        <li>
                            <a href="#" name="add_members">Dodaj radnike</a>
                        </li>
                       
                    </ul>

                  
                </nav>
            </div>

            <!-- Page Content Holder -->
            <div id="content">

                    <div class="container-fluid">

                      <div class="dropdown">
                        <div class = "mobile-menu-show">
                            <button class="menu_button">
                                Upravljanje clanovima
                            </button>
                        </div>
                              <div class="dropdown-content">
                                    <a href="#" name="show_members_dropdown">Prikazi korisnike</a>
                                    <a href="#" name="show_worker_dropdown">Prikazi radnike</a>
                                    <a href="#" name="add_members_dropdown">Dodaj radnike</a>
                              </div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            
                        </div>
                    </div>
                </div>
                <form class="admin-page-form">
                    <div class="table_member">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">Korisnicko ime</th>
                              <th scope="col">E-mail</th>
                              <th scope="col">Datum registracije</th>
                              <th scope="col">Sifra</th>
                              <th scope="col">Kontakt e-mail</th>
                              <th scope="col">Kontakt telefon</th>
                            </tr>
                          </thead>
                          <tbody name= "table_member">
                            
                          </tbody>
                        </table>
                        <div class="buttonNextPrev">
                             <button type="button" id="buttonPrev" name="buttonPrev">< Vrati</button>
                             <button type="button" id="buttonNext" name="buttonNext">Dalje ></button>
                        </div>
                    </div>

                
                <div class="col-xs-12 registration-page">
                    <div class = "add_worker_form">
                        <div class="row">
                            <div class="add_worker">
                                <div class="registration-form-header">
                                    <span class="instruction-registration">Unesite podataka o novom radniku</span>
                                </div>
                                <div class="login-field">
                                    <span>E-mail:</span>
                                    <input type="email" name="email">
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
                                    <span>Profilna slika:</span>
                                    <input type="file" name="images-profile" multiple accept="image/*"/>
                                </div>
                                <div class="registration-submit-button">
                                    <button type="button" name="submit">Dodaj</button>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </form>
            </div>
        </div>




        <!------------------------------------------------------------------------------->

       <script type="text/javascript" src="<?php echo base_url()?>js/admin_page.js"></script>
       <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
       <link rel="stylesheet" href="css/style_admin_page.css">
      <!-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
</div>
