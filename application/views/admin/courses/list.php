<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	Course
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Course</li>
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
	            	<h3 class="box-title">Course List</h3>
	            	<div class="box-tools">
		                <div class="input-group input-group-sm">
		                	<a class="btn btn-success btn-sm" href="<?php echo site_url('admin/course/add'); ?>"><i class="fa fa-plus"></i></a>
		                </div>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
		                <tbody>
		                	<tr>
			                  <th>ID</th>
			                  <th>Image</th>
			                  <th>Name</th>
			                  <th>Price</th>
			                  <th>User</th>
			                  <th>Date</th>
			                  <th>Status</th>
			                  <th>Action</th>
		                	</tr>
		                	<?php if(!empty($courses)){ ?>
			                	<?php foreach($courses as $course){ ?>
					                <tr>
										<td><?php echo $course['course_id']; ?></td>
										<td><img class="img-responsive img-bordered" src="<?php echo get_course_image_url($course['course_image']); ?>" width="100px" alt="No Image"></td>
										<td><?php echo $course['course_title']; ?></td>
										<td><?php echo $course['course_price']; ?></td>
										<td><?php echo $course['course_user_id']; ?></td>
										<td><?php echo formated_datetime($course['course_created_at']); ?></td>
										<td>
											<?php echo print_status($course['course_status']); ?>
										</td>
										<td>
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/course/edit/'.$course['course_id']); ?>"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/course/delete/'.$course['course_id']); ?>" onclick="return deleteConfirm()"><i class="fa fa-trash"></i></a>
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
