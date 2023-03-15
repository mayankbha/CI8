<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_Questions_Model extends MY_Model{

	public $table_name = 'quiz_questions';
    public $primary_key = 'quiz_question_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_questions($question_id){
    	$this->db->select('*');
		$this->db->where($this->table_name.'.quiz_question_quiz_id', $question_id);
		$result = $this->db->get($this->table_name)->result_array();

		foreach($result as $k=>$question){
			$result[$k]['questions_answers'] = $this->Quiz_Question_Answers_Model->get_answers_by_question_id($question_id['quiz_question_quiz_id']);
		}

		return $result;
	}

	public function get_question_with_answers($question_id){
		$question = $this->get($question_id);
		$question = json_decode(json_encode($question), true);

		$question['answers'] = $this->Quiz_Question_Answers_Model->get_answers_by_question_id($question_id);

		return $question;
	}

}
