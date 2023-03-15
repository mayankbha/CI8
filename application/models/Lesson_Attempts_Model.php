<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_Attempts_Model extends MY_Model{

	public $table_name = 'lesson_attempts';
    public $primary_key = 'lesson_attempt_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

	public function log_attempt($course_id, $user_id, $chapter_id, $tool_id, $lesson_id){
		$course_attempt_id = $this->Course_Attempts_Model->log_attempt($course_id, $user_id, $chapter_id);
		$course_chapter_attempt_id = $this->Course_Chapter_Attempts_Model->log_attempt($course_attempt_id, $course_id, $user_id, $chapter_id, $tool_id);

		$log = $this->lesson_log_exists($course_attempt_id, $course_chapter_attempt_id, $course_id, $user_id, $chapter_id, $lesson_id);
		if(empty($log)){
			$data = array(
				'lesson_attempt_course_id' => $course_id,
				'lesson_attempt_user_id' => $user_id,
				'lesson_attempt_chapter_id' => $chapter_id,
				'lesson_attempt_lesson_id' => $lesson_id,
				'lesson_attempt_caid' => $course_attempt_id,
				'lesson_attempt_c_c_attempt_id' => $course_chapter_attempt_id
			);
			return $insert_id = $this->insert($data);
		}else{
			return $log->lesson_attempt_id;
		}
	}

	public function lesson_log_exists($caid, $c_c_attempt_id, $course_id, $user_id, $chapter_id, $lesson_id){
		$this->db->where(array(
			'lesson_attempt_course_id' => $course_id,
			'lesson_attempt_user_id' => $user_id,
			'lesson_attempt_chapter_id' => $chapter_id,
			'lesson_attempt_lesson_id' => $lesson_id,
			'lesson_attempt_caid' => $caid,
			'lesson_attempt_c_c_attempt_id' => $c_c_attempt_id
		));
		return $result = $this->db->get($this->table_name)->row();
	}

	public function mark_as_complete($lesson_attempt_id){
		$data = array(
			'lesson_attempt_complete_datetime' => date('Y-m-d H:i:s'),
			'lesson_attempt_complete_status' => 1
		);
		$this->update($data, $lesson_attempt_id);
	}
	
	// ADD BY DEV A
	public function get_lesson_status($course_id=0, $user_id=0, $chapter_id=0, $lesson_id=0){
		
		$result = $this->db->select('lesson_attempt_complete_status')
			->where(array(
			'lesson_attempt_course_id' => $course_id,
			'lesson_attempt_user_id' => $user_id,
			'lesson_attempt_chapter_id' => $chapter_id,
			'lesson_attempt_lesson_id' => $lesson_id
		))->get($this->table_name)->row();
		//echo $str = $this->db->last_query();
		if($result){
			return $result->lesson_attempt_complete_status;
		}else{
			return 0;
		}
		
	}
	
	public function get_quiz_status($course_id=0, $user_id=0, $chapter_id=0, $lesson_id=0){
		
		$result = $this->db->select('quiz_attempt_complete_status')
			->where(array(
			'quiz_attempt_course_id' => $course_id,
			'quiz_attempt_user_id' => $user_id,
			'quiz_attempt_chapter_id' => $chapter_id,
			'quiz_attempt_quiz_id' => $lesson_id
		))->get('quiz_attempts')->row();
		//echo $str = $this->db->last_query();
		if($result){
			return $result->quiz_attempt_complete_status;
		}else{
			return 0;
		}
		
	}

	public function check_completed_chapter($user_id, $course_id) {
		$this->db->where($this->table_name.'.lesson_attempt_user_id', $user_id);
		$this->db->where($this->table_name.'.lesson_attempt_course_id', $course_id);
		$this->db->where($this->table_name.'.lesson_attempt_complete_status', 1);

		$result = $this->db->get($this->table_name)->row();

		return $result;
	}

}
