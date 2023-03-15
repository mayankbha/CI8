
<script>
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Courses > Add
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/course'); ?>">Courses</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-course" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Create New Course</h3>

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
	              <div class="form-group">
	                <label>Title</label>
	                <input required class="form-control" type="text" name="course_title" id="course_title" value="<?php echo $this->input->post('course_title'); ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Description</label>
	                <textarea class="form-control textareas" name="course_description" id="course_description"><?php echo $this->input->post('course_description'); ?></textarea>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Start Date</label>
	                <div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
	                	<input class="form-control datepicker pull-right" type="text" name="course_start_date" id="course_start_date" value="<?php echo $this->input->post('course_start_date'); ?>">
	                </div>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label class="col-sm-12 no-padding">End Date</label>
	                <div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
	                	<input class="form-control datepicker pull-right" type="text" name="course_end_date" id="course_end_date" value="<?php echo $this->input->post('course_end_date'); ?>">
	                </div>
	              </div>
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	            <div class="col-md-6">

	              <div class="form-group form-group-radio">
	                <label>Category</label><br>
	                <select required class="form-control select2" name="category[]" multiple="true" id="category" data-placeholder="Select a Category">
	                	<?php foreach($categories as $category){ ?>
	                		<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_title']; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	              <!-- /.form-group -->
				  <div class="form-group form-group-radio">
	                <label>Badge</label><br>
					<select class="form-control select2" name="course_badge" id="course_badge" data-placeholder="Select a Badge">
						<option value="">Select</option>
	                	<?php foreach($badges as $badge){ ?>
	                		<option value="<?php echo $badge['badge_id']; ?>"><?php echo $badge['badge_title']; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group form-group-radio">
	                <label>All Time</label><br>
	                <label>
	                	<input type="radio" name="course_all_time" id="" value="1" <?php echo $this->input->post('course_all_time') != '' ? $this->input->post('course_all_time') == 1 ? 'checked' : '' : 'checked'; ?>>
	                	Yes
	                </label>
	                <label>
	                	<input type="radio" name="course_all_time" id="" value="0" <?php echo $this->input->post('course_all_time') != '' ? $this->input->post('course_all_time') == 0 ? 'checked' : '' : ''; ?>>
	                	No
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	              	<label>Price</label>
	              	<input class="form-control" type="text" name="course_price" id="course_price" value="<?php echo $this->input->post('course_price'); ?>">
	              </div>
	              <div class="form-group form-group-radio">
	                <label>Visibility</label><br>
	                <label>
	                	<input type="radio" name="course_visibility" id="" value="0" <?php echo $this->input->post('course_visibility') != '' ? $this->input->post('course_visibility') == 0 ? 'checked' : '' : 'checked'; ?>>
	                	Public
	                </label>
	                <label>
	                	<input type="radio" name="course_visibility" id="" value="1" <?php echo $this->input->post('course_visibility') != '' ? $this->input->post('course_visibility') == 1 ? 'checked' : '' : ''; ?>>
	                	Ragistered users
	                </label>
	                <label>
	                	<input type="radio" name="course_visibility" id="" value="2" <?php echo $this->input->post('course_visibility') != '' ? $this->input->post('course_visibility') == 2 ? 'checked' : '' : ''; ?>>
	                	Privileged Users
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group form-group-radio">
	              	<label>Status</label><br>
	                <label>
	                  <input type="radio" name="course_status" value="1" class="minimal" <?php echo $this->input->post('course_status') != '' ? $this->input->post('course_status') == 1 ? 'checked' : '' : 'checked'; ?>>
	                  Active
	                </label>
	                <label>
	                  <input type="radio" name="course_status" value="0" class="minimal" <?php echo $this->input->post('course_status') != '' ? $this->input->post('course_status') == 0 ? 'checked' : '' : ''; ?>>
	                  Inactive
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Image</label>

					<div>
						<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="course_image" value="" id="course_image" />
					</div>
	              </div>
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
				<table class="table course-tools-table" data-tool-count="1">
					<tr class="course-tool-single" data-current="1">
						<td>
							<div class="form-group">
								<label>Chapter 1</label>
							</div>
							<!-- /.form-group -->
						</td>
						<td>
							<div class="form-group">
								<label>Select <span class="tool-name"></span></label>
								<select required class="form-control course-tool-id" name="course_chapters[1][chapter_id]" id="">
									<option value="">Select</option>
									<?php foreach($chapters as $chapter){ ?>
										<option value="<?php echo $chapter['chapter_id']; ?>"><?php echo $chapter['chapter_title']; ?></option>
									<?php } ?>
								</select>
							</div>
							<!-- /.form-group -->
						</td>
						<td align="right" valign="bottom">
							<a href="javascript:void(0)" class="btn btn-sm btn-info add-tool"><i class="fa fa-plus"></i></a>
						</td>
					</tr>
				</table>
	          <!-- /.table -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	            <a href="<?php echo site_url('admin/course'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="save_course" class="btn btn-info pull-right">Save</button>
	        </div>
	    </div>
	</form>
</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#add-course").validate();

	$('.course-tools-table').on('click', '.add-tool', function(){
		var that = $(this);
		var counter = parseInt($('.course-tools-table').attr('data-tool-count'));
		var next_counter = counter+1;

		$('.course-tools-table').attr('data-tool-count', next_counter);

		var single_tool = '<tr class="course-tool-single" data-current="'+next_counter+'">		        	<td>		        		<div class="form-group">			                <label>Chapter '+next_counter+'</label>		<button class="btn btn-info hide course-tool" type="button" >Get</button>	            </div>			            <!-- /.form-group -->			        </td>			        <td>			            <div class="form-group">			                <label>Select <span class="tool-name"></span></label>			                <select class="form-control course-tool-id" name="course_chapters['+next_counter+'][chapter_id]" id="">			                	<option value="">Select a tool</option>			                </select>			            </div>			            <!-- /.form-group -->		        	</td>		        	<td align="right" valign="bottom">		        		<a href="javascript:void(0)" class="btn btn-sm btn-danger remove-tool"><i class="fa fa-minus"></i></a><a href="javascript:void(0)" class="btn btn-sm btn-info add-tool"><i class="fa fa-plus"></i></a>		        	</td>	        	</tr>';

		$('.course-tools-table').append(single_tool);
		$('.course-tool').click();

	});

	$('.course-tools-table').on('click', '.remove-tool', function(){
		var decision = confirm("Are you sure want to delete this entry ?");
		if(decision){
			$(this).parent().parent('.course-tool-single').remove();
		}
	});

	$('.course-tools-table').on('click', '.course-tool', function(){
		var that = $(this);
		var current_tr = $(this).parent().parent().parent('.course-tool-single');
		var current_counter = current_tr.attr('data-current');
		var object = 'chapter';

		if(object != ''){
			$.ajax({
				method: "POST",
				url: "<?php echo site_url('admin/course/get_object_values'); ?>/"+object
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
			    	current_tr.find('.course-tool-id').html($html).addClass('jad');
			    }else{
			    	alert(response.msg);
			    	current_tr.find('.tool-name').text('');
			    	current_tr.find('.course-tool-id').html('<option value="">Select a tool</option>');
			    }
			})
			.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}else{
			current_tr.find('.tool-name').text('');
			current_tr.find('.course-tool-id').html('<option value="">Select a tool</option>');
		}
	});
</script>
