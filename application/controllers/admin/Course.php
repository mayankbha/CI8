<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller {


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

		$this->data['courses'] = $this->Course_Model->get_all();

		$this->data['page_title'] = $this->data['page_title'] . ' | All courses';
		$this->data['page_content'] = 'admin/courses/list';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [add description]
	 */
	public function add(){

		if(isset($_POST['save_course'])){
            $course_data = $this->input->post(array(
					'course_title', 'course_description', 'course_start_date', 'course_end_date', 'course_all_time', 'course_price', 'course_visibility', 'course_status', 'course_image', 'course_badge'
				));

			$course_data['course_user_id'] = $this->data['loggedin_user']->user_id;
			$insert_id = $this->Course_Model->insert($course_data);

			//Insert course and category relation
			$this->Course_Model->course_categories_insert($insert_id, $this->input->post('category'), $course_data['course_user_id']);

			$course_chapters = $this->input->post('course_chapters');


			if(!empty($course_chapters)){
				$tools = array();
				foreach($course_chapters as $course_chapter){
					$tools[] = array(
						'courses_has_chapters_chapter_id' => $course_chapter['chapter_id'],
						'courses_has_chapters_course_id' => $insert_id,
					);
				}
				$this->Courses_Has_Chapters_Model->insert_batch($tools);
			}

			if($insert_id){
				$this->session->set_flashdata('success', 'course created successfully.');
				redirect('admin/course', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }

        $this->data['categories'] = $this->Category_Model->get_active_categories();
		$this->data['chapters'] = $this->Chapter_Model->get_active_chapters();
		$this->data['badges'] = $this->Badge_Model->get_active_badges();

		$this->data['page_title'] = $this->data['page_title'] . ' | course > Add';
		$this->data['page_content'] = 'admin/courses/add-course';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [edit description]
	 * @param  [type] $course_id [description]
	 * @return [type]          [description]
	 */
	public function edit($course_id){

		if(isset($_POST['save_course'])){
			$course_data = $this->input->post(array(
					'course_title', 'course_description', 'course_start_date', 'course_end_date', 'course_all_time', 'course_price', 'course_visibility', 'course_status', 'course_image', 'course_badge'
				));

			$return = $this->Course_Model->update( $course_data, $this->input->post('course_id'));

			//Delete course and category relation
			$this->Course_Model->course_categories_delete($this->input->post('course_id'));
			//Insert course and category relation
			$this->Course_Model->course_categories_insert($this->input->post('course_id'), $this->input->post('category'), $this->input->post('course_user_id'));

			//Delete course tools
			$this->Course_Model->course_chapters_delete($this->input->post('course_id'));
			//Insert new course tools
			$course_chapters = $this->input->post('course_chapters');
			if(!empty($course_chapters)){
				$tools = array();
				foreach($course_chapters as $course_chapter){
					$tools[] = array(
						'courses_has_chapters_chapter_id' => $course_chapter['chapter_id'],
						'courses_has_chapters_course_id' => $this->input->post('course_id'),
					);
				}
				$this->Courses_Has_Chapters_Model->insert_batch($tools);
			}

			if($return){
				$this->session->set_flashdata('success', 'course updated successfully.');
				redirect('admin/course/edit/'.$this->input->post('course_id'));
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
		}

		$this->data['course'] = $this->Course_Model->get_with_categories($course_id);

		$this->data['thumb'] =  $this->model_tool_image->resize($this->data['course']['course_image'],100,100);

		$this->data['categories'] = $this->Category_Model->get_all();
		$this->data['chapters'] = $this->Chapter_Model->get_active_chapters();
		$this->data['course_chapters'] = $this->Courses_Has_Chapters_Model->get_with_chapter($course_id);
		$this->data['badges'] = $this->Badge_Model->get_active_badges();

		$this->data['page_title'] = $this->data['page_title'] . ' | course > Edit';
		$this->data['page_content'] = 'admin/courses/edit-course';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $course_id [description]
	 * @return [type]          [description]
	 */
	function delete($course_id){

		//Delete course and category relation
		$this->Course_Model->course_categories_delete($course_id);

		//Delete course chapters
		$this->Course_Model->course_chapters_delete($course_id);

		$return = $this->Course_Model->delete($course_id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'course deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/course', 'refresh');
	}

	public function get_object_values($object){
		$return = array();
		$msg = '';

		switch($object){
			case 'quiz':
				$quizzes = $this->Quiz_Model->get_all(array('quiz_id', 'quiz_title'));
				foreach($quizzes as $quiz){
					$msg[$quiz['quiz_id']] = $quiz['quiz_title'];
				}
				$return = array(
					'status' => 1,
					'msg' => $msg
				);
			break;

			case 'chapter':
				$chapters = $this->Chapter_Model->get_all(array('chapter_id', 'chapter_title'));
				foreach($chapters as $chapter){
					$msg[$chapter['chapter_id']] = $chapter['chapter_title'];
				}
				$return = array(
					'status' => 1,
					'msg' => $msg
				);
			break;

			case 'lesson':
				$lessons = $this->Lesson_Model->get_all(array('lesson_id', 'lesson_title'));
				foreach($lessons as $lesson){
					$msg[$lesson['lesson_id']] = $lesson['lesson_title'];
				}
				$return = array(
					'status' => 1,
					'msg' => $msg
				);
			break;

			case 'lesson_and_quiz':
				$lessons_and_quizzes = $this->Lesson_Quiz_Model->get_with_lesson_with_quiz();
				foreach($lessons_and_quizzes as $lesson_and_quiz){
					$msg[$lesson_and_quiz['lesson_and_quiz_id']] = $lesson_and_quiz['lesson_title'].' and '.$lesson_and_quiz['quiz_title'];
				}
				$return = array(
					'status' => 1,
					'msg' => $msg
				);
			break;

			default:
				$return = array(
					'status' => 0,
					'msg' => 'No data found'
				);
			break;
		}

		echo json_encode($return);
		die();

	}
}
