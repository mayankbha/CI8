<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_Question_Answers_Model extends MY_Model{

	public $table_name = 'quiz_question_answers';
    public $primary_key = 'quiz_question_answer_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

	public function get_answers_by_question_id($question_id){
		return $this->get_all('', array('quiz_question_answer_question_id' => $question_id));
	}
}
