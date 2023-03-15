<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	Lesson
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Lesson</li>
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
	            	<h3 class="box-title">Lesson List</h3>
	            	<div class="box-tools">

						<form class="form-inline" enctype="multipart/form-data" method="get" action="<?php echo base_url('admin/lesson/getInfo'); ?>">

							<div class="form-group">

								<div class="input-group input-group-sm">
									<select class="form-control" id='class' name="cid">
    									<option value="" selected="selected">Select Chapter Here....</option>
    									<?php foreach ($chapter as $value){ ?>
    										<option <?php echo $this->input->get('cid') == $value['chapter_id'] ? 'selected' : ''; ?> value="<?php echo $value['chapter_id']?>">
    											<?php echo $value['chapter_title']?>
    										</option>
    									<?php } ?>
    								</select>

					                  <div class="input-group-btn">
					                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					                  </div>
				                </div>
							</div>
							|
							<div class="input-group input-group-sm">
			                	<a class="btn btn-success btn-sm" href="<?php echo site_url('admin/lesson/add'); ?>"><i class="fa fa-plus"></i></a>
			                </div>
						</form>
		            </div>
	            </div>
	            <!-- /.box-header -->

	            <div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
		                <tbody>
		                	<tr>
			                  <th>ID</th>
			                  <th>Lesson Name</th>
			                  <th>Chapter</th>
			                  <th>Date</th>
			                  <th>Action</th>
		                	</tr>
		                	<?php if(!empty($lesson)){ ?>
			                	<?php foreach($lesson as $less){ ?>
					                <tr>
										<td><?php echo $less['lesson_id']; ?></td>
										<td><?php echo $less['lesson_title']; ?></td>
										<td>
											<?php
												foreach($less['chapters'] as $k=>$chapter){
													if($k > 0) echo ', ';
													echo $chapter['chapter_title'];
												}
											?>
										</td>
										<td><?php echo formated_datetime($less['lesson_created_at']); ?></td>
										<td>
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/lesson/edit_lesson/'.$less['lesson_id'] ); ?>"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/lesson/delete_lesson/'.$less['lesson_id']); ?>" onclick="return deleteConfirm()"><i class="fa fa-trash"></i></a>
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
