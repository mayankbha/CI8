<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_Attempts_Model extends MY_Model{

	public $table_name = 'quiz_attempts';
    public $primary_key = 'quiz_attempt_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    function get_last_attempts($course_id, $user_id, $chapter_id, $tool_id, $quiz_id, $limit = 3){
    	$this->db->where(array(
    		'quiz_attempt_course_id' => $course_id,
    		'quiz_attempt_chapter_id' => $chapter_id,
    		'quiz_attempt_quiz_id' => $quiz_id,
    		'quiz_attempt_user_id' => $user_id,
    	));
    	$this->db->limit($limit);
    	$this->db->order_by('quiz_attempt_datetime', 'DESC');
    	$result = $this->db->get($this->table_name)->result_array();

    	return $result;
    }

	public function log_attempt($course_id, $user_id, $chapter_id, $tool_id, $quiz_id){
		$course_attempt_id = $this->Course_Attempts_Model->log_attempt($course_id, $user_id, $chapter_id);
		$course_chapter_attempt_id = $this->Course_Chapter_Attempts_Model->log_attempt($course_attempt_id, $course_id, $user_id, $chapter_id, $tool_id);

		$log = $this->quiz_log_exists($course_attempt_id, $course_chapter_attempt_id, $course_id, $user_id, $chapter_id, $quiz_id);
		if(empty($log)){
			$data = array(
				'quiz_attempt_course_id' => $course_id,
				'quiz_attempt_user_id' => $user_id,
				'quiz_attempt_chapter_id' => $chapter_id,
				'quiz_attempt_quiz_id' => $quiz_id,
				'quiz_attempt_caid' => $course_attempt_id,
				'quiz_attempt_c_c_attempt_id' => $course_chapter_attempt_id
			);
			return $insert_id = $this->insert($data);
		}else{
			return $log->quiz_attempt_id;
		}
	}

	public function quiz_log_exists($caid, $c_c_attempt_id, $course_id, $user_id, $chapter_id, $quiz_id){
		$this->db->where(array(
			'quiz_attempt_course_id' => $course_id,
			'quiz_attempt_user_id' => $user_id,
			'quiz_attempt_chapter_id' => $chapter_id,
			'quiz_attempt_quiz_id' => $quiz_id,
			'quiz_attempt_caid' => $caid,
			'quiz_attempt_c_c_attempt_id' => $c_c_attempt_id,
			'quiz_attempt_complete_status' => 0
		));
		return $result = $this->db->get($this->table_name)->row();
	}

	public function mark_as_complete($quiz_attempt_id, $marks){
		$data = array(
			'quiz_attempt_complete_datetime' => date('Y-m-d H:i:s'),
			'quiz_attempt_complete_status' => 1,
			'quiz_attempt_marks' => $marks,
		);
		$this->update($data, $quiz_attempt_id);
	}


}
