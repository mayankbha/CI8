<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Quizzes > Edit
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/quiz'); ?>">Quizzes</a></li>
		<li class="active">Edit</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="edit-quiz" method="post" action="<?php echo current_url(); ?>">
		<input type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quiz['quiz_id']; ?>">
		<input type="hidden" name="quiz_user_id" id="quiz_user_id" value="<?php echo $quiz['quiz_user_id']; ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
				<h3 class="box-title">Edit Quiz</h3>
				<div class="box-tools pull-right"></div>
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
	                <input required class="form-control" type="text" name="quiz_title" id="quiz_title" value="<?php echo $quiz['quiz_title']; ?>">
	              </div>
	              <!-- /.form-group -->
                  <div class="form-group form-group-radio">
	                <label>Badge</label><br>
					<select class="form-control select2" name="quiz_badge" id="quiz_badge" data-placeholder="Select a Badge">
						<option value="">Select</option>
	                	<?php foreach($badges as $badge){ ?>
	                		<option <?php if($badge['badge_id'] == $quiz['quiz_badge']){ echo 'selected'; } ?> value="<?php echo $badge['badge_id']; ?>"><?php echo $badge['badge_title']; ?></option>
	                	<?php } ?>
	                </select>
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Description</label>
	                <textarea class="form-control textarea" name="quiz_description" id="quiz_description"><?php echo $quiz['quiz_description']; ?></textarea>
	              </div>
	              <!-- /.form-group -->
				  <div class="col-sm-6">
					  <div class="form-group form-group-radio">
		              	<label>Status</label><br>
		                <label>
		                  <input type="radio" name="quiz_status" value="1" class="minimal" <?php echo $quiz['quiz_status'] == 1 ? 'checked' : ''; ?>>
		                  Active
		                </label>
		                <label>
		                  <input type="radio" name="quiz_status" value="0" class="minimal" <?php echo $quiz['quiz_status'] == 0 ? 'checked' : ''; ?>>
		                  Inactive
		                </label>
		              </div>
		              <!-- /.form-group -->
				  </div>
				  <div class="col-sm-6">
					  <div class="form-group">
		              	<label>Duration (min)</label>
						<input type="number" name="quiz_duration" class="form-control" value="<?php echo $quiz['quiz_duration'] ? $quiz['quiz_duration'] : 0; ?>">
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
	$("#edit-quiz").validate();

	$('.quiz-questions-form').on('click', '.add-question', function(){
		var that = $(this);
		var counter = parseInt($('.quiz-questions-form').attr('data-view'));
		var next_counter = counter+1;

		$('.quiz-questions-form').attr('data-view', next_counter);

		var single_question = '<div class="panel box box-warning quiz-questions-single"><div class="box-header with-border">	                    <h4 class="box-title">	                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse-'+next_counter+'">	                      	Question '+next_counter+'	                      </a>	                    </h4>	                    <div class="box-tools">			                <div class="input-group input-group-sm pull-right">			                	<a class="btn btn-danger btn-xs remove-question" href="javascript:void(0)"><i class="fa fa-minus"></i></a>		<a class="btn btn-success btn-xs add-question" href="javascript:void(0)"><i class="fa fa-plus"></i></a>			                </div>			            </div>	                  </div>	                  <div id="collapse-'+next_counter+'" class="panel-collapse collapse">	                    <div class="box-body">	                    	<div class="form-group">	                        	<input class="form-control" type="text" name="quiz_questions['+next_counter+'][title]" placeholder="Question Title">	                       	</div>	                       	<div class="row"><div class="col-sm-6"><div class="form-group">	                        	<input class="form-control" type="text" name="quiz_questions['+next_counter+'][marks]" placeholder="Marks">	                       	</div></div>	                       	<div class="col-sm-6"><div class="form-group form-group-radio">	                       		<label>	                        		<input type="radio" checked name="quiz_questions['+next_counter+'][status]" value="1">	                        		Active	                        	</label>	                        	<label>	                        		<input type="radio" name="quiz_questions['+next_counter+'][status]" value="0">	                        		Inactive	                        	</label>	                       	</div></div></div><hr>	                       	<div class="row"><div class="col-sm-6">	                       		<div class="form-group">		                    		<textarea class="form-control" name="quiz_questions['+next_counter+'][answers][1][text]" placeholder="Answer 1 Text"></textarea>		                    	</div>		                    	<div class="form-group form-group-radio">		                    		<label>		                    			<input type="radio" checked name="correct_answers['+next_counter+'][correct_answer]" value="1">		                    			Correct		                    		</label>		                    	</div></div>		                    	<div class="col-sm-6"><div class="form-group">		                    		<textarea class="form-control" name="quiz_questions['+next_counter+'][answers][2][text]" placeholder="Answer 2 Text"></textarea>		                    	</div>		                    	<div class="form-group form-group-radio">		                    		<label>		                    			<input type="radio" name="correct_answers['+next_counter+'][correct_answer]" value="2">		                    			Correct		                    		</label>		                    	</div>	                       	</div></div>	                       	<div class="row"><div class="col-sm-6">	                       		<div class="form-group">		                    		<textarea class="form-control" name="quiz_questions['+next_counter+'][answers][3][text]" placeholder="Answer 3 Text"></textarea>		                    	</div>		                    	<div class="form-group form-group-radio">		                    		<label>		                    			<input type="radio" name="correct_answers['+next_counter+'][correct_answer]" value="3">		                    			Correct		                    		</label>		                    	</div></div>		                    	<div class="col-sm-6"><div class="form-group">		                    		<textarea class="form-control" name="quiz_questions['+next_counter+'][answers][4][text]" placeholder="Answer 4 Text"></textarea>		                    	</div>		                    	<div class="form-group form-group-radio">		                    		<label>		                    			<input type="radio" name="correct_answers['+next_counter+'][correct_answer]" value="4">		                    			Correct		                    		</label>		                    	</div></div>	                       	</div>	                    		                    </div>	                  </div>	                </div>';

		$('.quiz-questions-form').append(single_question);

	});

	$('.quiz-questions-form').on('click', '.remove-question', function(){
		var decision = confirm("Are you sure want to delete this entry ?");
		if(decision){
			$(this).parent().parent().parent().parent('.quiz-questions-single').remove();
		}
	});

	$('.quiz-questions-form').on('click', '.remove-question-ajax', function(){
		var decision = confirm("Are you sure want to delete this entry ?");
		var that = $(this);
		var q_id = that.attr('data-qid');
		if(decision){
			$.ajax({
				method: "POST",
				url: "<?php echo site_url('admin/quiz/delete_question'); ?>/"+q_id
			})
			.done(function( response ){
			    response = $.parseJSON(response);
			    if(response.status){
			    	that.parent().parent().parent().parent('.quiz-questions-single').remove();
			    }

			    alert(response.msg);
			})
			.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});

		}
	});

</script>
