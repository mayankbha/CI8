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
	<form enctype="multipart/form-data" class="form" id="add-lesson" method="post" action="<?php echo current_url(); ?>">
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
	                <label>Chapter Title</label>
	                <select class="form-control" name="fk_chapter_id">
	                	

	                	<option  value="<?php echo $chapter->lesson_id; ?>"><?php echo $chapter->chapter_title; ?></option>
	                	
	                	<?php foreach ($lesson as $value): ?>
	                		<option  value="<?php echo $value->lesson_id; ?>"><?php echo $value->chapter_title; ?></option>
	                	<?php endforeach ?>
 
	                </select>
	              </div>

	              <div class="form-group">
					<label>Lesson Title</label>
	                <input class="form-control" type="text" name="lesson_title" id="chapter_title" value="<?php echo $chapter->lesson_title; ?>">
					<input class="form-control" type="hidden" name="lesson_id" id="lesson_id" value="<?php echo $chapter->lesson_id; ?>">

	              </div>
				 <!-- form-group close -->
	              <div class="form-group">
					 <label> Lesson Description</label>
	                <textarea class="form-control textarea" name="lesson_description" id="lesson_description"><?php echo $this->input->post('lesson_description'); ?><?php echo $chapter->lesson_description ?></textarea>

	              </div>
	              <!-- form-group close -->
	              <div class="form-group">
					<label>Lesson Order</label>
					<input class="form-control" type="text" name="lesson_sort_order" id="lesson_sort_order" value="<?php echo $chapter->lesson_sort_order ?>">

	              </div>

	          
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
