<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Content -->
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
        <div class="row">
          <div class="col-lg-4 col-sm-6 sidebar">
            <div class="comm-side">
              <div class="head-sd green-spl">
                <div class="head-green">
                  <h2>Course Overview</h2>
                </div>
              </div>
              <div class="green-border">
                <table width="100%" border="0">
                  <tr>
                    <th width="80">Chapters</th>
                    <td>:</td>
                    <td><?php echo count($course_chapters); ?></td>
                  </tr>
                  <tr>
                    <th>Type</th>
                    <td>:</td>
                    <td>Multiple Choice Questions</td>
                  </tr>
                </table>
               
                <?php if(empty($check_completed_chapter)) { ?>
                  <a href="<?php echo base_url('student/course/attempt/'.$course->course_id); ?>" class="blue-but border-dsh margin-top">Start Course</a>
                <?php } else { ?>
                      <?php $tool_link = get_tool_link_for_student($continue_next_course_chapter_data['course_id'], $continue_next_course_chapter_data['chapter_id'], $continue_next_course_chapter_data['tool_id'], $continue_next_course_chapter_data['chapter_tool_object'], $continue_next_course_chapter_data['lessonquiz']); ?>
                      <a href="<?php echo $tool_link; ?>" class="blue-but border-dsh margin-right">Continue</a>
                <?php } ?>
                </div>
            </div>
            <div class="comm-side">
              <div class="head-sd green-spl">
                <div class="head-green">
                  <h2>Badges</h2>
                </div>
              </div>
              <div class="green-border">
			  <?php if($badge){ ?>
				<ul class="nav justify-content-left">
					<li><img src="<?php echo base_url().'/uploads/'.$badge->badge_image ?>"></li>
				</ul>
              <?php } ?>
              </div>
            </div>
            <div class="comm-side">
              <div class="head-sd green-spl">
                <div class="head-green">
                  <h2>Other Courses</h2>
                </div>
              </div>
              <div class="green-border oth-cou">
				<table width="100%" border="0">
				 <?php if(count($other_courses) > 0){
							 foreach($other_courses as $other_course){ ?>
								<tr>
									<th width="120">- <?php echo $other_course['course_title']; ?></th>
									<td>:</td>
									<td align="right"><a href="<?php echo base_url('course/detail/'.$other_course['course_id']); ?>" class="green-but border-dsh">View</a></td>
								</tr>
					   <?php 	} 
						} ?>
                </table>
				
              </div>
            </div>
          </div>

          <div class="col-lg-8 right-sd pad-lft-01">
			<?php if($this->session->flashdata('error_message')){?>
				<div class="row cont-area error_message" style="color:#FF2626;">
					<h2><?php echo $this->session->flashdata('error_message'); ?></h2> 
				</div>
			<?php	} ?>
            <!--<div class="row cont-area">
              <h1>Course Detail Page</h1> 
            </div> -->
            <div class="row cont-top-sec">
              <div class="col-lg-9">
                <h2><?php echo $course->course_title; ?></h2>
                <h3></h3>
              </div>
              <div class="col-lg-3">
                <?php if(empty($check_completed_chapter)) { ?>
                  <a href="<?php echo base_url('student/course/attempt/'.$course->course_id); ?>" class="blue-but border-dsh margin-right">Start Course</a>
                <?php } else { ?>
                    <?php $tool_link = get_tool_link_for_student($continue_next_course_chapter_data['course_id'], $continue_next_course_chapter_data['chapter_id'], $continue_next_course_chapter_data['tool_id'], $continue_next_course_chapter_data['chapter_tool_object'], $continue_next_course_chapter_data['lessonquiz']); ?>
                    <a href="<?php echo $tool_link; ?>" class="blue-but border-dsh margin-right">Continue</a>
                <?php } ?>
              </div>
            </div>
            <div class="row cont-top-thr pad-lft-02">
              <h2>Description</h2>
              <p><?php echo $course->course_description; ?></p>
            </div>
            <div class="row table-part pad-lft-02">
              <table width="100%" border="0">
                <thead>
                  <tr>
                    <th width="60"><!--<input name="" type="checkbox" value="">--></th>
                    <td>Inbox</td>
                  </tr>
                </thead>
                
              </table>
			  <div id="accordion" role="tablist" style="width:100%">
                        <?php $ti = 1; foreach($course_chapters as $k=>$course_chapter){ ?>
                            <div class="card">

                                <div class="card-header" role="tab" id="heading-<?php echo $k; ?>">
                                    <h5 class="mb-0">
                                        <a style="text-decoration: none;" data-toggle="collapse" href="#tool-<?php echo $k; ?>" aria-expanded="true" aria-controls="tool-<?php echo $k; ?>">
                                            <input name="" type="checkbox" value="">
											<span style="margin-left:7%;color:red;"><?php echo $course_chapter['chapter_title']; ?></span>
                                        </a>
                                    </h5>
                                </div>

                                <div id="tool-<?php echo $k; ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $k; ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php
                                            echo '<ol>';
                                            foreach($course_chapter['tools'] as $ctk=>$c_tool){
                                                ?>
                                                <li><?php echo $c_tool['object']->{$c_tool['chapter_tool_object'].'_title'} ?></li>
                                                <?php
                                            }
                                            echo '</ol>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php $ti++; ?>
                        <?php } ?>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
setTimeout(function(){ 
	$('.error_message').html('').delay(2500);
}, 3000);

</script>