<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	Quiz
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Quiz</li>
	</ol>
	</section>
	<!-- Main content -->
	<section class="content">

		<!-- Main row -->
		<div class="row">
			<div class="col-xs-12">
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
	          <div class="box box-info">
	            <div class="box-header">
	            	<h3 class="box-title">Quizzes List</h3>
	            	<div class="box-tools">
		                <div class="input-group input-group-sm">
		                	<a class="btn btn-success btn-sm" href="<?php echo site_url('admin/quiz/add'); ?>"><i class="fa fa-plus"></i></a>
		                </div>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
		                <tbody>
		                	<tr>
			                  <th>ID</th>
			                  <th>Title</th>
							  <th>Questions</th>
			                  <th>Date</th>
			                  <th>Status</th>
			                  <th>Action</th>
		                	</tr>
		                	<?php if(!empty($quizzes)){ ?>
			                	<?php foreach($quizzes as $quiz){ ?>
					                <tr>
										<td><?php echo $quiz['quiz_id']; ?></td>
										<td><?php echo $quiz['quiz_title']; ?></td>
										<td>
											<span class="label label-info">
												<a href="<?php echo base_url('admin/quiz/questions/'.$quiz['quiz_id']); ?>" style="color:#ffffff;"><?php echo count($quiz['questions']); ?></a>
											</span>
										</td>
										<td><?php echo formated_datetime($quiz['quiz_created_at']); ?></td>
										<td>
											<?php echo print_status($quiz['quiz_status']); ?>
										</td>
										<td>
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/quiz/edit/'.$quiz['quiz_id']); ?>"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/quiz/delete/'.$quiz['quiz_id']); ?>" onclick="return deleteConfirm()"><i class="fa fa-trash"></i></a>
										</td>
					                </tr>
					            <?php } ?>
					        <?php } ?>
		            	</tbody>
	          		</table>
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	        </div>
		</div>
		<!-- /.row (main row) -->

	</section>
	<!-- /.content -->
