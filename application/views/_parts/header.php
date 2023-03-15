<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo !empty($page_title) ? $page_title : 'Keen Kids'; ?></title>
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template -->
	<link href="<?php echo base_url(); ?>assets/css/modern-business.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet"/>
    <!-- Temporary navbar container fix -->
	<style>
	.navbar-toggler {
		z-index: 1;
	}
	 @media (max-width: 576px) {
	nav > .container {
		width: 100%;
	}
	}
	/* Temporary fix for img-fluid sizing within the carousel */
		
	.carousel-item.active,  .carousel-item-next,  .carousel-item-prev {
		display: block;
	}
	</style>
    </head>
    <body>
        <!-- Navigation -->
		<header>
  <div class="container-fluid p-0">
    <div class="top-head inner-head">
      <div class="container top-hd-in">
		<div class="row myaccount">
	  <?php  if(!empty($loggedin_user)){ ?>
		<ul class="nav">
			<li class="nav-item">
				<span class="navbar-text">
				<a class="nav-link" href="<?php echo base_url('student/account/logout'); ?>"><i class="fas fa-unlock"></i></a>
				</span>
			</li>
			<li class="nav-item">
				<span class="navbar-text">
				<a class="nav-link" href="<?php echo base_url('student/account'); ?>"><i class="fas fa-user-plus"></i></a>
				</span>
			</li>
		</ul>
	  <?php  }else { ?>
		<ul class="nav">
			<li class="nav-item">
				<span class="navbar-text">
				<a class="nav-link" href="<?php echo base_url('login'); ?>"><i class="fas fa-lock"></i></a>
				</span>
			</li>
			<li class="nav-item">
				<span class="navbar-text">
				<a class="nav-link" href="#"><i class="fas fa-user-plus"></i></a>
				</span>
			</li>
		</ul>
	  <?php  } ?>
      </div>
        <div class="row top-header-bx">
          <div class="col-lg-2">
            <div class="logo-mn">  <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"></a> </div>
          </div>
          <div class="col-lg-10 align-right">
            <nav class="navbar navbar-toggleable-md navbar-inverse">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
              <div class="container">
                <div class="collapse navbar-collapse" id="navbarExample">
                  <ul class="navbar-nav ml-auto">
					<li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>">Home</a> </li>
					<li class="nav-item"> <a class="nav-link" href="<?php echo base_url('page/about'); ?>">About</a> </li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Courses </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog"> 
					  <?php
					  $courses = get_all_courses();
					  if($courses){ ?>
							<a class="dropdown-item" href="<?php echo base_url().'course'?>">All Courses</a>
					  <?php
						foreach($courses as $course){  ?>
							<a class="dropdown-item" href="<?php echo base_url().'/course/detail/'.$course['course_id'] ?>"><?php echo $course['course_title'] ?></a>
					<?php } 
						} ?>
					  </div>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('page/contact'); ?>">Contact</a> </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
        <div class="row"> </div>
      </div>
    </div>
  </div>
</header>