<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Quiz > <?php echo $quiz['quiz_title']; ?> > Add Question
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/quiz'); ?>">Quiz</a></li>
		<li class="active">Add Question</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">

	<form enctype="multipart/form-data" class="form" id="edit-quiz" method="post" action="<?php echo current_url(); ?>">
		<input type="hidden" name="quiz_id" id="quiz_id" value="<?php echo $quiz['quiz_id']; ?>">
		<input type="hidden" name="quiz_user_id" id="quiz_user_id" value="<?php echo $quiz['quiz_user_id']; ?>">
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
							<div class="col-sm-6">
		                    	<div class="form-group">
									<label>Title</label>
		                        	<textarea class="form-control textarea" name="title" placeholder="Question Title" value="" required=""></textarea>
		                       	</div>
							</div>
	                       		<div class="col-sm-6">
			                       	<div class="form-group">
										<label>Marks</label>
			                        	<input class="form-control" type="number" name="marks" placeholder="Marks" value="1" min="1">
			                       	</div>

			                       	<div class="form-group form-group-radio">
										<label>Status</label><br>
			                       		<label>
			                        		<input type="radio" checked name="status" value="1" >
			                        		Active
			                        	</label>
			                        	<label>
			                        		<input type="radio" name="status" value="0" >
			                        		Inactive
			                        	</label>
			                       	</div>

									<div class="form-group form-group-radio">
										<label>Type</label><br>
			                       		<label>
			                        		<input class="qtype" type="radio" checked name="type" value="multiplechoice" >
			                        		Multiple choice
			                        	</label>
			                        	<label>
			                        		<input class="qtype" type="radio" name="type" value="oneanswer" >
			                        		One answer
			                        	</label>
			                       	</div>
			                    </div>
			                </div>


							<div class="awnsers-here">
								<hr>
				                <div class="row">

				                	<div class="col-sm-6">
			                       		<div class="form-group">
											<label>Answer 1</label>
				                    		<textarea class="form-control" name="answers[1][text]" placeholder="Answer 1 Text" required=""></textarea>
				                    	</div>
				                    	<div class="form-group form-group-radio">
				                    		<label>
				                    			<input type="radio" name="correct_answer" value="1">
				                    			Correct
				                    		</label>
				                    	</div>
				                    </div>
				                    <div class="col-sm-6">
			                       		<div class="form-group">
											<label>Answer 2</label>
				                    		<textarea class="form-control" name="answers[2][text]" placeholder="Answer 2 Text" required=""></textarea>
				                    	</div>
				                    	<div class="form-group form-group-radio">
				                    		<label>
				                    			<input type="radio" name="correct_answer" value="2">
				                    			Correct
				                    		</label>
				                    	</div>
				                    </div>
				                </div>

				                <div class="row">

				                	<div class="col-sm-6">
			                       		<div class="form-group">
											<label>Answer 3</label>
				                    		<textarea class="form-control" name="answers[3][text]" placeholder="Answer 3 Text"></textarea>
				                    	</div>
				                    	<div class="form-group form-group-radio">
				                    		<label>
				                    			<input type="radio" name="correct_answer" value="3">
				                    			Correct
				                    		</label>
				                    	</div>
				                    </div>
				                    <div class="col-sm-6">
			                       		<div class="form-group">
											<label>Answer 4</label>
				                    		<textarea class="form-control" name="answers[4][text]" placeholder="Answer 4 Text"></textarea>
				                    	</div>
				                    	<div class="form-group form-group-radio">
				                    		<label>
				                    			<input type="radio" name="correct_answer" value="4">
				                    			Correct
				                    		</label>
				                    	</div>
				                    </div>
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
