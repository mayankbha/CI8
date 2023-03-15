<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){

		parent::__construct();
		 $this->load->model('Lesson_Model');
		 $this->load->model('Chapter_Model');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){

      	$this->data['lesson'] = $this->Lesson_Model->get_lesson_with_chapter();
        $this->data['chapter']=$this->Chapter_Model->get_all();
		$this->data['page_title'] = $this->data['page_title'] . ' | All Lessons';
		$this->data['page_content'] = 'admin/lesson/list';
		$this->load->view('admin/template', $this->data);
	}


	public function getInfo(){
		$chapter_id=$this->input->get('cid');
		if($chapter_id != ''){
			$this->data['lesson'] = $this->Lesson_Model->search_lessons_by_chapter_id($chapter_id);
			$this->data['chapter']=$this->Chapter_Model->get_all();
			$this->data['page_title'] = $this->data['page_title'] . ' | All Lessons';
			$this->data['page_content'] = 'admin/lesson/list';
			$this->load->view('admin/template', $this->data,'refresh');
		}else{
			redirect('admin/lesson');
		}
	}

	public function add(){
        if(isset($_POST['save_lesson'])){
            $chapter_data = $this->input->post(array(
					'lesson_title', 'lesson_description'
				));

			$chapter_data['lesson_created_at'] = date("Y-m-d H:i:s");

			$insert_id = $this->Lesson_Model->insert($chapter_data);

			if($insert_id){
			$this->session->set_flashdata('success', 'Lessson created successfully.');

			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			     }
                                       }
			$this->data['chapter']=$this->Chapter_Model->get_all();

			$this->data['page_title'] = $this->data['page_title'] . ' | Lesson > Add';
			$this->data['page_content'] = 'admin/lesson/add-lesson';
		    $this->load->view('admin/template', $this->data);


				}

		function delete_lesson($lesson_id){

		$return = $this->Lesson_Model->deleteLesson($lesson_id);

		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'Chapter deleted successfully.');
			redirect('admin/lesson', 'refresh');

		}else{
			$this->session->set_flashdata('error', 'Chapter not deleted.');
			redirect('admin/lesson', 'refresh');
		}


	}


	public function edit_lesson($lesson_id){

		if(isset($_POST['update_lesson'])){
            $chapter_data = $this->input->post(array(
					'lesson_title', 'lesson_description'
				));

			$chapter_data['lesson_created_at'] = date("Y-m-d H:i:s");
            $chapter_id=$this->input->post('lesson_id');

			$insert_id = $this->Lesson_Model->updateLesson($chapter_data,$chapter_id);

			if($insert_id){
			$this->session->set_flashdata('success', 'Lesson updates successfully.');
			redirect('admin/lesson', 'refresh');

			}else{
			$this->session->set_flashdata('error', 'Error occured!');
			redirect('admin/lesson', 'refresh');
			     }
                                       }


		$this->data['lesson']=$this->Lesson_Model->get($lesson_id);

		$this->data['page_title'] = $this->data['page_title'] . ' | Lesson > Edit';
		$this->data['page_content'] = 'admin/lesson/edit-lesson';
		$this->load->view('admin/template', $this->data);
	}


}
