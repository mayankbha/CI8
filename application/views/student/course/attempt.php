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
                    <td>Multiple Choice Questions</td>
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
          <div class="col-lg-8 right-sd pad-lft-01">
            <div class="col-12">
                    <h1><?php echo $course->course_title; ?></h1>
                </div>
                <div class="col-12">
                    <p><?php echo $course->course_description; ?></p>
                </div>
                <div class="col-12">
                    <div id="accordion" role="tablist">
                        <?php $ti = 1; foreach($course_chapters as $k=>$course_chapter){ ?>
                            <div class="card">

                                <div class="card-header" role="tab" id="heading-<?php echo $k; ?>">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#tool-<?php echo $k; ?>" aria-expanded="false" aria-controls="tool-<?php echo $k; ?>">
                                            <?php echo $ti.'. '; ?><?php echo $course_chapter['chapter_title']; ?>
                                        </a>
                                    </h5>
                                </div>

                                <div id="tool-<?php echo $k; ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?php echo $k; ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php
                                            echo '<ol>';
                                            foreach($course_chapter['tools'] as $ctk=>$c_tool){
                                                ?>
                                                <li>
                                                    <?php $tool_link = get_tool_link_for_student($course->course_id, $course_chapter['chapter_id'],
                                                    $c_tool['chapter_tool_id'],
                                                    $c_tool['chapter_tool_object'], $c_tool['chapter_tool_object_id']); ?>
                                                    <a href="<?php echo $tool_link; ?>">
                                                        <?php echo $c_tool['object']->{$c_tool['chapter_tool_object'].'_title'} ?>
                                                    </a>
                                                </li>
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
</div>