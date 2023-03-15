<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessonquiz extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();

	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function attempt(){

		$course_id = $this->input->get('course');
		$chapter_id = $this->input->get('chapter');
		$tool_id = $this->input->get('tool');
		$lesson_id = $this->input->get('lessonquiz');

		$temp_data = $this->Lesson_Quiz_Model->get_with_lesson_with_quiz_id($lesson_id);

		$lesson_id = $temp_data->lesson_and_quiz_lesson_id;
		$quiz_id = $temp_data->lesson_and_quiz_quiz_id;

		//echo "<pre>"; print_r($temp_data); die;

		$this->data['temp_data'] = $temp_data;

		$this->data['chapter_data'] = $this->Chapter_Model->getChapter($chapter_id);

		$for_complete = $this->input->get('con') ? $this->input->get('con') : null;
		if($for_complete){
			$this->Lesson_Attempts_Model->mark_as_complete($for_complete);
		}
		$chapter_for_complete = $this->input->get('c_com') ? $this->input->get('c_com') : null;
		if($chapter_for_complete){
			$this->Course_Chapter_Attempts_Model->mark_as_complete($chapter_for_complete);
		}

		$this->data['course'] = $this->Course_Model->get($course_id);
		$this->data['badge'] = $this->Badge_Model->get($this->data['course']->course_badge);
		$this->data['course_chapters'] = $this->Courses_Has_Chapters_Model->get_with_chapter_with_tools($course_id);
		$course_ids=array();

		//echo "<pre>"; print_r($this->data['course_chapters']); die;

		// ADD BY DEV A Get Course Lesson/Quiz id(s)
		$not_completed_chapters =  $this->calcualte_not_completed_chapters($this->data['course_chapters'],$course_id);

		// Calculate no of chapter's not completed yet
		$completed = ( count($this->data['course_chapters']) - count($not_completed_chapters) ) ; 
		$this->data['completed'] = $completed;
		
		// END

		//Other Courses
		$cat_ids = $this->Course_Model->get_course_category_ids($course_id);
		$course_ids = $this->Course_Model->get_courses_by_category_ids($cat_ids);
		$current = array_search($course_id, $course_ids);
		if($current != false || $current == 0){
			unset($course_ids[$current]);
		}
		
		if($course_ids){
			$this->data['other_courses'] = $this->Course_Model->get_where_in($this->data['loggedin_user']->user_id, $course_id);
		}else{
			$this->data['other_courses']=array();
		}

		$this->data['course_log'] = $this->Course_Attempts_Model->get_all('', array(
			'course_attempt_course_id' => $course_id,
			'course_attempt_user_id' => $this->data['loggedin_user']->user_id,
		));
		
		//echo "<pre/>";print_r($this->data['course_log']);
		if(isset($completed) && ( count($this->data['course_chapters']) > 0  )){
			$this->data['progress'] =  ( $completed / count($this->data['course_chapters'])) * 100;
		}else{
			$this->data['progress'] = 0;
		}
		
		//log course chapter lesson attempt
		$this->data['lesson_attempt_id'] = $this->Lesson_Attempts_Model->log_attempt($course_id, $this->data['loggedin_user']->user_id, $chapter_id, $tool_id, $lesson_id);

		$this->data['attempt_log'] = $this->Lesson_Attempts_Model->get($this->data['lesson_attempt_id']);

		$this->data['lesson'] = $this->Lesson_Model->get($lesson_id);

		$this->data['quiz'] = $this->Quiz_Model->get_with_questions($quiz_id);

		$quiz_question_marks = array_column($this->data['quiz']['questions'], 'quiz_question_marks');
		$this->data['quiz_question_marks'] = $quiz_question_marks;

		$this->data['quiz_attempts'] = $this->Quiz_Attempts_Model->get_last_attempts($course_id, $this->data['loggedin_user']->user_id, $chapter_id, $tool_id, $quiz_id, 3);

		$this->data['next'] = $this->Chapter_Tools_Model->get_next_tool($tool_id, $chapter_id);
		if(!$this->data['next']){
			$this->data['next_chapter'] = $this->Courses_Has_Chapters_Model->get_next_chapter($course_id, $chapter_id);
			
			if($this->data['next_chapter'])
			$this->data['next'] = $this->Chapter_Tools_Model->get_next_tool($tool_id, $this->data['next_chapter']->courses_has_chapters_chapter_id);

			$this->data['c_c_attempt'] = $this->Course_Chapter_Attempts_Model->get_all('', array(
				'c_c_attempt_caid' => $this->data['attempt_log']->lesson_attempt_caid,
				'c_c_attempt_course_id' => $course_id,
				'c_c_attempt_user_id' => $this->data['loggedin_user']->user_id,
				'c_c_attempt_chapter_id' => $chapter_id
			));
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | '.$this->data['course']->course_title;
		$this->data['page_content'] = 'student/lesson/attempt';
		$this->load->view('student/template', $this->data);

	}
	
	public function quiz(){
		$this->data['course_id'] = $course_id = $this->input->get('course');
		$this->data['chapter_id'] = $chapter_id = $this->input->get('chapter');
		$this->data['tool_id'] = $tool_id = $this->input->get('tool');
		$this->data['lessonquiz'] = $this->input->get('lessonquiz');
		$this->data['lesson_attempt_id'] = $this->input->get('lesson_attempt_id');
		$this->data['quiz_id'] = $quiz_id = $this->input->get('quiz');
		$this->data['start'] = $start = $this->input->get('start');
		$this->data['quiz_attempt_id'] = $quiz_attempt_id = $this->input->get('qaid');

		$q_current = $this->input->post('q_current');

		$this->data['course'] = $this->Course_Model->get($course_id);
		$this->data['badge'] = $this->Badge_Model->get($this->data['course']->course_badge);
		$this->data['course_chapters'] = $this->Courses_Has_Chapters_Model->get_with_chapter_with_tools($course_id);
		$course_ids=array();
		
		// ADD BY DEV A Get Course Lesson/Quiz id(s)
		$not_completed_chapters =  $this->calcualte_not_completed_chapters($this->data['course_chapters'],$course_id);
		
		// Calculate no of chapter's not completed yet
		$completed = ( count($this->data['course_chapters']) - count($not_completed_chapters) ) ; 
		$this->data['completed'] = $completed;
		
		// END
		
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

		$this->data['course_log'] = $this->Course_Attempts_Model->get_all('', array(
			'course_attempt_course_id' => $course_id,
			'course_attempt_user_id' => $this->data['loggedin_user']->user_id,
		));
		
		if(isset($completed) && ( count($this->data['course_chapters']) > 0  )){
			$this->data['progress'] =  ( $completed / count($this->data['course_chapters'])) * 100;
		}else{
			$this->data['progress'] = 0;
		}

		if($start){
			$this->data['quiz_attempt_id'] = $quiz_attempt_id = $this->Quiz_Attempts_Model->log_attempt($course_id, $this->data['loggedin_user']->user_id, $chapter_id, $tool_id, $quiz_id);
		}

		$this->data['quiz'] = $this->Quiz_Model->get_with_questions($quiz_id);
		if($start){
			$this->data['q_current'] = 0;
		}else{
			$this->data['q_current'] = $this->session->flashdata('q_counter');
		}

		if($this->session->flashdata('q_counter')){
			$this->session->keep_flashdata('q_counter');
		}

		if($this->data['q_current'] >= (count($this->data['quiz']['questions']) - 1)){
			$this->data['last_question'] = $this->data['q_current'];
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | '.$this->data['course']->course_title;
		$this->data['page_content'] = 'student/lesson/quiz-attempt';
		$this->load->view('student/template', $this->data);
	}

	public function process_answer(){

		$course_id = $this->input->post('course_id');
		$chapter_id = $this->input->post('chapter_id');
		$tool_id = $this->input->post('tool_id');
		$lessonquiz = $this->input->post('lessonquiz');
		$lesson_attempt_id = $this->input->post('lesson_attempt_id');
		$quiz_id = $this->input->post('quiz_id');
		$quiz_question_id = $this->input->post('quiz_question_id');
		$q_current = $this->input->post('q_current');
		$qtimer = $this->input->post('qtimer');
		$given_answer_id = $this->input->post('answer');
		$quiz_attempt_id = $this->input->post('quiz_attempt_id');

		$given_answer = '';
		$mark_obtained = 0;

		$quiz = $this->Quiz_Model->get_with_questions($quiz_id);
		$quiz_question = $this->Quiz_Questions_Model->get_question_with_answers($quiz_question_id);
		foreach($quiz_question['answers'] as $answer){
			if($given_answer_id == $answer['quiz_question_answer_id']){
				$given_answer = $answer['quiz_question_answer_text'];
				
				if($answer['quiz_question_answer_is_correct'] == 1){
					$mark_obtained = $quiz_question['quiz_question_marks'];
				}
			}

		}
		
		//log course chapter quiz attempt
		$this->data['quiz_question_attempt_id'] = $this->Quiz_Question_Attempts_Model->log_attempt($course_id, $this->data['loggedin_user']->user_id, $chapter_id, $tool_id, $quiz_id, $quiz_question_id, json_encode($quiz_question), $given_answer, $mark_obtained);
		$this->data['attempt_log'] = $this->Quiz_Question_Attempts_Model->get($this->data['quiz_question_attempt_id']);
		
		if($q_current >= (count($quiz['questions']) - 1)){
			
			$marks = $this->Quiz_Question_Attempts_Model->get_total_marks($this->data['attempt_log']->q_q_attempt_qaid);
			
			$this->Lesson_Attempts_Model->mark_as_complete($lesson_attempt_id);

			$this->Quiz_Attempts_Model->mark_as_complete($this->data['attempt_log']->q_q_attempt_qaid, $marks->marks);
			
			redirect(base_url('student/lessonquiz/attempt/?qaid='.$quiz_attempt_id.'&course='.$course_id.'&chapter='.$chapter_id.'&tool='.$tool_id.'&lessonquiz='.$lessonquiz.'&lesson_attempt_id='.$lesson_attempt_id.'&quiz='.$quiz_id));
		}else{
			$this->session->set_flashdata('q_counter', $q_current+1);
		}
		
		redirect(base_url('student/lessonquiz/quiz/?qaid='.$quiz_attempt_id.'&course='.$course_id.'&chapter='.$chapter_id.'&tool='.$tool_id.'&lessonquiz='.$lessonquiz.'&lesson_attempt_id='.$lesson_attempt_id.'&quiz='.$quiz_id));
		
	}

	function ajax_finish_quiz(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}

		$course_id = $this->input->post('course_id');
		$chapter_id = $this->input->post('chapter_id');
		$tool_id = $this->input->post('tool_id');
		$quiz_id = $this->input->post('quiz_id');
		$quiz_question_id = $this->input->post('quiz_question_id');
		$q_current = $this->input->post('q_current');
		$qtimer = $this->input->post('qtimer');
		$quiz_attempt_id = $this->input->post('quiz_attempt_id');

		$marks = $this->Quiz_Question_Attempts_Model->get_total_marks($quiz_attempt_id);
		
		$this->Quiz_Attempts_Model->mark_as_complete($quiz_attempt_id, $marks->marks);

		echo true;
		die();
		
	}

	// ADD BY DEV A TO CALCUALTE NOT COMPLETED CHAPTERS
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
							//$lesson_ids[$row['courses_has_chapters_chapter_id']][] = $res['object']->lesson_and_quiz_id;
							$lesson_ids[$row['courses_has_chapters_chapter_id']][] = $res['object']->lesson_id;
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
