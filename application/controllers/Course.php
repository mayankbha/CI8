<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Frontend_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();

		$this->load->model('Courses_Has_Chapters_Model');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){

		$this->data['courses'] = $this->Course_Model->get_active_all();

		$this->data['page_title'] = $this->data['page_title'] . ' | Courses';
		$this->data['page_content'] = 'courses/all';
		$this->load->view('template', $this->data);
	}

	public function detail($course_id){

		$this->data['course'] = $this->Course_Model->get($course_id);
		$this->data['badge'] = $this->Badge_Model->get($this->data['course']->course_badge);
		$this->data['course_chapters'] = $this->Courses_Has_Chapters_Model->get_with_chapter_with_tools($course_id);
		$course_ids=array();

		$not_completed_chapters =  $this->calcualte_not_completed_chapters($this->data['course_chapters'],$course_id);
		$this->data['next_course_id'] = key($not_completed_chapters);

		$completed = ( count($this->data['course_chapters']) - count($not_completed_chapters) ) ; 
		$this->data['completed'] = $completed;

		$check_completed_chapter = $this->Lesson_Attempts_Model->check_completed_chapter($this->data['loggedin_user']->user_id, $course_id);
		$this->data['check_completed_chapter'] = $check_completed_chapter;

		$continue_next_course_chapter_data = $this->Lesson_Quiz_Model->get_next_course_chapter($this->data['loggedin_user']->user_id, $course_id);

		//echo "<pre>"; print_r($continue_next_course_chapter_data); die;

		$this->data['continue_next_course_chapter_data'] = $continue_next_course_chapter_data;

		$chapter_tool_data = $this->Chapter_Tools_Model->get_chapter_tool($continue_next_course_chapter_data->lesson_attempt_chapter_id, $continue_next_course_chapter_data->lesson_attempt_lesson_id);

		$this->data['chapter_tool_data'] = $chapter_tool_data;

		//Other Courses
		$cat_ids = $this->Course_Model->get_course_category_ids($course_id);

		if($cat_ids)
		$course_ids = $this->Course_Model->get_courses_by_category_ids($cat_ids);
				
		$current = array_search($course_id, $course_ids);
		if($current != false || $current == 0){
			unset($course_ids[$current]);
		}
		
		if($course_ids){
			$this->data['other_courses'] = $this->Course_Model->get_where_in($course_ids);
		}else{
			$this->data['other_courses']=array();
		}
		//echo "<pre/>";
		//print_r($this->data['course']);die;

		$this->data['page_title'] = $this->data['page_title'] . ' | '.$this->data['course']->course_title;
		$this->data['page_content'] = 'courses/detail';
		$this->load->view('template', $this->data);
	}

	public function calcualte_not_completed_chapters($course_chapters=array(),$course_id=0){
		$user_id = isset($this->data['loggedin_user']->user_id) ? $this->data['loggedin_user']->user_id : 0;
		$lesson_ids = $quiz_ids = $chapter_ids =   array();
		$l_not_completed_chapters = $q_not_completed_chapters = $not_completed_chapters =  array();
		if(isset($course_chapters) && !empty($course_chapters) ){
			foreach($course_chapters as $row){
				if($row){
					$chapter_ids[] = $row['courses_has_chapters_chapter_id'];
					foreach($row['tools'] as $res){
						if($res['chapter_tool_object']=='lesson'){ 
							$lesson_ids[$row['courses_has_chapters_chapter_id']][] = $res['object']->lesson_id;
						}elseif( $res['chapter_tool_object'] == 'lesson_and_quiz') {
							$lesson_ids[$row['courses_has_chapters_chapter_id']][] = $res['object']->lesson_and_quiz_id;
						}elseif($res['chapter_tool_object']=='quiz'){ 
							$quiz_ids[$row['courses_has_chapters_chapter_id']][] = $res['object']->quiz_id;
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
					$result = $this->Lesson_Attempts_Model->get_lesson_status($course_id, $user_id, $chapter_id, $lid);
					
					// Check IF RESULT IS ZERO/Lesson not complete yet assign it to chapter array to know which chapter is still pending
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
					$q_result = $this->Lesson_Attempts_Model->get_quiz_status($course_id, $user_id, $q_chapter_id, $qid);
					
					// Check IF RESULT IS ZERO/Lesson not complete yet assign it to chapter array to know which chapter is still pending
					if($q_result==0){
						$q_not_completed_chapters[$q_chapter_id]  = $q_result;
					}
				}
			}
		}
		$not_completed_chapters = $l_not_completed_chapters + $q_not_completed_chapters ; 
		
		return $not_completed_chapters;
	}

}
