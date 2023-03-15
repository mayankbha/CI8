<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Lesson > Edit
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('admin/lesson'); ?>">Lesson</a></li>
		<li class="active">Add</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<form enctype="multipart/form-data" class="form" id="add-lesson" method="post" action="<?php echo current_url(); ?>">
		<div class="box box-info">
	        <div class="box-header with-border">
	          <h3 class="box-title">Edit Lesson</h3>

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
	                <label>Lesson Title</label>
	                <input class="form-control" type="text" name="lesson_title" id="lesson_title" value="<?php echo $lesson->lesson_title; ?>">
	                <input class="form-control" type="hidden" name="lesson_id" id="lesson_id" value="<?php echo $lesson->lesson_id; ?>">
	              </div>
	              <!-- /.form-group -->
	              <div class="form-group">
	                <label>Sort Order</label>
	               <input class="form-control" type="text" name="lesson_sort_order" id="lesson_sort_order" value="<?php echo $lesson->lesson_sort_order; ?>">
	              </div>
	              <!-- /.form-group -->
	            
	              
	             
	              <!-- /.form-group -->
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	        	<div class="col-md-6 col-md-offset-3">
	            <a href="<?php echo site_url('admin/lesson'); ?>" class="btn btn-default">Cancel</a>
	            <button type="submit" name="update_lesson" class="btn btn-info pull-right">Save</button>
	        </div>
	        </div>
	    </div>
	</form>
	

	<div class="box-header with-border">
	          <h3 class="box-title">Related Chapter</h3>

	          <div class="box-tools pull-right">
	            
	          </div>
	        </div>
	

	<div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
		                <tbody>
		                	<tr>
			                  <th>ID</th>
			                  <th>Chapter Name</th>
			                  <th>Date</th>
			                  <th>Action</th>
		                	</tr>
		                	<?php if(!empty($chapter)){ ?>
			                	<?php foreach($chapter as $chap){ ?>
					                <tr>
										<td><?php echo $chap->chapter_id; ?></td>
										<td><?php echo $chap->chapter_title; ?></td>
										<td><?php echo $chap->chapter_created_at; ?></td>
										<td>
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/chapter/edit_chapter/'.$chap->chapter_id); ?>"><i class="fa fa-pencil"></i></a>
											
										</td>
					                </tr>
					            <?php } ?>
					        <?php } ?>
		            	</tbody>
	          		</table>
	            </div>
</section>
<!-- /.content -->