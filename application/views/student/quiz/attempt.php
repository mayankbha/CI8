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
			<form id="quiz-question-form" class="form" method="post" action="<?php echo base_url('student/quiz/process_answer'); ?>" >
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                    <input type="hidden" name="chapter_id" value="<?php echo $chapter_id; ?>" />
                    <input type="hidden" name="tool_id" value="<?php echo $tool_id; ?>" />
                    <input type="hidden" name="quiz_id" value="<?php echo $quiz['quiz_id']; ?>" />
                    <input type="hidden" name="quiz_question_id" value="<?php echo $quiz['questions'][$q_current]['quiz_question_id']; ?>" />
                    <input type="hidden" name="q_current" value="<?php echo $q_current; ?>" />
                    <input type="hidden" name="qtimer" id="qtimer" value="<?php echo $quiz['quiz_duration'] * 60; ?>" />
                    <input type="hidden" name="quiz_attempt_id" value="<?php echo $quiz_attempt_id; ?>">

                    <div class="row">
                        <div class="col-12">
                            <div class="col-4 pull-right text-right">
                                <h5>
                                    Timer : <span id='timer'></span>
                                </h5>
                            </div>
                        </div>
                    </div>
					 
					
            <div class="row cont-area">
              <h1>Course Title</h1>
            </div>
            <div class="row cont-top-sec">
              <div class="col-lg-9">
                <h2>Quiz Title</h2>
                <h3>5th Standard</h3>
              </div>
              <div class="col-lg-3"> <h4>Question</h4><h3>Question  <strong>2 of 5</strong></h3></div>
            </div>
            <div class="row cont-top-thr pad-lft-02">
              <h2>Question</h2>
            </div>
			 <div class="row cont-area">
              <h3 style="margin-left:25px;"><?php echo $quiz['questions'][$q_current]['quiz_question_title']; ?></h3>
            </div>
            <div class="my-quiz">
            	<div class="my-quiz-in">
                	<table width="100%" border="0">
						<?php 
						
						
						$count = 1;
						foreach($quiz['questions'][$q_current]['answers'] as $answer){ 
							if ($count%2 == 1){echo "<tr>";} ?>
								<td>
									<div class="radio">
										<input name="answer" type="radio" value="<?php echo $answer['quiz_question_answer_id'] ?>">
										<span><?php echo htmlspecialchars($answer['quiz_question_answer_text']); ?></span>
									</div>
								</td>
					 <?php 
								if ($count%2 == 0){echo "</tr>";}$count++;					 
						} 
								if ($count%2 != 1) echo "</tr>"; ?>
                    </table>
						<?php if(isset($last_question)){ ?>
							<button class="btn btn-primary blue-but border-dsh quiz-mg" id="finish-quiz" type="submit">Finish</button>
						<?php }else{ ?>
							<button class="btn btn-primary blue-but border-dsh quiz-mg" id="next-question" type="submit">Next</button>
						<?php } ?>
                </div>
            </div>
            <div class="my-box margin-top">
               <div class="my-lft"></div>
               <div class="my-right"></div>
               </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    var timeoutHandle;
    function countdown(minutes, stat) {
        var seconds = 60;
        var mins = minutes;

        if(getCookie("minutes") && getCookie("seconds") && stat){
             var seconds = getCookie("seconds");
             var mins = getCookie("minutes");
        }
         
        function tick() {
            
            var qtimer = document.getElementById("qtimer");
            var counter = document.getElementById("timer");
            setCookie("minutes", mins, 10)
            setCookie("seconds", seconds, 10)
            var current_minutes = mins-1
            seconds--;
            counter.innerHTML = 
            current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);

            qtimer.value = (current_minutes*60) + seconds;
            //save the time in cookie
            
            if((current_minutes*60) + seconds == 0){
                setCookie("minutes",mins,0);
                setCookie("seconds",seconds,0);
                //ajax finish quiz
                //callFinishMethod();
            }
            
            if( seconds > 0 ) {
                timeoutHandle = setTimeout(tick, 1000);
            } else {
                 
                if(mins > 1){
                     
                    // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst    
                    setTimeout(function () { 
                        countdown(parseInt(mins)-1, false); 
                    }, 1000);
                         
                }
            }
        }
        tick();
    }
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname+"="+cvalue+"; "+expires;
    }
     function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    //countdown(<?php echo $quiz['quiz_duration'] ?>,true);
    countdown(1, true);

    function callFinishMethod() {
        var url = "<?php echo base_url('student/quiz/ajax_finish_quiz'); ?>";
        var parameters = {
            "course_id": $('#quiz-question-form [name="course_id"]').val(),
            "chapter_id": $('#quiz-question-form [name="chapter_id"]').val(),
            "tool_id": $('#quiz-question-form [name="tool_id"]').val(),
            "quiz_id": $('#quiz-question-form [name="quiz_id"]').val(),
            "quiz_question_id": $('#quiz-question-form [name="quiz_question_id"]').val(),
            "q_current": $('#quiz-question-form [name="q_current"]').val(),
            "quiz_attempt_id": $('#quiz-question-form [name="quiz_attempt_id"]').val()
        };

        //show loading... image
        $.ajax({
            type: 'POST',
            url: url,
            data: parameters,
            success: onSuccess,
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error! '+errorThrown);
            }
        });
    }

    function onSuccess(param) {
        window.location.href = "<?php echo base_url('student/quiz/?course='.$course_id.'&chapter='.$chapter_id.'&tool='.$tool_id.'&quiz='.$quiz_id); ?>";
    }
</script>
