
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
        <div class="row" style="min-height:350px;">
        <legend class="all-cor" style="margin-left:15px; margin-bottom:15px;">All Courses</legend>
            <?php foreach($courses as $course){ ?>
                <div class="col-3 course-box">
                    <div class="card text-center">
                       <div class="thum-cour"> <img class="card-img-top img-fluid" src="<?php echo get_course_image_url($course['course_image']); ?>" alt="<?php echo $course['course_title']; ?>"></div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $course['course_title']; ?></h4>
                            <?php /*?><p class="card-text"><?php echo excerpt($course['course_description'], 75); ?></p><?php */?>
                            <p class="card-text"><?php echo $course['course_description']; ?></p>
                            <a href="<?php echo base_url('course/detail/'.$course['course_id']); ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
         </div>
      </div>
    </div>
  </div>
</div>