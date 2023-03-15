<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_Question_Attempts_Model extends MY_Model{

	public $table_name = 'quiz_question_attempts';
    public $primary_key = 'q_q_attempt_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function log_attempt($course_id, $user_id, $chapter_id, $tool_id, $quiz_id, $quiz_question_id, $qsummary, $answer, $marks){
		$course_attempt_id = $this->Course_Attempts_Model->log_attempt($course_id, $user_id, $chapter_id);
		$course_chapter_attempt_id = $this->Course_Chapter_Attempts_Model->log_attempt($course_attempt_id, $course_id, $user_id, $chapter_id, $tool_id);
		$quiz_attempt_id = $this->Quiz_Attempts_Model->log_attempt($course_id, $user_id, $chapter_id, $tool_id, $quiz_id);

		$log = $this->q_q_log_exists($course_attempt_id, $course_chapter_attempt_id, $course_id, $user_id, $chapter_id, $quiz_id, $quiz_attempt_id, $quiz_question_id);

		if(empty($log)){
			$data = array(
				'q_q_attempt_course_id' => $course_id,
				'q_q_attempt_user_id' => $user_id,
				'q_q_attempt_chapter_id' => $chapter_id,
				'q_q_attempt_quiz_id' => $quiz_id,
				'q_q_attempt_caid' => $course_attempt_id,
				'q_q_attempt_qaid' => $quiz_attempt_id,
				'q_q_attempt_c_c_attempt_id' => $course_chapter_attempt_id,
				'q_q_attempt_quiz_question_id' => $quiz_question_id,
				'q_q_attempt_qsummary' => $qsummary,
				'q_q_attempt_answer' => $answer,
				'q_q_attempt_marks' => $marks,
				'q_q_attempt_complete_datetime' => date('Y-m-d H:i:s'),
				'q_q_attempt_complete_status' => 1
			);
			return $insert_id = $this->insert($data);
		}else{
			return $log->q_q_attempt_id;
		}
	}

	public function q_q_log_exists($caid, $c_c_attempt_id, $course_id, $user_id, $chapter_id, $quiz_id, $quiz_attempt_id, $quiz_question_id){
		$this->db->where(array(
			'q_q_attempt_course_id' => $course_id,
			'q_q_attempt_user_id' => $user_id,
			'q_q_attempt_chapter_id' => $chapter_id,
			'q_q_attempt_quiz_id' => $quiz_id,
			'q_q_attempt_caid' => $caid,
			'q_q_attempt_qaid' => $quiz_attempt_id,
			'q_q_attempt_c_c_attempt_id' => $c_c_attempt_id,
			'q_q_attempt_quiz_question_id' => $quiz_question_id
		));
		return $result = $this->db->get($this->table_name)->row();
	}

	function get_total_marks($quiz_attempt_id){
		$this->db->select('sum(q_q_attempt_marks) as marks');
		$this->db->where('q_q_attempt_qaid', $quiz_attempt_id);
		$result = $this->db->get($this->table_name)->row();
		var_dump($this->db->last_query());
		return $result;
	}
}
