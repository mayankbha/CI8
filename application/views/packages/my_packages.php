<!-- Page Content -->
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
        <div class="row" style="min-height:350px;">
           
           <section>
			<h2 style="text-align:center">My Purchased Courses</h2>
			<br>
			<div class="row">

			<?php if(!empty($packages)){ ?>
			<table width="100%" class="table table-striped pak-tb">
						<th >Course Name</th>
						<th >Price</th>
						<th >Date Purchased </th>
						<th >Expiry Date</th>
						<th >Completion/Progress</th>
						<th >Action</th>
                        <th >&nbsp;</th>
                        <th >&nbsp;</th>
                        <th >&nbsp;</th>
                        <th >&nbsp;</th>
                        
			<?php foreach($packages as $pack){ 
			$price = number_format($pack['package_price']) * 100 ;	?>
			<!-- First package -->
			<div class="col-md-10">
				<tr>
					<?php
						$courses = get_package_courses($pack['package_id']);
						if($courses){
							foreach ($courses as $cor){ ?>
								<td ><?php echo $cor['course_title']; ?> </td>
								<td > <?php echo round($pack['package_price']); ?> </td>
								<td ><?php echo date('d F, Y' , strtotime($pack['start_duration'])); ?> </td>
								<td > <?php echo date('d F, Y' , strtotime($pack['end_duration'])); ?> </td>
								<td >
									<?php 
										$course_status = get_course_status($cor['package_courses']);
										echo $course_status['status'];
									?> 
								</td>
								 
						<?php
							}
						}
					?>
					</tr>
				</div>
			<?php } ?>
			</table>
			<?php } ?>

			</div> 
		

			</section>
			</div>
      </div>
    </div>
  </div>
</div>