<!-- Content Header (Page header)  -->
<section class="content-header">
	<h1>
	Package > Add Package
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Package</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-package" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Create New Package</h3>

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
				</div>



	            <div class="col-md-12 ">
	              <div class="form-group row">
	                 <div class="col-md-2 col-md-offset-2"><label>Name Of Packages</label>
	                 </div>
	                  <div class="col-md-6">
	                   <input required class="form-control" type="text" name="package_title" id="package_title" value="<?php echo $this->input->post('package_title'); ?>">
	                  </div>
	              </div>

	              <div class="form-group row">
	                 <div class="col-md-2 col-md-offset-2"><label>Package Price (£)</label>
	                 </div>
	                  <div class="col-md-6">
	                   <input required class="form-control" type="text" name="package_price" id="package_price" value="<?php echo $this->input->post('package_price'); ?>">
	                  </div>
	              </div>

	              <div class="form-group row">
	                 <div class="col-md-2 col-md-offset-2"><label>Package Duration (Months)</label>
	                 </div>
	                  <div class="col-md-6">
	                   <select class="form-control" name="package_duration">
	                   	<option>Select Package Duration</option>
	                   	<?php for ($i=1; $i <13 ; $i++) {?>
	                   	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	                   	<?php } ?>
	                   </select>
	                  </div>
	              </div>

	              <div class="form-group row" style="display:none">
	                 <div class="col-md-2 col-md-offset-2 "><label>Select Categories <p>(Select Shift + Down Arrow to select Multiple Categories)</p></label>
	                 </div>
	                  <div class="col-md-6">
	                   <select multiple class="chosen-select form-control" name="package_categories[]">

	                   	<?php foreach ($categories as  $value) { ?>
	                   	<option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_title'] ?></option>
	                   	<?php } ?>
	                   </select>
	                  </div>
	              </div>

	              <div class="form-group row">
	                 <div class="col-md-2 col-md-offset-2 "><label>Select Courses<p>(Select Shift + Down Arrow to select Multiple Courses)</p></label>
	                 </div>
	                  <div class="col-md-6">
	                   <select multiple class="chosen-select form-control" name="package_courses[]">

	                   	<?php foreach ($courses as  $value) { ?>
	                   	<option value="<?php echo $value['course_id']; ?>"><?php echo $value['course_title'] ?></option>
	                   	<?php } ?>
	                   </select>
	                  </div>
	              </div>

	               <div class="form-group row" style="display:none">
	                 <div class="col-md-2 col-md-offset-2 "><label>Select Eligible Classes <p>(Select Shift + Down Arrow to select Multiple Classes)</p></label>
	                 </div>
	                  <div class="col-md-6">
	                   <select multiple class="chosen-select form-control" name="package_classes[]">

	                   	<?php foreach ($classes as  $value) { ?>
	                   	<option value="<?php echo $value['class_id']; ?>"><?php echo $value['class_name']; ?></option>
	                   	<?php } ?>
	                   </select>
	                  </div>
	              </div>
	            </div>

	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        	<div class="col-md-6 col-md-offset-3">
	            <a href="<?php echo site_url('admin/package'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="save_package" class="btn btn-info pull-right">Save</button>
	        </div>
	        </div>
	    </div>
	</form>
</section>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#add-package").validate();
</script>
