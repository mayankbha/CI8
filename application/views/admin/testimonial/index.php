<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	Testimonials
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Testimonials</li>
	</ol>
	</section>
	<!-- Main content -->
	<section class="content">

		<!-- Main row -->
		<div class="row">
			<div class="col-sm-12">
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
			<div class="col-sm-12 col-md-4">
				<form class="form" action="<?php echo current_url(); ?>" method="post" id="category-form">
					<?php if(isset($testimonial)){ ?>
						<input type="hidden" name="t_id" id="t_id" value="<?php echo $testimonial->id; ?>">
					<?php } ?>
					<div class="box box-info">
			            <div class="box-header">
			            	<h3 class="box-title">Testimonial</h3>
			            </div>
			            <!-- /.box-header -->
		            	<div class="box-body">
		            		<div class="row">
		            			<div class="col-sm-12">
		            				<div class="form-group">
										<label>Name</label>
										<input required class="form-control" type="text" name="name" id="name" value="<?php echo isset($testimonial) ? $testimonial->name : $this->input->post('name'); ?>" />
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea required class="form-control" name="description" id="description" /><?php echo isset($testimonial) ? $testimonial->description : $this->input->post('description'); ?> </textarea>
									</div>
									<!-- /.form-group -->
									<div class="form-group form-group-radio">
						              	<label>Status</label><br>
						                <label>
						                  <input type="radio" name="status" value="1" class="minimal" <?php echo isset($testimonial) ? $testimonial->status == 1 ? 'checked' : '' : 'checked'; ?>>
						                  Active
						                </label>
						                <label>
						                  <input type="radio" name="status" value="0" class="minimal" <?php echo isset($testimonial) ? $testimonial->status == 0 ? 'checked' : '' : ''; ?>>
						                  Inactive
						                </label>
									</div>
									<!-- /.form-group -->
		            			</div>
		            		</div>
		            	</div>
		            	<div class="box-footer">
		            		<button class="btn btn-primary pull-right" name="save_changes" type="submit">Save Changes</button>
		            	</div>
		            </div>

				</form>
			</div>
			<div class="col-sm-12 col-md-8">

	          	<div class="box box-info">
		            <div class="box-header">
		            	<h3 class="box-title">Testimonial List</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body table-responsive no-padding">
		              <table class="table table-hover">
			                <tbody>
			                	<tr>
				                  <th>ID</th>
				                  <th>Name</th>
				                  <th>Description</th>
				                  <th>Status</th>
				                  <th>Action</th>
			                	</tr>
			                	<?php if(!empty($testimonials)){ ?>
				                	<?php foreach($testimonials as $row){ ?>
						                <tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['description']; ?></td>
											<td>
												<?php echo print_status($row['status']); ?>
											</td>
											<td>
												<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/testimonial/?tid='.$row['id']); ?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/testimonial/delete/'.$row['id']); ?>" onclick="return deleteConfirm()"><i class="fa fa-trash"></i></a>
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

	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$("#category-form").validate();
	</script>
