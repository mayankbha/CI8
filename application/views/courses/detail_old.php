<div class="container-fluid p-0 bg-green">
    <div class="container row-first">
        <div class="row">
            <div class="col-3">
                <aside>
                    <h3 class="sidebar-heading">Overview</h3>
                    <dl class="row">
                        <dt class="col-4">Chapters: </dt>
                        <dd class="col-8"><?php echo count($course_chapters); ?></dd>
                    </dl>
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url('student/course/attempt/'.$course->course_id); ?>">Start Course</a>
                </aside>
                <?php if($badge){ ?>
                    <aside>
                        <h3 class="sidebar-heading">Badges</h3>
                        <ul class="nav justify-content-left">
                            <li><img src="<?php echo $this->model_tool_image->resize($badge->badge_image, 50, 50); ?>" alt="<?php echo $badge->badge_title; ?>" /></li>
                        </ul>
                    </aside>
                <?php } ?>
                <aside>
                    <h3 class="sidebar-heading">Other Courses</h3>
                    <?php if(count($other_courses) > 0){ ?>
                        <ul class="nav flex-column">
                            <?php foreach($other_courses as $other_course){ ?>
                                    <li class="nav-item"><a href="<?php echo base_url('course/detail/'.$other_course['course_id']); ?>"><?php echo $other_course['course_title']; ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </aside>
            </div>
            <div class="col-9">
                <div class="col-12">
                    <h1>
                        <?php echo $course->course_title; ?>
                        <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url('student/course/attempt/'.$course->course_id); ?>">Start Course</a>
                    </h1>
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
                                        <a data-toggle="collapse" href="#tool-<?php echo $k; ?>" aria-expanded="true" aria-controls="tool-<?php echo $k; ?>">
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




            <?php //dump($course); ?>
        </div>
    </div>
</div>
