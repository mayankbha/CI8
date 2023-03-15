<!-- Content Header (Page header)  -->
<section class="content-header">
	<h1>
	Lesson & Quiz > Add
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Lesson & Quiz</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-lesson-quiz" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Create New Lesson & Quiz</h3>

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



	            <div class="col-md-6">
	            	<div class="panel panel-default">
   					 <div class="panel-heading">Add Lesson</div>
    			      <div class="panel-body">


	              <div class="form-group">
					<label>Lesson Title</label>
	                <input required class="form-control" type="text" name="lesson_title" id="lesson_title" value="<?php echo $this->input->post('lesson_title'); ?>">


	              </div>
				 <!-- form-group close -->
	              <div class="form-group">
					 <label> Chapter Description</label>
	                <textarea class="form-control textarea" name="lesson_description" id="lesson_description"><?php echo $this->input->post('lesson_description'); ?></textarea>

	              </div>
	              <!-- form-group close -->
	              <div class="form-group">
					<label>Chapter Order</label>
					<input class="form-control" type="number" name="lesson_sort_order" id="lesson_sort_order" value="<?php echo $this->input->post('lesson_sort_order') ? $this->input->post('lesson_sort_order') : 1; ?>">

	              </div>


	            </div>
	        </div>
	    </div>


	        <div class="col-md-6">
				<div class="panel panel-default">
   					 <div class="panel-heading">Add Quiz</div>
    			      <div class="panel-body">

	            	<div class="form-group">
	                <label>Quiz Title</label>
	                <input required class="form-control" type="text" name="quiz_title" id="quiz_title" value="<?php echo $this->input->post('quiz_title'); ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Description</label>
	                <textarea class="form-control textarea" name="quiz_description" id="quiz_description"><?php echo $this->input->post('quiz_description'); ?></textarea>
	              </div>
	              <!-- /.form-group -->


	              <div class="form-group form-group-radio">
	              	<label>Status</label><br>
	                <label>
	                  <input type="radio" name="quiz_status" value="1" class="minimal" <?php echo $this->input->post('quiz_status') != '' ? $this->input->post('quiz_status') == 1 ? 'checked' : '' : 'checked'; ?>>
	                  Active
	                </label>
	                <label>
	                  <input type="radio" name="quiz_status" value="0" class="minimal" <?php echo $this->input->post('quiz_status') != '' ? $this->input->post('quiz_status') == 0 ? 'checked' : '' : ''; ?>>
	                  Inactive
	                </label>
	              </div>



	            </div>
	        </div>
	    </div>
	</div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        	<div class="col-md-12">
	            <a href="<?php echo site_url('admin/lesson_quiz'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="save_lesson" class="btn btn-info pull-right">Save</button>
	        </div>
	        </div>
	    </div>
	</form>
</section>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#add-lesson-quiz").validate();
</script>
