<?php //$k = get_chapter_count(1);echo($k);  ?>
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
                  <h2>Progress</h2>
                </div>
              </div>
              <div class="green-border">
                Progress
				<div class="progress">
					<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $progress ?>%" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<p></p>
                <p> Chapters Completed : <?php echo $completed ?> of <?php echo count($course_chapters); ?></p>  </div>
            </div>
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
                    <td>Lesson</td>
                  </tr>
                </table>
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
							<?php } 
						} ?>
                </table>
              </div>
            </div>
          </div>
		<?php foreach($course_chapters as $row){$lesson_count =  @count($row['tools']);} ?>
          <div class="col-lg-8 right-sd pad-lft-01">
            <div class="row cont-area">
              <h1><?php echo $course->course_title; ?></h1>
            </div>
            <div class="row cont-top-sec">
              <div class="col-lg-9">
                <h2><?php //echo $chapter_title = get_chapter_title($course->course_id) ?></h2>
                <h2><?php echo $chapter_title = $chapter_data->chapter_title; ?></h2>
                <h3 style="display:none">Chapters  <strong><?php echo isset($_GET['chapter']) ? $_GET['chapter'] : '' ?> of <?php echo count($course_chapters); ?></strong></h3>
              </div>
              <div class="col-lg-3" > <h4><?php echo $temp_data->lesson_and_quiz_title; ?></h4><h3 style="display:none"><?php echo isset($_GET['lesson']) ? $_GET['lesson'] : '' ?> of <?php echo $lesson_count; ?></h3></div>
            </div>

            <?php if(count($quiz_attempts) == 0){ ?>
              <div class="row cont-top-thr pad-lft-02">
                <h2>Description</h2>
                <p><?php //echo $lesson->lesson_description; ?></p>
                <p><?php echo $temp_data->lesson_and_quiz_description; ?></p>
              </div>
            <?php } ?>

            <div class="my-box margin-top">
            <div class="my-lft">
              <?php $attempt_title = 'Take the Quiz to Complete this lession'; ?>
                <?php if(count($quiz_attempts) > 0){ ?>
                    <div class="col-12">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Marks</th>
                                    <th>Total Marks</th>
                                    <th>Completed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($quiz_attempts as $quiz_attempt){ ?>
                                    <tr>
                                        <td><?php echo formated_date($quiz_attempt['quiz_attempt_datetime']); ?></td>
                                        <td><?php echo $quiz_attempt['quiz_attempt_marks']; ?></td>
                                        <td><?php echo array_sum($quiz_question_marks); ?></td>
                                        <td><?php echo print_complete_status($quiz_attempt['quiz_attempt_complete_status']); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php $attempt_title = 'Re-attempt Quiz'; ?>
                <?php } ?>

                <a class="blue-but border-dsh" href="<?php echo base_url('student/lessonquiz/quiz/?course='.$course->course_id.'&chapter='.$this->input->get('chapter').'&tool='.$this->input->get('tool').'&lessonquiz='.$this->input->get('lessonquiz').'&lesson_attempt_id='.$lesson_attempt_id.'&quiz='.$quiz['quiz_id'].'&start=1'); ?>"><?php echo $attempt_title; ?></a>

				<?php /*$tool_link = get_tool_link_for_student($course->course_id, $this->input->get('chapter'),$this->input->get('tool'),'lesson', $lesson->lesson_id); ?>
				<?php if($attempt_log->lesson_attempt_complete_status == 1){ ?>
					<a class="btn btn-success" onclick="return false" href="javascript:void(0)">
						<i class="fa fa-check-circle" ></i> Completed
					</a>
				<?php }else{ ?>
					<a class="blue-but border-dsh" <?php echo $attempt_log->lesson_attempt_complete_status == 1 ? 'disabled="disabled"' : ''; ?> onclick="return completeLessonConfirm()" href="<?php echo $tool_link.'&con='.$lesson_attempt_id; ?>">
						Mark as Complete
					</a>
				<?php }*/ ?>
			</div>
			
			<?php if($next){ ?>
				<div class="col-6 pull-right text-right">
				<?php
				$tool_link = get_tool_link_for_student($course->course_id, $next->chapter_tool_chapter_id,$next->chapter_tool_id,$next->chapter_tool_object, $next->chapter_tool_object_id);

				if(isset($c_c_attempt[0]['c_c_attempt_id'])){
					$tool_link .= '&c_com='.$c_c_attempt[0]['c_c_attempt_id'];
				} ?>
				<div class="my-right">
				<a class="green-but border-dsh" href="<?php echo $tool_link; ?>">Next</a>
				<p><?php echo $next->object->{$next->chapter_tool_object.'_title'}; ?></p>
				</div>
				</div>
			<?php } ?>
		
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>