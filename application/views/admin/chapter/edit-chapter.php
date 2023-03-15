<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Chapter > Edit
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Chapter</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="edit-chapter" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Chapter</h3>

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
	                <input required class="form-control" type="text" name="chapter_title" id="chapter_title" value="<?php echo $chapter->chapter_title; ?>">
	                <input class="form-control" type="hidden" name="chapter_id" id="chapter_id" value="<?php echo $chapter->chapter_id; ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Sort Order</label>
	               <input class="form-control" type="number" name="chapter_sort_order" id="chapter_sort_order" value="<?php echo $chapter->chapter_sort_order; ?>">
	              </div>
				  <div class="form-group form-group-radio">
					  <label>Status</label><br>
					  <label>
						<input type="radio" name="chapter_status" value="1" class="minimal" <?php echo isset($chapter) ? $chapter->chapter_status == 1 ? 'checked' : '' : 'checked'; ?>>
						Active
					  </label>
					  <label>
						<input type="radio" name="chapter_status" value="0" class="minimal" <?php echo isset($chapter) ? $chapter->chapter_status == 0 ? 'checked' : '' : ''; ?>>
						Inactive
					  </label>
				  </div>
				  <!-- /.form-group -->
	            	 <table class="table lesson-tools-table" data-tool-count="<?php echo count($chapter_tools) > 0 ? count($chapter_tools) : '1'; ?>">
	          		<?php

	          		if(count($chapter_tools) > 0){ ?>
	          			<?php $ti = 1; foreach($chapter_tools as $chapter_tool){ ?>
	          				<tr class="lesson-tool-single" data-current="<?php echo $ti; ?>">
								<td>
									<div class="form-group">
										<label>Tools</label>
										<select required class="form-control lesson-tool" name="lesson_tools[<?php echo $ti; ?>][object]" id="">
											<option value="">Select</option>
											<option <?php echo $chapter_tool['chapter_tool_object'] == 'lesson' ? 'selected' : ''; ?> value="lesson">Lesson</option>
											<option <?php echo $chapter_tool['chapter_tool_object'] == 'quiz' ? 'selected' : ''; ?> value="quiz">Quiz</option>
											<option <?php echo $chapter_tool['chapter_tool_object'] == 'lesson_and_quiz' ? 'selected' : ''; ?> value="lesson_and_quiz">Lesson & Quiz</option>
										</select>
									</div>
									<!-- /.form-group -->
								</td>
								<td>
									<div class="form-group">
										<label>Select <span class="tool-name"></span></label>
										<select required class="form-control lesson-tool-id" name="lesson_tools[<?php echo $ti; ?>][object_id]" id="">
											<option value="">Select</option>
					<?php foreach($objects[$chapter_tool['chapter_tool_object']] as $obj){ ?>
				<option <?php echo $chapter_tool['chapter_tool_object_id'] == $obj[$chapter_tool['chapter_tool_object'].'_id'] ? 'selected' : ''; ?> value="<?php echo $obj[$chapter_tool['chapter_tool_object'].'_id']; ?>"><?php echo $obj[$chapter_tool['chapter_tool_object'].'_title']; ?></option>
				    <?php } ?>
										</select>
									</div>
									<!-- /.form-group -->
								</td>
								<td align="right" valign="bottom">
									<?php if($ti > 1){ ?>
										<a href="javascript:void(0)" class="btn btn-sm btn-danger remove-tool"><i class="fa fa-minus"></i></a>
									<?php } ?>
									<a href="javascript:void(0)" class="btn btn-sm btn-info add-tool"><i class="fa fa-plus"></i></a>
								</td>
							</tr>
							<?php $ti++; ?>
	          			<?php } ?>
	          		<?php }else{ ?>
					<tr class="lesson-tool-single" data-current="1">
						<td>
							<div class="form-group">
								<label>Tools</label>
								<select required class="form-control lesson-tool" name="lesson_tools[1][object]" id="">
									<option value="">Select</option>
									<option value="lesson">Lesson</option>
									<option value="quiz">Quiz</option>
									<option value="lesson_and_quiz">Lesson & Quiz</option>
								</select>
							</div>
							<!-- /.form-group -->
						</td>
						<td>
							<div class="form-group">
								<label>Select <span class="tool-name"></span></label>
								<select required class="form-control lesson-tool-id" name="lesson_tools[1][object_id]" id="">
									<option value="">Select a tool</option>
								</select>
							</div>
							<!-- /.form-group -->
						</td>
						<td align="right" valign="bottom">
							<a href="javascript:void(0)" class="btn btn-sm btn-info add-tool"><i class="fa fa-plus"></i></a>
						</td>
					</tr>
					<?php }?>
				</table>


	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        	<div class="col-md-6 col-md-offset-3">
	            <a href="<?php echo site_url('admin/chapter'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="update_chapter" class="btn btn-info pull-right">Save</button>
	        </div>
	        </div>
	    </div>
	</form>

</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#edit-chapter").validate();

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

	$('.lesson-tools-table').on('change', '.lesson-tool', function(){
		var that = $(this);
		var current_tr = $(this).parent().parent().parent('.lesson-tool-single');
		var current_counter = current_tr.attr('data-current');
		var object = that.val();

		if(object != ''){
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
			    	current_tr.find('.lesson-tool-id').html('<option value="">Select a tool</option>');
			    }
			})
			.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}else{
			current_tr.find('.tool-name').text('');
			current_tr.find('.lesson-tool-id').html('<option value="">Select a tool</option>');
		}
	});
</script>
