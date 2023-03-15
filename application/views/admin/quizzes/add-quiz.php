<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Quizzes > Add
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/quiz'); ?>">Quizzes</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-quiz" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Create New Quiz</h3>

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
	            <div class="col-md-12">
	              <div class="form-group">
	                <label>Title</label>
	                <input required class="form-control" type="text" name="quiz_title" id="quiz_title" value="<?php echo $this->input->post('quiz_title'); ?>">
	              </div>
	              <!-- /.form-group -->
                  <div class="form-group form-group-radio">
	                <label>Badge</label><br>
					<select class="form-control select2" name="quiz_badge" id="quiz_badge" data-placeholder="Select a Badge">
						<option value="">Select</option>
	                	<?php foreach($badges as $badge){ ?>
	                		<option value="<?php echo $badge['badge_id']; ?>"><?php echo $badge['badge_title']; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Description</label>
	                <textarea class="form-control textarea" name="quiz_description" id="quiz_description"><?php echo $this->input->post('quiz_description'); ?></textarea>
	              </div>
	              <!-- /.form-group -->

				  <div class="col-sm-6">
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
		              <!-- /.form-group -->
				  </div>
				  <div class="col-sm-6">
					  <div class="form-group">
		              	<label>Duration (min)</label>
		                <input type="number" name="quiz_duration" value="0" class="form-control" value="<?php echo $this->input->post('quiz_status'); ?>">
		              </div>
		              <!-- /.form-group -->
				  </div>
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	            <a href="<?php echo site_url('admin/quiz'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="save_quiz" class="btn btn-info pull-right">Save</button>
	        </div>
	    </div>
	</form>
</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#add-quiz").validate();
</script>
