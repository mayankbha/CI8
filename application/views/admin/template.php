<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $page_title; ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/dist/css/prism.css'); ?>">

		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/dist/css/chosen.css'); ?>">

		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/Ionicons/css/ionicons.min.css'); ?>">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/dist/css/AdminLTE.min.css'); ?>">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/dist/css/skins/_all-skins.min.css'); ?>">
		<!-- Morris chart -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/morris.js/morris.css'); ?>">
		<!-- jvectormap -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/jvectormap/jquery-jvectormap.css'); ?>">
		<!-- Date Picker -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
		<!-- Select2 -->
  		<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/select2/dist/css/select2.min.css'); ?>">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

		<!-- jQuery 3 -->
		<script src="<?php echo site_url('../assets/admin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
		<script src="<?php echo site_url('../assets/admin/js/nicEdit-latest.js'); ?>"></script>
		
		<script>
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>

		<script type="">
			var base_url = "<?php echo base_url(); ?>";
			var base_url_admin = "<?php echo base_url('admin'); ?>/";
		</script>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="<?php echo base_url(); ?>" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>LMS</b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>LMS</b>App</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">



		<!-- User Account: style can be found in dropdown.less -->
		<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="<?php echo get_user_image_url($loggedin_user->user_image); ?>" class="user-image" alt="<?php echo $loggedin_user->user_first_name; ?>">
				<span class="hidden-xs"><?php echo $loggedin_user->user_first_name; ?> <?php echo $loggedin_user->user_last_name; ?></span>
			</a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header">
					<img src="<?php echo get_user_image_url($loggedin_user->user_image); ?>" class="img-circle" alt="<?php echo $loggedin_user->user_first_name; ?>">
					<p>
						<?php echo $loggedin_user->user_first_name; ?> <?php echo $loggedin_user->user_last_name; ?>
						<small>Member since <?php echo date('M, Y', strtotime($loggedin_user->user_created_at)); ?></small>
					</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="pull-left">
						<a href="#" class="btn btn-default btn-flat">Profile</a>
					</div>
					<div class="pull-right">
						<a href="<?php echo site_url(); ?>/admin/account/logout" class="btn btn-default btn-flat">Sign out</a>
					</div>
				</li>
			</ul>
		</li>

	</ul>
</div>
</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
<!-- Sidebar user panel -->
<div class="user-panel">
	<div class="pull-left image">
		<img src="<?php echo get_user_image_url($loggedin_user->user_image); ?>" class="img-circle" alt="<?php echo $loggedin_user->user_first_name; ?>">
	</div>
	<div class="pull-left info">
		<p><?php echo $loggedin_user->user_first_name; ?> <?php echo $loggedin_user->user_last_name; ?></p>
	</div>
</div>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
	<li class="header">MAIN NAVIGATION</li>

	<li class="<?php echo $admin_current_url == 'user' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/user'); ?>">
			<i class="fa fa-user"></i> <span>Users</span>
		</a>
	</li>
	<li class="<?php echo $admin_current_url == 'category' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/category'); ?>">
			<i class="fa fa-tags"></i> <span>Categories</span>
		</a>
	</li>
	<li class="<?php echo $admin_current_url == 'course' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/course'); ?>">
			<i class="fa fa-book"></i> <span>Courses</span>
		</a>
	</li>
	<li class="<?php echo $admin_current_url == 'chapter' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/chapter'); ?>">
			<i class="fa fa-user"></i> <span>Chapters</span>
		</a>
	</li>
	<li class="<?php echo $admin_current_url == 'lesson' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/lesson'); ?>">
			<i class="fa fa-user"></i> <span>Lessons</span>
		</a>
	</li>

	<li class="<?php echo $admin_current_url == 'quiz' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/quiz'); ?>">
			<i class="fa fa-trophy"></i> <span>Quizzes</span>
		</a>
	</li>

	<li class="<?php echo $admin_current_url == 'lesson_quiz' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/lesson_quiz'); ?>">
			<i class="fa fa-trophy"></i> <span>Lesson & Quizes</span>
		</a>
	</li>
	<li class="<?php echo $admin_current_url == 'package' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/package'); ?>">
			<i class="fa fa-trophy"></i> <span>Package</span>
		</a>
	</li>
	<li class="<?php echo $admin_current_url == 'badges' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/badges'); ?>">
			<i class="fa fa-trophy"></i> <span>Badges</span>
		</a>
	</li>
	
	<li class="<?php echo $admin_current_url == 'testimonial' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/testimonial'); ?>">
			<i class="fa fa-trophy"></i> <span>Testimonials</span>
		</a>
	</li>
	
	<li class="<?php echo $admin_current_url == 'news' ? 'active' : ''; ?>">
		<a href="<?php echo site_url('admin/news'); ?>">
			<i class="fa fa-trophy"></i> <span>News & Update</span>
		</a>
	</li>

</ul>
</section>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<?php $this->load->view($page_content); ?>

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">

<strong>Copyright &copy; <?php echo date('Y'); ?></strong> All rights
reserved.
</footer>

<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo site_url('../assets/admin/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url('../assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo site_url('../assets/admin/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo site_url('../assets/admin/bower_components/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo site_url('../assets/admin/bower_components/morris.js/morris.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo site_url('../assets/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo site_url('../assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo site_url('../assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo site_url('../assets/admin/bower_components/jquery-knob/dist/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo site_url('../assets/admin/bower_components/moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo site_url('../assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo site_url('../assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo site_url('../assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.jss'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo site_url('../assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo site_url('../assets/admin/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url('../assets/admin/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo site_url('../assets/admin/dist/js/pages/dashboard.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo site_url('../assets/admin/dist/js/demo.js'); ?>"></script>

<script src="<?php echo site_url('../assets/admin/js/scripts.js'); ?>"></script>

<script src="<?php echo site_url('../assets/admin/js/chosen.jquery.js
'); ?>"></script>
<script src="<?php echo site_url('../assets/admin/dist/js/prism.js'); ?>"></script>
<script src="<?php echo site_url('../assets/admin/dist/js/init.js'); ?>"></script>

<script src="<?php echo base_url('assets/admin/js/common.js'); ?>"></script>

</body>
</html>
