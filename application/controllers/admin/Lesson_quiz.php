<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_quiz extends MY_Controller {


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
		$this->data['lesson_quiz'] = $this->Lesson_Quiz_Model->get_all_data();

			$this->data['page_title'] = $this->data['page_title'] . ' | Lesson & Quiz';
			$this->data['page_content'] = 'admin/lesson&quiz/list';
		   $this->load->view('admin/template', $this->data);
	}

	public function add(){
				 if(isset($_POST['save_lesson'])){
            $lesson_data = $this->input->post(array(
					'fk_chapter_id', 'lesson_title', 'lesson_description','lesson_sort_order'
				));

			$lesson_data['lesson_created_at'] = date("Y-m-d H:i:s");

			$lesson_id = $this->Lesson_Model->insert($lesson_data);

			$quiz_data = $this->input->post(array(
					'quiz_title', 'quiz_description', 'quiz_status'
				));

			$quiz_data['quiz_user_id'] = $this->data['loggedin_user']->user_id;
			$quiz_id = $this->Quiz_Model->insert($quiz_data);

			$user_id = $this->data['loggedin_user']->user_id;
			$created=date("Y-m-d H:i:s");
		    $tools= array(
						'lesson_and_quiz_user_id' => $user_id,
						'lesson_and_quiz_quiz_id' => $quiz_id,
						'lesson_and_quiz_lesson_id' => $lesson_id,
						'lesson_and_quiz_created_at'=> $created,
					);
		    $lesson_quiz = $this->Lesson_Quiz_Model->insert($tools);
		    	if($lesson_quiz){
		    		$this->session->set_flashdata('success', 'Lesson And Quiz created successfully.');
				redirect('admin/lesson_quiz/edit_lesson_quiz/'.$lesson_id.'/'.$quiz_id, 'refresh');


		    	}
			}
      	
		$this->data['page_title'] = $this->data['page_title'] . ' | All Chapter';
		$this->data['page_content'] = 'admin/lesson&quiz/add_lesson_quiz';
		$this->load->view('admin/template', $this->data);

	}

	public function edit_lesson_quiz($lesson_id,$quiz_id){
			if(isset($_POST['update_lesson_quiz'])){
		      $lesson_data = $this->input->post(array(
					'lesson_title', 'lesson_description','lesson_sort_order'
				));

			$lesson_data['lesson_created_at'] = date("Y-m-d H:i:s");
            $lesson_id=$this->input->post('lesson_id');

			$insert_id = $this->Lesson_Model->updateLesson($lesson_data,$lesson_id);

			$quiz_data = $this->input->post(array(
					'quiz_title', 'quiz_description', 'quiz_status'
				));

			//update quiz data
			$return = $this->Quiz_Model->update( $quiz_data, $this->input->post('quiz_id'));

			$post_questions = $this->input->post('quiz_questions');
			$correct_answers = $this->input->post('correct_answers');
			foreach($post_questions as $qk=>$question){
				$question_data = array(
					'quiz_question_title' => $question['title'],
					'quiz_question_marks' => $question['marks'],
					'quiz_question_status' => $question['status'],
					'quiz_question_quiz_id' => $this->input->post('quiz_id')
				);

				if(isset($question['question_id'])){
					//update question
					$this->Quiz_Questions_Model->update($question_data, $question['question_id']);
					$question_id = $question['question_id'];
				}else{
					//insert question
					$question_id = $this->Quiz_Questions_Model->insert($question_data);
				}

				$answers = array();
				foreach($question['answers'] as $ak=>$answer){
					$temp_answer = array(
						'quiz_question_answer_text' => $answer['text'],
						'quiz_question_answer_is_correct' => 0,
						'quiz_question_answer_question_id' => $question_id,
						'quiz_question_answer_quiz_id' => $this->input->post('quiz_id'),
					);

					if($correct_answers[$qk]['correct_answer'] == $ak){
						$temp_answer['quiz_question_answer_is_correct'] = 1;
					}

					if(isset($answer['answer_id'])){
						//update answer
						$this->Quiz_Question_Answers_Model->update($temp_answer, $answer['answer_id']);
					}else{
						//add in array for batch insert
						$answers[$ak] = $temp_answer;
					}
				}
				//check if any new answer to insert
				if(count($answers) > 0){
					//inserts only new answers
					$this->Quiz_Question_Answers_Model->insert_batch($answers);
				}
			}

			if ($return) {
					$this->session->set_flashdata('success', 'Lesson And Quiz updated successfully.');
				redirect('admin/lesson_quiz', 'refresh');

			}
				 }


           $this->data['quiz'] = $this->Quiz_Model->get_with_questions($quiz_id);

			$this->data['lesson'] = $this->Lesson_Quiz_Model->edit_lesson($lesson_id);
	       // $this->data['quiz'] = $this->Lesson_Quiz_Model->edit_quiz($quiz_id);

           $this->data['chapter']=$this->Chapter_Model->get_all();
		   $this->data['page_title'] = $this->data['page_title'] . ' | Edit';
		   $this->data['page_content'] = 'admin/lesson&quiz/edit_lesson_quiz';
		   $this->load->view('admin/template', $this->data);

	}

	public function delete_lesson_quiz($lesson_id,$quiz_id,$lesson_quiz_id){
		$this->Lesson_Model->delete($lesson_id);
		$this->Quiz_Model->delete($quiz_id);
		$return=$this->Lesson_Quiz_Model->delete($lesson_quiz_id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'Lesson
				 And Quiz deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/lesson_quiz', 'refresh');

	}

}
