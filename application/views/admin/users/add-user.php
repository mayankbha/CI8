<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Users > Add
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/user'); ?>">Users</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-user" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Create New User</h3>

	          <div class="box-tools pull-right">

	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
	          <div class="row">
	          	<div class="col-md-12">
		          	<?php if($this->session->flashdata('success')){ ?>
				      	<div class="alert alert-success" role="alert">
						  <?php echo $this->session->flashdata('success'); ?>
						</div>
					<?php } ?>
					<?php if($this->session->flashdata('error')){ ?>
				      	<div class="alert alert-danger" role="alert">
						  <?php echo $this->session->flashdata('error'); ?>
						</div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
				</div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>First Name</label>
	                <input class="form-control" type="text" name="user_first_name" id="user_first_name" value="<?php echo $this->input->post('user_first_name'); ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Last Name</label>
	                <input class="form-control" type="text" name="user_last_name" id="user_last_name" value="<?php echo $this->input->post('user_last_name'); ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Email</label>
	                <input class="form-control" type="email" name="user_email" id="user_email" value="<?php echo $this->input->post('user_email'); ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label class="col-sm-12 no-padding">Password <small class="generate-password pull-right"><a style="display:none" href="javascript:void(0)">Generate</a></small></label>
	                <input class="form-control" type="password" name="user_pword" id="user_pword" value="<?php echo $this->input->post('user_pword'); ?>">
	              </div>
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	            <div class="col-md-6">

	              <div class="form-group">
	                <label>Type</label>
	                <select class="form-control" name="user_type" id="user_type" onchange="check_type(this.value)">
	                	<option value="">Select</option>
	                	<option value="admin">Admin</option>
	                	<option value="teacher">Teacher</option>
	                	<option value="parent">Parent</option>
	                	<option value="student">Student</option>
	                </select>
	              </div>
				  
				  <div class="form-group" id="show_class" style="display:none">
	                <label>Select Class</label>
	                <select class="form-control" name="class">
						<?php
							for($i=1;$i<=12;$i++){ ?>
								<option value="<?php echo $i ?>">Class-<?php echo $i ?></option>
						<?php } ?>
	                </select>
	              </div>
				  
	              <!-- /.form-group -->
	              <div class="form-group form-group-radio">
	              	<label>Status</label><br>
	                <label>
	                  <input type="radio" name="user_status" value="1" class="minimal"<?php echo $this->input->post('user_status') != '' ? $this->input->post('user_status') == 1 ? 'checked' : '' : 'checked'; ?>>
	                  Active
	                </label>
	                <label>
	                  <input type="radio" name="user_status" value="0" class="minimal"<?php echo $this->input->post('user_status') != '' ? $this->input->post('user_status') == 0 ? 'checked' : '' : ''; ?>>
	                  Inactive
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Image</label>

					<div>
						<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="user_image" value="" id="user_image" />
					</div>
	              </div>
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	            <a href="<?php echo site_url('admin/user'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="save_user" class="btn btn-info pull-right">Save</button>
	        </div>
	    </div>
	</form>
</section>
<!-- /.content -->
