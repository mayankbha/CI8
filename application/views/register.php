<!DOCTYPE html>
<html>
<!-- Page Header -->
	<?php $this->load->view('_parts/header'); ?>

	<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
			<div class="col-3"></div>
			<div class="register-box col-12">
            
				<div class="col-5 reg-img">
                	<img src="<?php echo base_url(); ?>assets/images/register-page-imgae.png">
                </div>
                <div class="col-7 reg-fm">
                <legend class="login-box-msg">Register a new membership</legend>
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
					<?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<form action="<?php echo current_url(); ?>" enctype="multipart/form-data" method="post" id="register-form">
						<div class="form-group has-feedback row">
							<label class="col-3" for="user_first_name">First Name</label>
							<div class="col-9">
								<input class="form-control" type="text" name="user_first_name" id="user_first_name" value="<?php echo $this->input->post('user_first_name') ?>" placeholder="First Name">
							</div>
						</div>
						<div class="form-group has-feedback row">
							<label class="col-3" for="user_last_name">Last Name</label>
							<div class="col-9">
								<input class="form-control" type="text" name="user_last_name" id="user_last_name" value="<?php echo $this->input->post('user_last_name') ?>" placeholder="Last Name">
							</div>
						</div>
						<div class="form-group has-feedback row">
							<label class="col-3" for="user_email">Email</label>
							<div class="col-9">
								<input class="form-control" type="email" name="user_email" id="user_email" value="<?php echo $this->input->post('user_email') ?>" placeholder="Email">
							</div>
						</div>
						<div class="form-group has-feedback row">
							<label class="col-3" for="user_password">Password</label>
							<div class="col-9">
								<input class="form-control" type="password" name="user_pword" id="user_pword" placeholder="Password">
							</div>
						</div>
						<div class="form-group has-feedback row">
							<label class="col-3" for="confirm_password">Confirm</label>
							<div class="col-9">
								<input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Retype Password">
							</div>
						</div>
						<div class="form-group has-feedback row">
							<label class="col-3" for="user_type">You are a</label>
							<div class="col-9">
								<select class="form-control" name="user_type" id="user_type">
									<option value="">Select</option>
									<option <?php echo $this->input->post('user_type') == 'parent' ? 'selected' : ''; ?><?php echo $this->input->get('as') == 'parent' ? 'selected' : ''; ?> value="parent">Parent</option>
									<option <?php echo $this->input->post('user_type') == 'student' ? 'selected' : ''; ?><?php echo $this->input->get('as') == 'student' ? 'selected' : ''; ?> value="student">Student</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="checkbox icheck">
									<label>
										<input type="checkbox" name="terms_condition" id="terms_condition" value="1"> I agree to the <a href="#">terms</a>
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-4">
								<button type="submit" name="register" class="btn btn-primary btn-flat pull-right">Register</button>
							</div>
							<!-- /.col -->
						</div>
					</form>

					<a href="<?php echo base_url('login'); ?>" class="text-center new-lg">I already have a membership</a>
                </div>
					
					
				</div>
				</div>
				<!-- /.form-box -->
			</div>
			<!-- /.register-box -->
			<div class="col-3"></div>
		</div>
	</div>

	<!-- Page Footer -->
    <?php $this->load->view('_parts/footer'); ?>

    <!-- iCheck -->
	<link rel="stylesheet" href="<?php echo site_url('../assets/admin/plugins/iCheck/square/blue.css'); ?>">

	<!-- iCheck -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

    <script>
		$("#register-form").validate({
			rules: {
				user_first_name: {
					required: true,
				},
				user_last_name: {
					required: true,
				},
				user_email: {
					required: true,
					email: true,
				},
				user_mobile: {
					required: true,
					digits: true
				},
				user_password: {
					required: true,
					minlength: 5,
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#user_pword",
				},
				user_type: {
					required: true,
				},
				terms_condition: {
					required: true,
				}
			},
			messages: {
				user_company: "Company cannot be blank.",
				user_name: "Name cannot be blank.",
				user_email: "Please enter a valid email address",
				user_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				user_type: "Please select an option",
				terms_condition: "Please agree terms and conditions",
			},
		});
	</script>

</body>
</html>
