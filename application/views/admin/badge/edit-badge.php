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

	              <div class="form-group">
									<label>Select Criteria</label>
									<select  class="form-control lesson-tool" name="badge_criteria" id="Criteria">
	                	<option value="course_completion"
										<?php if($badges->badge_criteria == 'course_completion' )echo "selected"; ?>
										>Course Completion</option>
										<option value="percent_of_course_completion"
										<?php if($badges->badge_criteria == 'percent_of_course_completion' )echo "selected"; ?>
										>Percent of Course Completion</option>
										<option value="tool_of_a_course"
										<?php if($badges->badge_criteria == 'tool_of_a_course' )echo "selected"; ?>
										>Tool of a Course</option>
									</select>
								</div>

                <div class="form-group">
									<label>Category <span class="tool-name"></span></label>
                  <select class="form-control lesson-tool-id" name="badge_category" id="">
	                  <?php foreach ($categories as  $value) { ?>
	                  	<option value="<?php echo $value['category_id'] ?>"
												<?php if($badges->badge_category == $value['category_id'])echo "selected";?>
												><?php echo $value['category_title'] ?></option>
	                  <?php } ?>
                  </select>
								</div>

                <div class="form-group">
									<label>Course</label>
									<select class="form-control lesson-tool-id" name="badge_courses" id="">
										<?php foreach ($courses as  $value) { ?>
	                   	<option value="<?php echo $value['course_id']; ?>"
												<?php if($badges->badge_courses == $value['course_id'])echo "selected";?>

												><?php echo $value['course_title'] ?></option>
	                   	<?php } ?>
									</select>
							  </div>
						      <div class="form-group"  id="tool"  >
									<label>Tools</label>
                  <select class="form-control lesson-tool-id" name="badge_tools" id="">
										<option value="" disabled>Select a Tool</option>

										<option value="1" <?php if($badges->badge_tools == 1)echo "selected"; ?> >Lesson</option>
										<option value="2" <?php if($badges->badge_tools == 2)echo "selected"; ?> >Quizzes</option>
										<option value="3" <?php if($badges->badge_tools == 3)echo "selected"; ?> >Lesson & Quizzes</option>
									</select>
								</div>
							    <div class="form-group" id="percentage" >
			        		<label>Completion Percent </label>
			        		<input class="form-control" type="text" name="badge_percent" id="" value="<?php echo $badges->badge_percent; ?>">
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
var con = $("#Criteria").val();

if(con == "course_completion"){
		$('#tool').hide();
		$('#percentage').hide();
}else if(con == "percent_of_course_completion"){
		$('#tool').hide();
		$('#percentage').show();
}else if (con == "tool_of_a_course"){
		$('#tool').show();
		$('#percentage').hide();
}

	$("#Criteria").change(function(){
	debugger;
		var object = $(this).val();

		if(object == "course_completion"){
				$('#tool').hide();
				$('#percentage').hide();
		}else if(object == "percent_of_course_completion"){
				$('#tool').hide();
				$('#percentage').show();
		}else if (object == "tool_of_a_course"){
				$('#tool').show();
				$('#percentage').hide();
		}else{
			alert("select Criteria");
		}

	});
</script>
