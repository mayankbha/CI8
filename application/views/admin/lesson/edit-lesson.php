<!-- Content Header (Page header)  -->
<section class="content-header">
	<h1>
	Lesson > Edit Lesson
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Lesson</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="edit-lesson" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Lesson</h3>

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
					<label>Lesson Title</label>
	                <input required class="form-control" type="text" name="lesson_title" id="chapter_title" value="<?php echo $lesson->lesson_title; ?>">
					<input class="form-control" type="hidden" name="lesson_id" id="lesson_id" value="<?php echo $lesson->lesson_id; ?>">

	              </div>
				 <!-- form-group close -->
	              <div class="form-group">
					 <label> Lesson Description</label>
	                <textarea class="form-control textarea" name="lesson_description" id="lesson_description"><?php echo $this->input->post('lesson_description'); ?><?php echo $lesson->lesson_description ?></textarea>

	              </div>
	              <!-- form-group close -->
	              <!--<div class="form-group">
					<label>Lesson Order</label>
					<input class="form-control" type="number" name="lesson_sort_order" id="lesson_sort_order" value="<?php echo $lesson->lesson_sort_order ?>">

	              </div>-->


	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        	<div class="col-md-6 col-md-offset-3">
	            <a href="<?php echo site_url('admin/chapter'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="update_lesson" class="btn btn-info pull-right">Save</button>
	        </div>
	        </div>
	    </div>
	</form>
</section>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#edit-lesson").validate();
</script>
