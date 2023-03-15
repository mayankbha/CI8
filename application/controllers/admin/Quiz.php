<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends MY_Controller {


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
	public function index(){

		$this->data['quizzes'] = $this->Quiz_Model->get_all_with_questions();

		$this->data['page_title'] = $this->data['page_title'] . ' | All quizzes';
		$this->data['page_content'] = 'admin/quizzes/list';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [add description]
	 */
	public function add(){

		if(isset($_POST['save_quiz'])){
            $quiz_data = $this->input->post(array(
					'quiz_title', 'quiz_description', 'quiz_badge', 'quiz_status', 'quiz_duration' 
				));

			$quiz_data['quiz_user_id'] = $this->data['loggedin_user']->user_id;
			$insert_id = $this->Quiz_Model->insert($quiz_data);

			if($insert_id){
				$this->session->set_flashdata('success', 'Quiz created successfully.');
				redirect('admin/quiz/edit/'.$insert_id, 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }
		$this->data['badges'] = $this->Badge_Model->get_active_badges();

		$this->data['page_title'] = $this->data['page_title'] . ' | quiz > Add';
		$this->data['page_content'] = 'admin/quizzes/add-quiz';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [edit description]
	 * @param  [type] $quiz_id [description]
	 * @return [type]          [description]
	 */
	public function edit($quiz_id){

		if(isset($_POST['save_quiz'])){
			$quiz_data = $this->input->post(array(
					'quiz_title', 'quiz_description', 'quiz_badge', 'quiz_status', 'quiz_duration' 
				));

			//update quiz data

			$return = $this->Quiz_Model->update( $quiz_data, $this->input->post('quiz_id'));

			if($return){
				$this->session->set_flashdata('success', 'Quiz updated successfully.');
				redirect('admin/quiz/edit/'.$this->input->post('quiz_id'));
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
		}
		$this->data['badges'] = $this->Badge_Model->get_active_badges();

		$this->data['quiz'] = $this->Quiz_Model->get_with_questions($quiz_id);

		$this->data['page_title'] = $this->data['page_title'] . ' | Quiz > Edit';
		$this->data['page_content'] = 'admin/quizzes/edit-quiz';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $quiz_id [description]
	 * @return [type]          [description]
	 */
	function delete($quiz_id){

		//Delete Quiz and Quiz questions relation [Check for Quiz results]

		$return = $this->Quiz_Model->delete($quiz_id);

		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'Quiz deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/quiz', 'refresh');
	}

	/**
	 * [edit description]
	 * @param  [type] $quiz_id [description]
	 * @return [type]          [description]
	 */
	public function questions($quiz_id){
		$this->data['quiz'] = $this->Quiz_Model->get_with_questions($quiz_id);

		$this->data['page_title'] = $this->data['page_title'] . ' | Quiz > Manage Questions';
		$this->data['page_content'] = 'admin/quizzes/manage-questions';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [edit description]
	 * @param  [type] $quiz_id [description]
	 * @return [type]          [description]
	 */
	public function add_question($quiz_id){

		if(isset($_POST['save_question'])){

			$question_data = array(
				'quiz_question_title' => $this->input->post('title'),
				'quiz_question_type' => $this->input->post('type'),
				'quiz_question_marks' => $this->input->post('marks'),
				'quiz_question_status' => $this->input->post('status'),
				'quiz_question_quiz_id' => $this->input->post('quiz_id')
			);

			//insert question
			$question_id = $this->Quiz_Questions_Model->insert($question_data);

			$answers = $this->input->post('answers');

			foreach($answers as $ak=>$answer){
				if($answer['text'] != ''){
					$temp_answer = array(
						'quiz_question_answer_text' => $answer['text'],
						'quiz_question_answer_is_correct' => 0,
						'quiz_question_answer_question_id' => $question_id,
						'quiz_question_answer_quiz_id' => $this->input->post('quiz_id'),
					);

					if($this->input->post('correct_answer') == $ak){
						$temp_answer['quiz_question_answer_is_correct'] = 1;
					}

					//add in array for batch insert
					$answers[$ak] = $temp_answer;
				}else{
					unset($answers[$ak]);
				}
			}

			//check if any new answer to insert
			if(count($answers) > 0){
				//inserts only new answers
				$this->Quiz_Question_Answers_Model->insert_batch($answers);
			}

			redirect(base_url('admin/quiz/edit_question/?quiz='.$quiz_id.'&question='.$question_id));
		}

		$this->data['quiz'] = $this->Quiz_Model->get_with_questions($quiz_id);

		$this->data['page_title'] = $this->data['page_title'] . ' | Quiz > Add Question';
		$this->data['page_content'] = 'admin/quizzes/add-question';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [edit description]
	 * @param  [type] $quiz_id [description]
	 * @return [type]          [description]
	 */
	public function edit_question(){
		$quiz_id = $this->input->get('quiz');
		$g_question_id = $this->input->get('question');

		if(isset($_POST['save_question'])){
			$question_id = $this->input->post('question_id');

			$question_data = array(
				'quiz_question_title' => $this->input->post('title'),
				'quiz_question_type' => $this->input->post('type'),
				'quiz_question_marks' => $this->input->post('marks'),
				'quiz_question_status' => $this->input->post('status')
			);

			//insert question
			$this->Quiz_Questions_Model->update($question_data, $this->input->post('quiz_question_id'));

			$answers = $this->input->post('answers');

			foreach($answers as $ak=>$answer){
				if($answer['text'] != ''){
					$temp_answer = array(
						'quiz_question_answer_text' => $answer['text'],
						'quiz_question_answer_is_correct' => 0,
						'quiz_question_answer_quiz_id' => $this->input->post('quiz_id'),
					);

					if($this->input->post('correct_answer') == $ak){
						$temp_answer['quiz_question_answer_is_correct'] = 1;
					}

					if($answer['answer_id'] != ''){
						$this->Quiz_Question_Answers_Model->update($temp_answer, $answer['answer_id']);
					}else{
						$temp_answer['quiz_question_answer_question_id'] = $g_question_id;
						$temp_answer[' 	quiz_question_answer_quiz_id'] = $quiz_id;
						$this->Quiz_Question_Answers_Model->insert($temp_answer);
					}
				}else{
					if($answer['answer_id'] != ''){
						$this->Quiz_Question_Answers_Model->delete($answer['answer_id']);
					}
				}
			}


		}

		$this->data['quiz'] = $this->Quiz_Model->get($quiz_id);
		$this->data['question'] = $this->Quiz_Questions_Model->get_question_with_answers($g_question_id);

		$this->data['page_title'] = $this->data['page_title'] . ' | Quiz > Edit Question';
		$this->data['page_content'] = 'admin/quizzes/edit-question';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $quiz_id [description]
	 * @return [type]          [description]
	 */
	function delete_question($question_id){

		$return = $this->Quiz_Questions_Model->delete($question_id);

		//$return = false;
		if($return){
			echo json_encode(array(
				'status' => 1,
				'msg' => 'Question deleted successfully.'
			));
		}else{
			echo json_encode(array(
				'status' => 0,
				'msg' => 'Come thing went wrong!'
			));
		}

		die();
	}
}
