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
	<form enctype="multipart/form-data" class="form" id="edit-lesson-quiz" method="post" action="<?php echo current_url(); ?>">
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
								<input required class="form-control" type="text" name="lesson_title" id="chapter_title" value="<?php echo $lesson->lesson_title; ?>">
								<input class="form-control" type="hidden" name="lesson_id" id="lesson_id" value="<?php echo $lesson->lesson_id; ?>">
							</div>
					 		<!-- form-group close -->
							<div class="form-group">
								<label> Lesson Description</label>
								<textarea class="form-control textarea" name="lesson_description" id="lesson_description"><?php echo $this->input->post('lesson_description'); ?><?php echo $lesson->lesson_description ?></textarea>
							</div>
		              		<!-- form-group close -->
							<div class="form-group">
								<label>Lesson Order</label>
								<input class="form-control" type="number" name="lesson_sort_order" id="lesson_sort_order" value="<?php echo $lesson->lesson_sort_order; ?>">
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
								<input required class="form-control" type="text" name="quiz_title" id="quiz_title" value="<?php echo $quiz['quiz_title']; ?>">
								<input class="form-control" type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quiz['quiz_id']; ?>">
							</div>
							<!-- /.form-group -->
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control textarea" name="quiz_description" id="quiz_description"><?php echo $quiz['quiz_description']; ?></textarea>
							</div>
							<!-- /.form-group -->
							<div class="form-group form-group-radio">
								<label>Status</label><br>
								<label>
									<input type="radio" name="quiz_status" value="1" class="minimal" <?php echo $quiz['quiz_status'] == 1 ? 'checked' : ''; ?>>
									Active
								</label>
								<label>
									<input type="radio" name="quiz_status" value="0" class="minimal" <?php echo $quiz['quiz_status']
								== 0 ? 'checked' : ''; ?>>
									Inactive
								</label>
							</div>
	            		</div>
	        		</div>
	    		</div>
			</div>

				<div class="quiz-questions-form" data-view="<?php echo count($quiz['questions']); ?>">
	        		<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
	        		<?php if(count($quiz['questions']) > 0){ ?>
		        		<?php foreach($quiz['questions'] as $qk=>$question){ ?>
		        			<div class="panel box box-warning quiz-questions-single">
			                  <div class="box-header with-border">
			                    <h4 class="box-title">
			                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $qk + 1; ?>">
			                      	Question <?php echo $qk + 1; ?>
			                      </a>
			                    </h4>
			                    <div class="box-tools">
					                <div class="input-group input-group-sm pull-right">
					                	<?php if($qk > 0){ ?>
					                		<a class="btn btn-danger btn-xs remove-question-ajax" href="javascript:void(0)" data-qid="<?php echo $question['quiz_question_id']; ?>"><i class="fa fa-minus"></i></a>
					                	<?php } ?>
					                	<a class="btn btn-success btn-xs add-question" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
					                </div>
					            </div>
			                  </div>
			                  <div id="collapse-<?php echo $qk + 1; ?>" class="panel-collapse collapse">
			                    <div class="box-body">
			                    	<div class="form-group">
			                        	<input class="form-control" type="hidden" name="quiz_questions[<?php echo $qk + 1; ?>][question_id]" value="<?php echo $question['quiz_question_id']; ?>">
			                        	<input class="form-control" type="text" name="quiz_questions[<?php echo $qk + 1; ?>][title]" placeholder="Question Title" value="<?php echo $question['quiz_question_title']; ?>">
			                       	</div>
			                       	<div class="row">
			                       		<div class="col-sm-6">
					                       	<div class="form-group">
					                        	<input class="form-control" type="text" name="quiz_questions[<?php echo $qk + 1; ?>][marks]" placeholder="Marks" value="<?php echo $question['quiz_question_marks']; ?>">
					                       	</div>
					                    </div>
					                    <div class="col-sm-6">
					                       	<div class="form-group form-group-radio">
					                       		<label>
					                        		<input type="radio" checked name="quiz_questions[<?php echo $qk + 1; ?>][status]" value="1" <?php echo $question['quiz_question_status'] == 1 ? 'checked' : ''; ?>>
					                        		Active
					                        	</label>
					                        	<label>
					                        		<input type="radio" name="quiz_questions[<?php echo $qk + 1; ?>][status]" value="0" <?php echo $question['quiz_question_status'] == 0 ? 'checked' : ''; ?>>
					                        		Inactive
					                        	</label>
					                       	</div>
					                    </div>
					                </div>
					                <hr>

					                <?php $ai = 1; foreach($question['answers'] as $ak=>$answer){ ?>
					                	<?php if(($ai%2) != 0){ ?>
					                		<div class="row">
					                	<?php } ?>
					                	<div class="col-sm-6">
				                       		<div class="form-group">
				                       			<input class="form-control" name="quiz_questions[<?php echo $qk + 1; ?>][answers][<?php echo $ai; ?>][answer_id]" value="<?php echo $answer['quiz_question_answer_id']; ?>" type="hidden">
					                    		<textarea class="form-control" name="quiz_questions[<?php echo $qk + 1; ?>][answers][<?php echo $ai; ?>][text]" placeholder="Answer <?php echo $ai; ?> Text"><?php echo $answer['quiz_question_answer_text']; ?></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" name="correct_answers[<?php echo $qk + 1; ?>][correct_answer]" value="<?php echo $ai; ?>" <?php echo $answer['quiz_question_answer_is_correct'] == 1 ? 'checked' : ''; ?>>
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
					                    <?php if(($ai%2) == 0){ ?>
					                		</div>
					                	<?php } ?>
					                	<?php $ai++; ?>
					                <?php } ?>

			                    </div>
			                  </div>
			                </div>
		        		<?php } ?>
		        		<?php }else{ ?>
		        			<div class="panel box box-warning quiz-questions-single">
			                  <div class="box-header with-border">
			                    <h4 class="box-title">
			                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse-1">
			                      	Question 1
			                      </a>
			                    </h4>
			                    <div class="box-tools">
					                <div class="input-group input-group-sm pull-right">
					                	<a class="btn btn-success btn-xs add-question" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
					                </div>
					            </div>
			                  </div>
			                  <div id="collapse-1" class="panel-collapse collapse">
			                    <div class="box-body">
			                    	<div class="form-group">
			                        	<input class="form-control" type="text" name="quiz_questions[1][title]" placeholder="Question Title" value="">
			                       	</div>
			                       	<div class="row">
			                       		<div class="col-sm-6">
					                       	<div class="form-group">
					                        	<input class="form-control" type="text" name="quiz_questions[1][marks]" placeholder="Marks" value="">
					                       	</div>
					                    </div>
					                    <div class="col-sm-6">
					                       	<div class="form-group form-group-radio">
					                       		<label>
					                        		<input type="radio" checked name="quiz_questions[1][status]" value="1" >
					                        		Active
					                        	</label>
					                        	<label>
					                        		<input type="radio" name="quiz_questions[1][status]" value="0" >
					                        		Inactive
					                        	</label>
					                       	</div>
					                    </div>
					                </div>
					                <hr>


					                <div class="row">

					                	<div class="col-sm-6">
				                       		<div class="form-group">
					                    		<textarea class="form-control" name="quiz_questions[1][answers][1][text]" placeholder="Answer 1 Text"></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" name="correct_answers[1][correct_answer]" value="1">
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
					                    <div class="col-sm-6">
				                       		<div class="form-group">
					                    		<textarea class="form-control" name="quiz_questions[1][answers][2][text]" placeholder="Answer 2 Text"></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" name="correct_answers[1][correct_answer]" value="2">
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
					                </div>

					                <div class="row">

					                	<div class="col-sm-6">
				                       		<div class="form-group">
					                    		<textarea class="form-control" name="quiz_questions[1][answers][3][text]" placeholder="Answer 3 Text"></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" name="correct_answers[1][correct_answer]" value="3">
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
					                    <div class="col-sm-6">
				                       		<div class="form-group">
					                    		<textarea class="form-control" name="quiz_questions[1][answers][4][text]" placeholder="Answer 4 Text"></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" name="correct_answers[1][correct_answer]" value="4">
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
					                </div>
			                    </div>
			                  </div>
			                </div>
		        		<?php } ?>

	        	</div>   <!-- Question end -->
	            <!-- /.col -->
	          
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
		        <div class="box-footer">
		        	<div class="col-md-12">
		            <a href="<?php echo site_url('admin/lesson_quiz'); ?>" class="btn btn-default">Cancel</a>
		            <button type="submit" name="update_lesson_quiz" class="btn btn-info pull-right">Update</button>
		        </div>
	        </div>
	    </div>
	</form>
</section>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#edit-lesson-quiz").validate();

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
