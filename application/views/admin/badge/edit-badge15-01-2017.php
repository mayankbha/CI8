<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Badge > Edit
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Badge</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="edit-badge" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Badge</h3>

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



	            <div class="col-md-6 col-md-offset-3">
	              <div class="form-group">
	                <label>Badge Title</label>
	                <input required class="form-control" type="text" name="badge_title" id="badge_title" value="<?php echo $badges->badge_title; ?>">
	                 <input class="form-control" type="hidden" name="badge_id" id="badge_id" value="<?php echo $badges->badge_id; ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Image</label>

					<div>
						<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo ($thumb == '' ? $placeholder : $thumb); ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input required type="hidden" name="badge_image" value="<?php echo ($badges->badge_image); ?>" id="badge_image" />
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
	        	<div class="col-md-6 col-md-offset-3">
	            <a href="<?php echo site_url('admin/badges'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="update_badge" class="btn btn-info pull-right">Save</button>
	        </div>
	        </div>
	    </div>
	</form>
</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#edit-badge").validate();
</script>
