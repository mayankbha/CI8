<!DOCTYPE html>
<html>
<!-- Page Header -->
	<?php $this->load->view('_parts/header'); ?>

	<div class="container-fluid p-0 bg-green">
		<div class="container row-first">
		<div class="inner-main">
		<div class="inner-sec">
		<div class="row" style="min-height:350px;">
			<div class="col-6 login-im">
            	<img src="<?php echo base_url(); ?>assets/images/login-img.png">
            </div>
			<div class="col-6 login-bot">
					<legend class="login-box-msg">Sign in to start your session</legend>
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
					<form action="<?php echo base_url('login/buy/'.@$course_id); ?>" method="post" id="login-form">
						<div class="form-group has-feedback row">
							<label class="col-3" for="email">Email</label>
							<div class="col-9">
								<input autofocus type="email" name="email" id="email" value="<?php echo $this->input->post('email') ?>" class="form-control" placeholder="Email">
							</div>

						</div>
						<div class="form-group has-feedback row">
							<label class="col-3" for="password">Password</label>
							<div class="col-9">
								<input type="password" name="password" id="password" value="<?php echo $this->input->post('password') ?>" class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="row">
							<div class="col-9 offset-3">
								<button name="login" type="submit" class="btn btn-primary  btn-flat">Sign In</button>
							</div>
							<!-- /.col -->
						</div>
					</form>
					<div class="row login-last-ad">
						 
							<a href="#" class="for-got">I forgot my password</a><br>
							<a href="<?php echo base_url('register'); ?>" class="text-center new-lg">Register a new membership</a>
						 
					</div>

				</div>
				</div>
				</div>
			<!-- /.login-box-body -->
			</div>
			<!-- /.login-box -->
			<div class="col-3"></div>
		</div>
	</div>

	<!-- Page Footer -->
    <?php $this->load->view('_parts/footer'); ?>

    <script src="<?php echo site_url('../assets/admin/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

    <script>
		$("#login-form").validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
				password: {
					required: true,
					minlength: 5,
				}
			},
			messages: {
				email: "Please enter a valid email address",
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				}
			},
		});
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
