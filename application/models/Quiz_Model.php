<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_Model extends MY_Model{

	public $table_name = 'quizzes';
    public $primary_key = 'quiz_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * [get_with_questions description]
     * @param  [type] $quiz_id [description]
     * @return [type]          [description]
     */
    public function get_with_questions($quiz_id){

    	$quiz = $this->get($quiz_id);
    	$quiz = json_decode(json_encode($quiz), true);

    	$quiz['questions'] = $this->db->where(
    		array(
    			'quiz_question_quiz_id' => $quiz_id
    		)
    	)->get('quiz_questions')->result_array();

    	foreach($quiz['questions'] as $qk=>$question){
    		$quiz['questions'][$qk]['answers'] = $this->db->where(
	    		array(
	    			'quiz_question_answer_question_id' => $question['quiz_question_id']
	    		)
	    	)->get('quiz_question_answers')->result_array();
    	}

    	return $quiz;
    }

	/**
     * [get_with_questions description]
     * @param  [type] $quiz_id [description]
     * @return [type]          [description]
     */
    public function get_all_with_questions(){

    	$quizzes = $this->get_all();

		foreach($quizzes as $k=>$quiz){
			$quizzes[$k]['questions'] = $this->db->where(
	    		array(
	    			'quiz_question_quiz_id' => $quiz['quiz_id']
	    		)
	    	)->get('quiz_questions')->result_array();

	    	foreach($quizzes[$k]['questions'] as $qk=>$question){
	    		$quizzes[$k]['questions'][$qk]['answers'] = $this->db->where(
		    		array(
		    			'quiz_question_answer_question_id' => $question['quiz_question_id']
		    		)
		    	)->get('quiz_question_answers')->result_array();
	    	}
		}

    	return $quizzes;
    }

    public function delete($quiz_id){

        //delete questions for the quiz
        $this->db->where('quiz_question_quiz_id', $quiz_id)->delete('quiz_questions');

        //delete question answers for the quiz
        $this->db->where('quiz_question_answer_quiz_id', $quiz_id)->delete('quiz_question_answers');

        //now delete quiz
        $this->db->where($this->primary_key, $quiz_id);

        return $this->db->delete($this->table_name);
    }

}
