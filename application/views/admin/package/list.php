<!--Content Header (Page header) -->
	<section class="content-header">
	<h1>
	Packages
	<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Package</li>
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
	            	<h3 class="box-title">Package List</h3>
	            	<div class="box-tools">
		                <div class="input-group input-group-sm">
		                	<a class="btn btn-success btn-sm" href="<?php echo site_url('admin/package/add'); ?>"><i class="fa fa-plus"></i></a>
		                </div>
		            </div>
	            </div>
	            <!-- /.box-header -->

	            <div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
		                <tbody>
		                	<tr>
			                  <th>ID</th>
			                  <th>Package Name</th>
			                  <th>Duration</th>
			                  <th>Price</th>
			                  <th>Date</th>
			                  <th>Action</th>
		                	</tr>
		                	<?php if(!empty($packages)){ ?>
			                	<?php foreach($packages as $pack){ ?>
					                <tr>
										<td><?php echo $pack['package_id']; ?></td>
										<td><?php echo $pack['package_title']; ?></td>
										<td><?php echo $pack['package_duration']; ?></td>
										<td><?php echo $pack['package_price']; ?></td>
										<td><?php echo formated_datetime($pack['package_created_at']); ?></td>
										<td>
											<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/package/edit_package/'.$pack['package_id'] ); ?>"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/package/delete_package/'.$pack['package_id']); ?>" onclick="return deleteConfirm()"><i class="fa fa-trash"></i></a>
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
	<!-- /.content-->
