<style>
.navbar-toggler {
	z-index: 1;
}
 @media (max-width: 576px) {
nav > .container {
	width: 100%;
}
}
/* Temporary fix for img-fluid sizing within the carousel */
    
.carousel-item.active, .carousel-item-next, .carousel-item-prev {
	display: block;
}
</style>
<!-- Page Content -->
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec my-acc">
        <div class="row">
          
          <div class="col-lg-8 right-sd pad-lft-01">
		  <div class="com-mcc">
		  <h2>Ongoing Courses</h2>
		  </div>
		<?php $course_list = get_courses_status_list();
		//echo "<pre/>";print_r($course_list);
				if ( isset($course_list) && isset($course_list['Ncomplete']) ){
					foreach($course_list['Ncomplete'] as $not_completed_course){ 
					$badge_ids [] = $not_completed_course['badge_id'];
					?>
						<a href="<?php echo base_url('course/detail/'.$not_completed_course['id']); ?>">
						<div class="com-mcc">
							<div class="course-tl">
								<table width="100%" border="0">
								<tr>
									<td width="350">
										<h3><?php echo $not_completed_course['title'] ?></h3>
										<h4>Chapters Completed : <?php echo $not_completed_course['completed'] .' of '.$not_completed_course['total_courses'] ?></h4>
									</td>
									<td>
										<span>Progress Bar </span>
										<div class="progress-bar bg-success my-pro-bar" role="progressbar" style="width: <?php echo $not_completed_course['progress'] ?>%" aria-valuenow="<?php echo $not_completed_course['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</td>
								</tr>
								</table>

							</div>
						</div>
						</a>
				<?php
					}
				}
				?>
            
			<div class="cmplited-course">
				<h2>Course Completed</h2>
			
			<?php
			if ( isset($course_list) && isset($course_list['complete']) ){
					foreach($course_list['complete'] as $completed_course){ ?>
						<div class="badge-com">
							<table width="100%" border="0">
								<tr>
									<td width="430"><h3><?php echo $completed_course['title'] ?> - </h3></td>
									<td>
										<a href="<?php echo base_url('student/course/attempt/'.$completed_course['id']); ?>" class="blue-but border-dsh margin-top">Retake Course</a> 
									</td>
								</tr>
							</table>
							<table width="100%" border="0" class="bad-nk">
								<tr>
								<?php
									$chapters = get_course_chapters($completed_course['id']);
									if($chapters){
										foreach($chapters as $chapter){ ?>
											<td><img src="<?php echo base_url('assets/images/Badges-icon.jpg');  ?>"><h4><?php echo $chapter['chapter_title'] ?></h4></td>
									<?php
										}
									}
									?>
								</tr>
							</table>
						</div>
				<?php
					}
				}else{
				?>
					<div class="badge-com">
							<table width="100%" border="0" class="bad-nk">
								<tr>
									<td><h2>No Course Completed !...</h2></td>									
								</tr>
							</table>
					</div>				
				<?php } ?>
             </div>
             

          </div>
          <div class="col-lg-4 col-sm-6 sidebar">
          
          	 
            <div class="comm-side">
              <div class="head-sd green-spl">
                <div class="head-green">
                  <h2>Subscription Details</h2>
                </div>
              </div>
              <div class="green-border user-div">
                <table width="100%" border="0">
                  <tr>
                    <th width="60"><img src="<?php echo base_url('assets/images/user-icon.jpg');  ?>"></th>
                    <td><h2><?php echo @$student_name ?> </h2>
                    	<h3>Class : <?php echo @$student_class ?></h3>
                    </td>
                   </tr>
                 </table>
                 <table width="100%" border="0" class="sub-bot">
                  <tr>
                    <th width="60" align="right"><img src="<?php echo base_url('assets/images/board-icon-sml.png');  ?>"></th>
                    <td> <h4>
					<?php
					$package_name = get_package_name($user_id);
					$name = '';
					if($package_name){
						foreach($package_name as $package){
								$name .= $package['package_title'].', ';
								$expiry_date = $package['end_duration'];
						}
					}
					$name = rtrim($name,", ");
					echo (!empty($name)) ? $name : 'Not Subscribed' ;
					?>
					
					</h4>
                    	 
                    </td>
                   </tr>
                   <tr>
                    <th width="60" align="right"><img src="<?php echo base_url('assets/images/cal-icon.png');  ?>"></th>
                    <td> <h4><?php echo isset($expiry_date) ? date('d F, Y',strtotime($expiry_date) ) : ' -- -- ----' ; ?></h4></td>
					
					<?php if(!empty($name)){ ?>
						<td> <h4>
							 <br><br>
							 <a href="<?php echo base_url('package/myPackages');  ?>" class="green-but border-dsh"><span style="float:right"> View All </span>
							 </a>
						</h4></td>
					<?php } ?>
                   </tr>
                 </table>
                 
               </div>
            </div>
            <div class="comm-side">
              <div class="head-sd green-spl">
                <div class="head-green">
                  <h2>Next Badge</h2>
                </div>
              </div>
              <div class="green-border">
                <ul>
                 <?php
					if($badge_ids){
						$i=0;
						foreach ($badge_ids as $bid){
							if($i<3){
							$badges = get_course_badge($bid); ?>
							 <li>
								<img style="width:70px;" src="<?php echo base_url().'/uploads/'.$badges->badge_image ?>">
								<p style="text-align:center"><?php echo $badges->badge_title; ?></p>
							</li>
						<?php
						}
						$i++;
						}
					}
				?>
                </ul>
              </div>
            </div>
             
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /.container --> 