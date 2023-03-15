<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Badge > Add
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Badge</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-badge" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Create New Badge</h3>

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
	                <input required class="form-control" type="text" name="badge_title" id="badge_title" value="<?php echo $this->input->post('badge_title'); ?>">
	              </div>
	              <div class="form-group">
	                <label>Image</label>
                    <div>
												<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="badge_image" value="" id="badge_image" />
										</div>
	              </div>
	              <!-- /.form-group -->


							<div class="form-group">
								<label>Select Criteria</label>
								<select  class="form-control lesson-tool" name="badge_criteria" id="Criteria">

									<option value="course_completion" selected>Course Completion</option>
									<option value="percent_of_course_completion">Percent of Course Completion</option>
									<option value="tool_of_a_course">Tool of a Course</option>
								</select>
							</div>

							<div class="form-group">
								<label>Category <span class="tool-name"></span></label>
								<select class="form-control lesson-tool-id" name="badge_category" id="">
									<option value="">Select a category</option>
								    <?php foreach ($categories as  $value) { ?>
	                   	<option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_title'] ?></option>
	                   	 <?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label>Course</label>
								<select class="form-control lesson-tool-id" name="badge_courses" id="">
								<option value="">Select a Course</option>
									<?php foreach ($courses as  $value) { ?>
	                   	<option value="<?php echo $value['course_id']; ?>"><?php echo $value['course_title'] ?></option>
	                   	<?php } ?>
								</select>
							</div>

							<div class="form-group"  id="tool" style="display:none;" >
								<label>Tools</label>
								<select class="form-control lesson-tool-id" name="badge_tools" id="">
									<option value="" disabled selected>Select a Tool</option>
									<option value="1">Lesson</option>
									<option value="2">Quizzes</option>
									<option value="3">Lesson & Quizzes</option>
								</select>
							</div>

							<div class="form-group" id="percentage" style="display:none;">
			        	<label>Completion Percent </label>
			        	<input class="form-control" type="text" name="badge_percent" id="" value="<?php echo $this->input->post('course_percent'); ?>">
			      	</div>

   </div>
	 </div>
	 </div>
	        <div class="box-footer">
	        	<div class="col-md-6 col-md-offset-3">
	          <!--  <a href="<?php echo site_url('admin/chapter'); ?>" class="btn btn-default">Cancel</a>-->
	            <button type="submit" name="save_badge" class="btn btn-info pull-right">Save</button>

	          </div>
	        </div>
	    </div>
	</form>
</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#add-chapter").validate();

	$('.lesson-tools-table').on('click', '.add-tool', function(){
		var that = $(this);
		var counter = parseInt($('.lesson-tools-table').attr('data-tool-count'));
		var next_counter = counter+1;

		$('.lesson-tools-table').attr('data-tool-count', next_counter);

		var single_tool = '<tr class="lesson-tool-single" data-current="'+next_counter+'">		        	<td>		        		<div class="form-group">			                <label>Tools</label>			                <select class="form-control lesson-tool" name="lesson_tools['+next_counter+'][object]" id="">			                	<option value="">Select</option>			                	<option value="lesson">Lesson</option>			                	<option value="quiz">Quiz</option>	<option value="lesson_and_quiz">Lesson & Quiz</option>		                </select>			            </div>			            <!-- /.form-group -->			        </td>			        <td>			            <div class="form-group">			                <label>Select <span class="tool-name"></span></label>			                <select class="form-control lesson-tool-id" name="lesson_tools['+next_counter+'][object_id]" id="">			                	<option value="">Select a tool</option>			                </select>			            </div>			            <!-- /.form-group -->		        	</td>		        	<td align="right" valign="bottom">		        		<a href="javascript:void(0)" class="btn btn-sm btn-danger remove-tool"><i class="fa fa-minus"></i></a><a href="javascript:void(0)" class="btn btn-sm btn-info add-tool"><i class="fa fa-plus"></i></a>		        	</td>	        	</tr>';

		$('.lesson-tools-table').append(single_tool);

	});

	$('.lesson-tools-table').on('click', '.remove-tool', function(){
		var decision = confirm("Are you sure want to delete this entry ?");
		if(decision){
			$(this).parent().parent('.lesson-tool-single').remove();
		}
	});

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
		$('.lesson-tools-table').on('change', '.lesson-tool', function(){
		debugger;
			var that = $(this);
			var current_tr = $(this).parent().parent().parent('.lesson-tool-single');
			var current_counter = current_tr.attr('data-current');
			var object = that.val();
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

		/*if(object != ''){
			$.ajax({
				method: "POST",
				url: "<?php echo site_url('admin/chapter/get_object_values'); ?>/"+object
			})
			.done(function( response ){
			    response = $.parseJSON(response);
			    if(response.status){
			    	var $html = '<option value="">Select</option>';
			    	$.each(response.msg, function(index, value){
			    		$html += '<option value="'+index+'">'+value+'</option>';
			    	});
			    	console.log(current_tr);
			    	current_tr.find('.tool-name').text('a: '+object);
			    	current_tr.find('.lesson-tool-id').html($html).addClass('jad');
			    }else{
			    	alert(response.msg);
			    	current_tr.find('.tool-name').text('');
			    	current_tr.find('.lesson-tool-id').html('<option value="">Select a Category</option>');
			    }
			})
			.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}else{
			current_tr.find('.tool-name').text('');
			current_tr.find('.lesson-tool-id').html('<option value="">Select a Category</option>');
		}*/
	});
</script>
