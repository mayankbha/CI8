<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Courses > Edit
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/course'); ?>">Courses</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="edit-course" method="post" action="<?php echo current_url(); ?>">
		<input type="hidden" name="course_id" id="course_id" value="<?php echo $course['course_id']; ?>">
		<input type="hidden" name="course_user_id" id="course_user_id" value="<?php echo $course['course_user_id']; ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Course</h3>

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
	                <input required class="form-control" type="text" name="course_title" id="course_title" value="<?php echo $course['course_title']; ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Description</label>
	                <textarea class="form-control textarea" name="course_description" id="course_description"><?php echo $course['course_description']; ?></textarea>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Start Date</label>
	                <div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
	                	<input class="form-control datepicker pull-right" type="text" name="course_start_date" id="course_start_date" value="<?php echo $course['course_start_date']; ?>">
	                </div>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label class="col-sm-12 no-padding">End Date</label>
	                <div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
	                	<input class="form-control datepicker pull-right" type="text" name="course_end_date" id="course_end_date" value="<?php echo $course['course_end_date']; ?>">
	                </div>
	              </div>
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	            <div class="col-md-6">

	              <div class="form-group form-group-radio">
	                <label>Category</label><br>
	                <?php
	                	//get extract category column from collection
	                	$cats = array_column($course['categories'], 'categories_category_id');

	                ?>
	                <select class="form-control select2" name="category[]" multiple="true" id="category" data-placeholder="Select Categories">
	                	<?php foreach($categories as $category){ ?>
	                		<option <?php if(in_array($category['category_id'], $cats)){ echo 'selected'; } ?> value="<?php echo $category['category_id']; ?>"><?php echo $category['category_title']; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	              <!-- /.form-group -->

				  <div class="form-group form-group-radio">
	                <label>Badge</label><br>
					<select class="form-control select2" name="course_badge" id="course_badge" data-placeholder="Select a Badge">
						<option value="">Select</option>
	                	<?php foreach($badges as $badge){ ?>
	                		<option <?php if($badge['badge_id'] == $course['course_badge']){ echo 'selected'; } ?> value="<?php echo $badge['badge_id']; ?>"><?php echo $badge['badge_title']; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	              <!-- /.form-group -->

	              <div class="form-group form-group-radio">
	                <label>All Time</label><br>
	                <label>
	                	<input type="radio" name="course_all_time" id="" value="1" <?php echo $course['course_all_time'] == 1 ? 'checked' : ''; ?>>
	                	Yes
	                </label>
	                <label>
	                	<input type="radio" name="course_all_time" id="" value="0" <?php echo $course['course_all_time'] == 0 ? 'checked' : ''; ?>>
	                	No
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	              	<label>Price</label>
	              	<input class="form-control" type="text" name="course_price" id="course_price" value="<?php echo $course['course_price']; ?>">
	              </div>
	              <div class="form-group form-group-radio">
	                <label>Visibility</label><br>
	                <label>
	                	<input type="radio" name="course_visibility" id="" value="0" <?php echo $course['course_visibility'] == 0 ? 'checked' : '' ; ?>>
	                	Public
	                </label>
	                <label>
	                	<input type="radio" name="course_visibility" id="" value="1" <?php echo $course['course_visibility'] == 1 ? 'checked' : ''; ?>>
	                	Ragistered users
	                </label>
	                <label>
	                	<input type="radio" name="course_visibility" id="" value="2" <?php echo $course['course_visibility'] == 2 ? 'checked' : ''; ?>>
	                	Privileged Users
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group form-group-radio">
	              	<label>Status</label><br>
	                <label>
	                  <input type="radio" name="course_status" value="1" class="minimal" <?php echo $course['course_status'] == 1 ? 'checked' : ''; ?>>
	                  Active
	                </label>
	                <label>
	                  <input type="radio" name="course_status" value="0" class="minimal" <?php echo $course['course_status'] == 0 ? 'checked' : ''; ?>>
	                  Inactive
	                </label>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Image</label>

					<div>
						<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo ($thumb == '' ? $placeholder : $thumb); ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="course_image" value="<?php echo ($course['course_image']); ?>" id="course_image" />
					</div>
	              </div>
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
			  <table class="table course-tools-table" data-tool-count="<?php echo count($course_chapters) > 0 ? count($course_chapters) : '1'; ?>">
	          		<?php if(count($course_chapters) > 0){ ?>
	          			<?php $ti = 1; foreach($course_chapters as $course_chapter){ ?>
	          				<tr class="course-tool-single" data-current="<?php echo $ti; ?>">
								<td>
									<div class="form-group">
										<label>Chapter <?php echo $ti; ?></label>
									</div>
									<!-- /.form-group -->
								</td>
								<td>
									<div class="form-group">
										<label>Select <span class="tool-name"></span></label>
										<select required class="form-control course-tool-id" name="course_chapters[<?php echo $ti; ?>][chapter_id]" id="">
											<option value="">Select</option>
											<?php foreach($chapters as $chapter){ ?>
												<option <?php echo $course_chapter['courses_has_chapters_chapter_id'] == $chapter['chapter_id'] ? 'selected' : ''; ?> value="<?php echo $chapter['chapter_id']; ?>"><?php echo $chapter['chapter_title']; ?></option>
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
					<?php } ?>
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
	$("#edit-course").validate();

	$('.course-tools-table').on('click', '.add-tool', function(){
		var that = $(this);
		var counter = parseInt($('.course-tools-table').attr('data-tool-count'));
		var next_counter = counter+1;

		$('.course-tools-table').attr('data-tool-count', next_counter);

		var single_tool = '<tr class="course-tool-single" data-current="'+next_counter+'">		        	<td>		        		<div class="form-group">			                <label>Chapter '+next_counter+'</label>			                <button class="btn btn-info hide course-tool" type="button" >Get</button>			            </div>			            <!-- /.form-group -->			        </td>			        <td>			            <div class="form-group">			                <label>Select <span class="tool-name"></span></label>			                <select class="form-control course-tool-id" name="course_chapters['+next_counter+'][chapter_id]" id="">			                	<option value="">Select</option>';

		<?php foreach($chapters as $chapter){ ?>
			single_tool += '<option value="<?php echo $chapter['chapter_id']; ?>"><?php echo $chapter['chapter_title']; ?></option>';
		<?php } ?>

		single_tool += '</select>			            </div>			            <!-- /.form-group -->		        	</td>		        	<td align="right" valign="bottom">		        		<a href="javascript:void(0)" class="btn btn-sm btn-danger remove-tool"><i class="fa fa-minus"></i></a><a href="javascript:void(0)" class="btn btn-sm btn-info add-tool"><i class="fa fa-plus"></i></a>		        	</td>	        	</tr>';

		$('.course-tools-table').append(single_tool);
		//$('.course-tool').click();

	});

	$('.course-tools-table').on('click', '.remove-tool', function(){
		var decision = confirm("Are you sure want to delete this entry ?");
		if(decision){
			$(this).parent().parent('.course-tool-single').remove();
		}
	});
</script>
