<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapter extends MY_Controller {


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

			$this->data['chapter'] = $this->Chapter_Model->get_all();

			$this->data['page_title'] = $this->data['page_title'] . ' | All Chapters';
			$this->data['page_content'] = 'admin/chapter/list';
		   $this->load->view('admin/template', $this->data);
	}


	public function add(){

		if(isset($_POST['save_chapter'])){
            $lesson_data = $this->input->post(array(
					'chapter_title', 'chapter_sort_order'
				));
            $lesson_data['chapter_created_at'] = date("Y-m-d H:i:s");


			$insert_id = $this->Chapter_Model->insert($lesson_data);
          //  $data = $this->input->post();
		     $chapter_tools = $this->input->post('lesson_tools');

			if(!empty($chapter_tools)){
				$tools = array();
				foreach($chapter_tools as $chapter_tool){

					$tools[] = array(
						'chapter_tool_object' => $chapter_tool['object'],
						'chapter_tool_object_id' => $chapter_tool['object_id'],
						'chapter_tool_chapter_id' => $insert_id,
					);
				}
				$this->Chapter_Tools_Model->insert_batch($tools);
			}
			if($insert_id){
				$this->session->set_flashdata('success', 'Chapter created successfully.');
				redirect('admin/chapter', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }

		$this->data['page_title'] = $this->data['page_title'] . ' | quiz > Add';
		$this->data['page_content'] = 'admin/chapter/add-chapter';
		$this->load->view('admin/template', $this->data);
	}

	function delete_chapter($chapter_id){

		$return = $this->Chapter_Model->deleteChapter($chapter_id);

		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'Chapter deleted successfully.');
			redirect('admin/chapter', 'refresh');
		}else{
			$this->session->set_flashdata('error', 'Chapter not deleted.');
			redirect('admin/chapter', 'refresh');
		}

		// die();
	}

	public function edit_chapter($chapter_id){

		if(isset($_POST['update_chapter'])){
            $chapter_data = $this->input->post(array(
					'chapter_title', 'chapter_sort_order', 'chapter_status'
				));
            $chapter_data['chapter_created_at'] = date("Y-m-d H:i:s");

            $chapter_id=$this->input->post('chapter_id');

			$insert_id = $this->Chapter_Model->updateChapter($chapter_data,$chapter_id);

			//Delete chapter and category relation
			$this->Chapter_Model->chapter_tools_delete($this->input->post('chapter_id'));

			$chapter_tools = $this->input->post('lesson_tools');

			echo "<pre>"; print_r($chapter_tools); die;

			if(!empty($chapter_tools)){
				$tools = array();
				foreach($chapter_tools as $chapter_tool){

					$tools[] = array(
						'chapter_tool_object' => $chapter_tool['object'],
						'chapter_tool_object_id' => $chapter_tool['object_id'],
						'chapter_tool_chapter_id' => $chapter_id,
					);
				}
				$this->Chapter_Tools_Model->insert_batch($tools);
			}



			if($insert_id){
			$this->session->set_flashdata('success', 'Chapter Updated successfully.');
			redirect('admin/chapter', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }
		$this->data['lesson'] = $this->Chapter_Model->get($chapter_id);
        $this->data['chapter_tools'] = $this->Chapter_Tools_Model->get_by_lesson($chapter_id);
        $this->data['objects']['quiz'] = $this->Quiz_Model->get_all();
		$this->data['objects']['lesson'] = $this->Lesson_Model->get_all();
		$this->data['objects']['lesson_and_quiz'] = $this->Lesson_Quiz_Model->get_with_lesson_with_quiz();
        $this->data['chapter']=$this->Chapter_Model->getChapterByLessonId($chapter_id);

		$this->data['page_title'] = $this->data['page_title'] . ' | Chapter > Edit';
		$this->data['page_content'] = 'admin/chapter/edit-chapter';
		$this->load->view('admin/template', $this->data);
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
