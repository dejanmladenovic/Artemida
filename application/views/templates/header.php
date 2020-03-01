<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!isset($page)){
	$page = "home";
}
?><!DOCTYPE html>
<html lang="srb">
	<head>
		<title>Projekat</title>
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/navigation.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/light-box/css/lightbox.css">
		<script type="text/javascript" src="<?php echo base_url() ?>js/main.js"></script>
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	</head>
<body>


	<nav class="navbar navbar-expand-lg">
	    <a class="navbar-brand" href="<?php echo base_url()?>home">
	    	<img src="<?php echo base_url()?>/images/logocrop.png">
	    </a>
		

	    <div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php if($page == "home") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "home"?>" >Pocetna <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item has-sub-menu <?php if($page == "pets") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "pets"?>">Ljubimci</a>
				  <ul class="sub-menu">
					<li class="sub-nav-item <?php if($page == "adoption") echo "active"?>">
						<a href="<?php echo base_url() . "pets?taxonomy=adoption"?>">Usvajanje</a>
					</li>
					<li class="sub-nav-item <?php if($page == "lost") echo "active"?>">
						<a href="<?php echo base_url() . "pets?taxonomy=lost"?>">Izgubljeni</a>
					</li>
					<li class="sub-nav-item <?php if($page == "found") echo "active"?>">
						<a href="<?php echo base_url() . "pets?taxonomy=found"?>">Pronadjeni</a>
					</li>
					<li class="sub-nav-item <?php if($page == "add") echo "active"?>">
						<a href="<?php echo base_url() . "petspost"?>">Dodaj svog</a>
					</li>
				  </ul>
				</li>
				<?php if(isset($_SESSION["member_id"])){?>
				<li class="nav-item <?php if($page == "my_account") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "users/my_account"?>">Moj nalog</a>
				</li>
			<?php }?>
				<li class="nav-item <?php if($page == "send_notification") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "notifications/new"?>">Obavesti nas</a>
				</li>
				<?php if(isset($_SESSION["member_type"]) && $_SESSION["member_type"] != "member"){?>
				<li class="nav-item <?php if($page == "menage_notifications") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "notifications/view_all"?>">Obaveštenja</a>
				</li>
				<?php }?>
				<?php if(isset($_SESSION["member_type"]) && $_SESSION["member_type"] == "admin"){?>
				<li class="nav-item <?php if($page == "admin") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "AdminController"?>">Upravljanje clanovima</a>
				</li>
				<?php }?>

				<li class="nav-item <?php if($page == "login") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "login"?>">Ulogujte se</a>
				</li>
			</ul>
		</div>

		<div class="mobile-menu-show" onclick="openMobileMenu()">
		    <i class="fas fa-bars"></i>
		</div>
  	</nav>

  	<div class="mobile-navigation">
  		<nav>

  			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php if($page == "home") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "home"?>" >Pocetna <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item has-sub-menu <?php if($page == "pets") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "pets"?>">Ljubimci</a>
				  <div class="open-sub-menu" onclick="openSubMenu(this)">
				  	<i class="fas fa-chevron-right"></i>
				  </div>
				  <ul class="sub-menu">
					<li class="sub-nav-item <?php if($page == "adoption") echo "active"?>">
						<a href="<?php echo base_url() . "pets?taxonomy=adoption"?>">Usvajanje</a>
					</li>
					<li class="sub-nav-item <?php if($page == "lost") echo "active"?>">
						<a href="<?php echo base_url() . "pets?taxonomy=lost"?>">Izgubljeni</a>
					</li>
					<li class="sub-nav-item <?php if($page == "found") echo "active"?>">
						<a href="<?php echo base_url() . "pets?taxonomy=found"?>">Pronadjeni</a>
					</li>
					<li class="sub-nav-item <?php if($page == "add") echo "active"?>">
						<a href="<?php echo base_url() . "petspost"?>">Dodaj svog</a>
					</li>
				  </ul>
				</li>
				<li class="nav-item <?php if($page == "my_account") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "users/my_account"?>">Moj nalog</a>
				</li>
				<li class="nav-item <?php if($page == "send_notification") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "notifications/new"?>">Obavesti nas</a>
				</li>
				<?php if(isset($_SESSION["member_type"]) && $_SESSION["member_type"] != "member"){?>
				<li class="nav-item <?php if($page == "menage_notifications") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "notifications/view_all"?>">Obaveštenja</a>
				</li>
				<?php }?>
				<?php if(isset($_SESSION["member_type"]) && $_SESSION["member_type"] == "admin"){?>
				<li class="nav-item <?php if($page == "admin") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "AdminController"?>">Upravljanje clanovima</a>
				</li>
				<?php }?>
				<li class="nav-item <?php if($page == "login") echo "active"?>">
				  <a class="nav-link" href="<?php echo base_url() . "login"?>">Ulogujte se</a>
				</li>
			</ul>  			
  		</nav>
  	</div>
	<div class="page-content">

