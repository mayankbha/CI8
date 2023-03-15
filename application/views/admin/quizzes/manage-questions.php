<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Quiz > Questions
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/quiz'); ?>">Quiz</a></li>
		<li class="active">Questions</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $quiz['quiz_title']; ?></h3>
			<div class="box-tools pull-right"></div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<?php echo $quiz['quiz_description']; ?>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="pull-right">Duration: <?php echo $quiz['quiz_duration'] ? $quiz['quiz_duration'] : 0; ?> min</div>
		</div>
		<!-- /.box-footer -->
	</div>
	<form enctype="multipart/form-data" class="form" id="edit-quiz" method="post" action="<?php echo current_url(); ?>">
		<input type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quiz['quiz_id']; ?>">
		<input type="hidden" name="quiz_user_id" id="quiz_user_id" value="<?php echo $quiz['quiz_user_id']; ?>">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Manage Questions</h3>
				<div class="box-tools pull-right">
					<a class="btn btn-success btn-xs" href="<?php echo base_url('admin/quiz/add_question/'.$quiz['quiz_id']); ?>"><i class="fa fa-plus"></i></a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<!-- Questions for current quiz -->
				<div class="quiz-questions-form" data-view="<?php echo count($quiz['questions']) == 0 ? 1 : count($quiz['questions']); ?>">
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
									<a class="btn btn-danger btn-xs remove-question-ajax" href="javascript:void(0)" data-qid="<?php echo $question['quiz_question_id']; ?>"><i class="fa fa-minus"></i></a>
									<a class="btn btn-success btn-xs" href="<?php echo base_url('admin/quiz/edit_question/?quiz='.$quiz['quiz_id'].'&question='.$question['quiz_question_id']); ?>"><i class="fa fa-pencil"></i></a>
								</div>
							</div>
						</div>
						<div id="collapse-<?php echo $qk + 1; ?>" class="panel-collapse collapse">
							<div class="box-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control" type="hidden" name="quiz_questions[<?php echo $qk + 1; ?>][question_id]" value="<?php echo $question['quiz_question_id']; ?>">
											<?php echo $question['quiz_question_title']; ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Marks:</label> <?php echo $question['quiz_question_marks']; ?>
										</div>

										<div class="form-group form-group-radio">
											<label>Status:</label> <?php echo $question['quiz_question_status']; ?>
										</div>

										<div class="form-group form-group-radio">
											<label>Type:</label> <?php echo $question['quiz_question_type']; ?>

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
										<?php if(($ai%2) == 0 || count($question['answers']) == $ai){ ?>
										</div>
										<?php } ?>
										<?php $ai++; ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php }else{ ?>
							<?php } ?>
							</div>   <!-- Question end -->
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<a href="<?php echo site_url('admin/quiz'); ?>" class="btn btn-default">Cancel</a>
						</div>
					</div>
				</form>
			</section>
			<!-- /.content -->
			<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
			<script type="text/javascript">
				$("#edit-quiz").validate();
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
