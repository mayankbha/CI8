<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page_title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo site_url('../assets/admin/bower_components/Ionicons/css/ionicons.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo site_url('../assets/admin/dist/css/AdminLTE.min.css'); ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo site_url('../assets/admin/plugins/iCheck/square/blue.css'); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">

	<div class="login-box">
		<div class="login-logo">
		<a href="#"><b>LMS</b>App</a>
		</div>
	<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<?php if($this->session->flashdata('success')){ ?>
		      	<div class="alert alert-success" role="alert">
				  <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>
			<?php if($this->session->flashdata('danger')){ ?>
		      	<div class="alert alert-danger" role="alert">
				  <?php echo $this->session->flashdata('danger'); ?>
				</div>
			<?php } ?>
			<form id="login-form" action="<?php echo base_url('admin/login'); ?>" method="post">
				<div class="form-group has-feedback">
					<input required autofocus type="email" name="email" id="email" value="<?php echo $this->input->post('email') ?>" class="form-control" placeholder="Email">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input required type="password" name="password" id="password" value="<?php echo $this->input->post('password') ?>" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-4">
						<button name="login" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			<a href="#" class="for-got">I forgot my password</a>

		</div>
	<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->


    <!-- jQuery 3 -->
	<script src="<?php echo site_url('../assets/admin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo site_url('../assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<!-- iCheck -->
	<script src="<?php echo site_url('../assets/admin/plugins/iCheck/icheck.min.js'); ?>"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

	<script>
		$("#login-form").validate();
	</script>

	<script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' // optional
	    });
	  });
	</script>
</body>
</html>
