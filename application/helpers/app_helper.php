<?php

function dump($data){
	echo '<pre>';
		var_dump($data);
	echo '</pre>';
}

function excerpt($text, $limit = 30){
	$text = strip_tags($text);
	$text = substr($text, 0, $limit);

	return $text.' ...';
}

function formated_date($date){
    return date('d M, Y', strtotime($date));
}

function formated_datetime($date){
    return date('d M, Y H:i', strtotime($date));
}

function print_status($status){
	return $status ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
}

function print_complete_status($status){
	return $status ? '<span class="label label-success"><i class="fa fa-check"></i></span>' : '<span class="label label-warning"><i class="fa fa-spinner"></i></span>';
}

function get_user_image_url($image_name = false){
	if($image_name){
		return base_url('uploads/'.$image_name);
	}else{
		return base_url('uploads/person-dummy.jpg');
	}
}

function get_course_image_url($image_name = false){
	if($image_name){
		return base_url('uploads/'.$image_name);
	}else{
		return base_url('uploads/no-image-box.png');
	}
}

function get_badge_image_url($image_name = false){
	if($image_name){
		return base_url('uploads/'.$image_name);
	}else{
		return base_url('uploads/placeholder.png');
	}
}

function get_column($column, $stack){
	$return_array = [];

	foreach($stack as $key => $val){
		$return_array[] = $val[$column];
	}

	return $return_array;
}

function get_tool_link_for_student($course_id, $chapter_id, $tool_id, $object, $object_id){
	$link = '';
	switch($object){
		case 'lesson':
			$link = base_url('student/lesson/attempt/?course='.$course_id.'&chapter='.$chapter_id.'&tool='.$tool_id.'&lesson='.$object_id);
		break;

		case 'quiz':
			$link = base_url('student/quiz/?course='.$course_id.'&chapter='.$chapter_id.'&tool='.$tool_id.'&quiz='.$object_id);
		break;

		case 'lesson_and_quiz':
			$link = base_url('student/lessonquiz/attempt/?course='.$course_id.'&chapter='.$chapter_id.'&tool='.$tool_id.'&lessonquiz='.$object_id);
		break;
	}

	return $link;
}

// ADD BY DEV A 
function get_course_title($course_id=1){
	$CI =& get_instance();
	$result = $CI->Course_Model->get_course_title($course_id);
	return $result;	
}

function get_chapter_title($chapter_id=1){
	$CI =& get_instance();
	$result = $CI->Course_Model->get_chapter_title($chapter_id);
	return $result;	
}

function get_all_courses(){
	$CI =& get_instance();
	$result = $CI->Course_Model->get_courses();
	return $result;	
}

function get_chapter_count($course_id=0){
	$CI =& get_instance();
	$result = $CI->Chapter_Tools_Model->get_course_count($course_id);
	return $result;	
}

/*
* Check weather user can access course or not
*/
function can_access($user_id=0,$course_id=0) {
	$CI =& get_instance();
	$today_date = date('Y-m-d');
	$allowed_courses = $CI->Package_Model->get_user_subscribed_package($user_id,$today_date);
	if(!$allowed_courses){
		redirect(base_url('/Package/course/'.$course_id));
	}

	$access_courses = array();
	foreach($allowed_courses as $row)	 {
		$courses  = json_decode($row['allowed_courses']);
		if($courses){
			foreach($courses as $row1){
				$access_courses[] = $row1;
			}
		}
		
	}

	// Check IF Subscribed belongs to current course or not
	if(in_array($course_id,$access_courses)){
		return TRUE;
	}else{
		redirect(base_url('/Package/course/'.$course_id));
	}
}

/*
* Get 3 Not Completed & 2 Completed Courses
*/
function get_courses_status_list(){
	$CI =& get_instance();
	$all_courses = $CI->Course_Model->get_courses();
	$course_array = array();
	$i=0;
	if($all_courses){
		foreach ($all_courses as $course){
			$course_id = $course['course_id'];
			$course_title = $course['course_title'];
			$course_badge_id = $course['course_badge'];  
			$course_chapters = $CI->Courses_Has_Chapters_Model->get_with_chapter_with_tools($course_id);
			
			$user_id = isset($CI->data['loggedin_user']->user_id) ? $CI->data['loggedin_user']->user_id : 0;
			$lesson_ids = $quiz_ids = $chapter_ids =   array();
			$l_not_completed_chapters = $q_not_completed_chapters = $not_completed_chapters =  array();
			if(isset($course_chapters) && !empty($course_chapters) ){
				foreach($course_chapters as $row){
					if($row){
						$chapter_ids[] = $row['courses_has_chapters_chapter_id'];
						foreach($row['tools'] as $res){
							if($res['chapter_tool_object']=='lesson'){ 
								$lesson_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->lesson_id;
							}elseif( $res['chapter_tool_object'] == 'lesson_and_quiz') {
								//$lesson_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->lesson_and_quiz_id;
								$lesson_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->lesson_id;
							}elseif($res['chapter_tool_object']=='quiz'){ 
								$quiz_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->quiz_id;
							}
						}
					}
				}
			}
		
			if($lesson_ids){
				foreach($lesson_ids as $key => $lessons){
					foreach($lessons as $lid){
						$chapter_id = $key;
						
						// Get Status of all lesson's of chapter return 0 if not attempt yet
						$result = $CI->Lesson_Attempts_Model->get_lesson_status($course_id, $user_id, $chapter_id, $lid);
						
						// Check IF RESULT IS ZERO/Lesson not complete yet; assign it to chapter array to know which chapter is still pending
						if($result==0){
							$l_not_completed_chapters[$chapter_id]  = $result;
						}
					}
				}
			}
			
			if($quiz_ids){
				foreach($quiz_ids as $keya => $quiz){
					foreach($quiz as $qid){
						$q_chapter_id = $keya;
						
						// Get Status of all lesson's of chapter return 0 if not attempt yet
						$q_result = $CI->Lesson_Attempts_Model->get_quiz_status($course_id, $user_id, $q_chapter_id, $qid);
						
						// Check IF RESULT IS ZERO/Lesson not complete yet assign it to chapter array to know which chapter is still pending
						if($q_result==0){
							$q_not_completed_chapters[$q_chapter_id]  = $q_result;
						}
					}
				}
				
				//$not_completed_chapters = $l_not_completed_chapters + $q_not_completed_chapters ; 
			}
			
			$not_completed_chapters = $l_not_completed_chapters + $q_not_completed_chapters ;
			// Calculate no of chapter's not completed yet
			$completed = ( count($course_chapters) - count($not_completed_chapters) ) ;
			if(isset($completed) && ( count($course_chapters) > 0  )){
				$progress =  ( $completed / count($course_chapters)) * 100;
			}else{
				$progress = 0;
			}
			
			
			if($progress == 100){
				$course_array['complete'][$i]['title'] = $course_title ; 
				$course_array['complete'][$i]['progress'] = $progress ; 
				$course_array['complete'][$i]['id'] = $course_id ; 
			}else{
				$course_array['Ncomplete'][$i]['title'] = $course_title ; 
				$course_array['Ncomplete'][$i]['progress'] = $progress  ; 
				$course_array['Ncomplete'][$i]['id'] = $course_id ; 
				$course_array['Ncomplete'][$i]['badge_id'] = $course_badge_id ; 
				$course_array['Ncomplete'][$i]['completed'] = $completed ; 
				$course_array['Ncomplete'][$i]['total_courses'] = count($course_chapters) ; 
			}
			$i++;
		}
	}
		//echo"<pre/>";
		//print_r($course_array);
		return $course_array;
		
}

/*
* Get Single Course Status
*/
function get_course_status($course_id=0){
	$CI =& get_instance();
	$all_courses = $CI->Course_Model->get_course_by_id($course_id);
	$course_array = array();
	$i=0;
	if($all_courses){
		foreach ($all_courses as $course){
			$course_id = $course->course_id;
			$course_title = $course->course_title;
			$course_chapters = $CI->Courses_Has_Chapters_Model->get_with_chapter_with_tools($course_id);
			
			$user_id = isset($CI->data['loggedin_user']->user_id) ? $CI->data['loggedin_user']->user_id : 0;
			$lesson_ids = $quiz_ids = $chapter_ids =   array();
			$l_not_completed_chapters = $q_not_completed_chapters = $not_completed_chapters =  array();
			if(isset($course_chapters) && !empty($course_chapters) ){
				foreach($course_chapters as $row){
					if($row){
						$chapter_ids[] = $row['courses_has_chapters_chapter_id'];
						foreach($row['tools'] as $res){
							if($res['chapter_tool_object']=='lesson'){ 
								$lesson_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->lesson_id;
							}elseif( $res['chapter_tool_object'] == 'lesson_and_quiz') {
								$lesson_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->lesson_and_quiz_id;
							}elseif($res['chapter_tool_object']=='quiz'){ 
								$quiz_ids[$row['courses_has_chapters_chapter_id']][] = @$res['object']->quiz_id;
							}
						}
					}
				}
			}
		
			if($lesson_ids){
				foreach($lesson_ids as $key => $lessons){
					foreach($lessons as $lid){
						$chapter_id = $key;
						
						// Get Status of all lesson's of chapter return 0 if not attempt yet
						$result = $CI->Lesson_Attempts_Model->get_lesson_status($course_id, $user_id, $chapter_id, $lid);
						
						// Check IF RESULT IS ZERO/Lesson not complete yet; assign it to chapter array to know which chapter is still pending
						if($result==0){
							$l_not_completed_chapters[$chapter_id]  = $result;
						}
					}
				}
			}
			
			if($quiz_ids){
				foreach($quiz_ids as $keya => $quiz){
					foreach($quiz as $qid){
						$q_chapter_id = $keya;
						
						// Get Status of all lesson's of chapter return 0 if not attempt yet
						$q_result = $CI->Lesson_Attempts_Model->get_quiz_status($course_id, $user_id, $q_chapter_id, $qid);
						
						// Check IF RESULT IS ZERO/Lesson not complete yet assign it to chapter array to know which chapter is still pending
						if($q_result==0){
							$q_not_completed_chapters[$q_chapter_id]  = $q_result;
						}
					}
				}
				
				//$not_completed_chapters = $l_not_completed_chapters + $q_not_completed_chapters ; 
			}
			
			$not_completed_chapters = $l_not_completed_chapters + $q_not_completed_chapters ;
			// Calculate no of chapter's not completed yet
			$completed = ( count($course_chapters) - count($not_completed_chapters) ) ;
			if(isset($completed) && ( count($course_chapters) > 0  )){
				$progress =  ( $completed / count($course_chapters)) * 100;
			}else{
				$progress = 0;
			}
			
			
			if($progress == 100){
				$course_array['status'] = 'Completed' ; 
			}else{
				$course_array['status'] = 'Not Completed' ; 
			}
			$i++;
		}
	}
		//echo"<pre/>";
		//print_r($course_array);
		return $course_array;
		
}

function get_course_chapters($course_id=0){
	$CI =& get_instance();
	$chapters_info = $CI->Courses_Has_Chapters_Model->get_chapter_details($course_id);
	if($chapters_info){
		return $chapters_info;
	}else{
		return false;
	}
}

function get_package_name($user_id=0){
	$CI =& get_instance();
	$result = $CI->Package_Model->get_package_name($user_id);
	return $result;	
}

function get_package_courses($package_id=0){
	$CI =& get_instance();
	$result = $CI->Package_Tool_Model->get_course_by_id($package_id);
	if($result){
		return $result;
	}else{
		return false;
	}
}

function get_course_badge($badge_id=0){
	$CI =& get_instance();
	$result = $CI->Badge_Model->get_badge_by_id($badge_id);
	if($result){
		return $result;
	}else{
		return false;
	}
}