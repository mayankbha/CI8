<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Quiz > <?php echo $quiz->quiz_title; ?> > Edit Question
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/quiz'); ?>">Quiz</a></li>
		<li class="active">Edit Question</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="edit-quiz" method="post" action="<?php echo base_url('admin/quiz/edit_question/?quiz='.$quiz->quiz_id.'&question='.$question['quiz_question_id']); ?>">
		<input type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quiz->quiz_id; ?>">
		<input type="hidden" name="quiz_user_id" id="quiz_user_id" value="<?php echo $quiz->quiz_user_id; ?>">
		<input type="hidden" name="quiz_question_id" id="quiz_question_id" value="<?php echo $question['quiz_question_id']; ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
				<h3 class="box-title">Add Question</h3>
				<div class="box-tools pull-right"></div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">

	        	<!-- Questions for current quiz -->
	        	<div class="quiz-questions-form">
	        		<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

						<div class="row">
							<?php //dump($question); ?>
							<div class="col-sm-6">
		                    	<div class="form-group">
									<label>Title</label>
		                        	<textarea class="form-control textarea" name="title" placeholder="Question Title"><?php echo $question['quiz_question_title'] ? $question['quiz_question_title'] : ''; ?></textarea>
		                       	</div>
							</div>
	                       		<div class="col-sm-6">
			                       	<div class="form-group">
										<label>Marks</label>
										<input class="form-control" type="number" name="marks" placeholder="Marks" value="<?php echo $question['quiz_question_marks']; ?>">
			                       	</div>

			                       	<div class="form-group form-group-radio">
										<label>Status</label><br>
			                       		<label>
			                        		<input type="radio" <?php echo $question['quiz_question_status'] == 1 ? 'checked' : ''; ?> name="status" value="1" >
			                        		Active
			                        	</label>
			                        	<label>
			                        		<input type="radio" <?php echo $question['quiz_question_status'] == 0 ? 'checked' : ''; ?> name="status" value="0" >
			                        		Inactive
			                        	</label>
			                       	</div>

									<div class="form-group form-group-radio">
										<label>Type</label><br>
			                       		<label>
			                        		<input class="qtype" type="radio" <?php echo $question['quiz_question_type'] == 'multiplechoice' ? 'checked' : ''; ?> name="type" value="multiplechoice" >
			                        		Multiple choice
			                        	</label>
			                        	<label>
			                        		<input class="qtype" type="radio" <?php echo $question['quiz_question_type'] == 'oneanswer' ? 'checked' : ''; ?> name="type" value="oneanswer" >
			                        		One answer
			                        	</label>
			                       	</div>
			                    </div>
			                </div>


							<div class="awnsers-here" <?php echo $question['quiz_question_type'] == 'oneanswer' ? 'style="display:none;"' : ''; ?> >
								<hr>
				                <div class="row">

				                	<div class="col-sm-6">
										<input type="hidden" name="answers[1][answer_id]" value="<?php echo isset($question['answers'][0]) ? $question['answers'][0]['quiz_question_answer_id'] : ''; ?>" />
			                       		<div class="form-group">
											<label>Answer 1</label>
				                    		<textarea class="form-control" name="answers[1][text]" placeholder="Answer 1 Text"><?php echo isset($question['answers'][0]) ? $question['answers'][0]['quiz_question_answer_text'] : ''; ?></textarea>
				                    	</div>
				                    	<div class="form-group form-group-radio">
				                    		<label>
				                    			<input type="radio" <?php echo isset($question['answers'][0]) ? $question['answers'][0]['quiz_question_answer_is_correct'] == 1 ? 'checked' : '' : ''; ?> name="correct_answer" value="1">
				                    			Correct
				                    		</label>
				                    	</div>
				                    </div>
				                    <div class="col-sm-6">
										<input type="hidden" name="answers[2][answer_id]" value="<?php echo isset($question['answers'][1]) ? $question['answers'][1]['quiz_question_answer_id'] : ''; ?>" />
			                       		<div class="form-group">
											<label>Answer 2</label>
				                    		<textarea class="form-control" name="answers[2][text]" placeholder="Answer 2 Text"><?php echo isset($question['answers'][1]) ? $question['answers'][1]['quiz_question_answer_text'] : ''; ?></textarea>
				                    	</div>
				                    	<div class="form-group form-group-radio">
				                    		<label>
				                    			<input type="radio" <?php echo isset($question['answers'][1]) ?  $question['answers'][1]['quiz_question_answer_is_correct'] == 1 ? 'checked' : '' : ''; ?> name="correct_answer" value="2">
				                    			Correct
				                    		</label>
				                    	</div>
				                    </div>
				                </div>

				                <div class="row">
									<?php //if(isset($question['answers'][2])){ ?>
					                	<div class="col-sm-6">
											<input type="hidden" name="answers[3][answer_id]" value="<?php echo isset($question['answers'][2]) ? $question['answers'][2]['quiz_question_answer_id'] : ''; ?>" />
				                       		<div class="form-group">
												<label>Answer 3</label>
					                    		<textarea class="form-control" name="answers[3][text]" placeholder="Answer 3 Text"><?php echo isset($question['answers'][2]) ? $question['answers'][2]['quiz_question_answer_text'] : ''; ?></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" <?php echo isset($question['answers'][2]) ? $question['answers'][2]['quiz_question_answer_is_correct'] == 1 ? 'checked' : '' : ''; ?> name="correct_answer" value="3">
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
									<?php //} ?>
									<?php //if(isset($question['answers'][3])){ ?>
					                    <div class="col-sm-6">
											<input type="hidden" name="answers[4][answer_id]" value="<?php echo isset($question['answers'][3]) ? $question['answers'][3]['quiz_question_answer_id'] : ''; ?>" />
				                       		<div class="form-group">
												<label>Answer 4</label>
					                    		<textarea class="form-control" name="answers[4][text]" placeholder="Answer 4 Text"><?php echo isset($question['answers'][3]) ? $question['answers'][3]['quiz_question_answer_text'] : ''; ?></textarea>
					                    	</div>
					                    	<div class="form-group form-group-radio">
					                    		<label>
					                    			<input type="radio" <?php echo isset($question['answers'][3]) ? $question['answers'][3]['quiz_question_answer_is_correct'] == 1 ? 'checked' : '' : ''; ?> name="correct_answer" value="4">
					                    			Correct
					                    		</label>
					                    	</div>
					                    </div>
									<?php //} ?>
				                </div>
							</div>

	        	</div>   <!-- Question end -->

	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	            <a href="<?php echo site_url('admin/quiz'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="save_question" class="btn btn-info pull-right">Save</button>
	        </div>
	    </div>
	</form>
</section>
<!-- /.content -->

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#edit-quiz").validate();

	$('.qtype').click(function(){
		if($(this).val() == 'multiplechoice'){
			$('.awnsers-here').slideDown();
		}else{
			$('.awnsers-here').slideUp();
		}
	});

</script>
