<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Badges extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
	}

	public function index(){
	    $this->data['badge']=$this->Badge_Model->get_all();
		$this->data['page_title'] = $this->data['page_title'] . ' | Badge';
		$this->data['page_content'] = 'admin/badge/list';
		$this->load->view('admin/template', $this->data);
	}

	public function add(){
		if(isset($_POST['save_badge'])){
            $badge_data = 
            $this->input->post(array(
					'badge_title', 'badge_image', 'badge_criteria', 'badge_category', 'badge_category', 'badge_courses', 'badge_tools', 'badge_percent'
				));

			$badge_data['badge_created_at'] =date("Y-m-d H:i:s");
			$insert_id = $this->Badge_Model->insert($badge_data);


			if($insert_id){
				$this->session->set_flashdata('success', 'badge created successfully.');
				redirect('admin/Badges', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }

		$this->data['categories'] = $this->Category_Model->get_all();
		$this->data['courses'] = $this->Course_Model->get_all();
		$this->data['page_title'] = $this->data['page_title'] . ' | Badge > Add';
		$this->data['page_content'] = 'admin/badge/add-badge';
		$this->load->view('admin/template', $this->data);
	}

	public function edit_badge($badge_id){
			if(isset($_POST['update_badge'])){
            $badge_data = $this->input->post(array(
					'badge_title', 'badge_image'
				));


			$badge_data['badge_created_at'] =date("Y-m-d H:i:s");
			$return = $this->Badge_Model->update( $badge_data, $this->input->post('badge_id'));


			if($return){
				$this->session->set_flashdata('success', 'badge Updated successfully.');
				redirect('admin/Badges', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }
		$this->data['badges']=$this->Badge_Model->get_badge_by_id($badge_id);

		$this->data['thumb'] =  $this->model_tool_image->resize($this->data['badges']->badge_image,100,100);

		$this->data['categories'] = $this->Category_Model->get_all();
		$this->data['courses'] = $this->Course_Model->get_all();
		$this->data['page_title'] = $this->data['page_title'] . ' | Badge > Add';
		$this->data['page_content'] = 'admin/badge/edit-badge';
		$this->load->view('admin/template', $this->data);
	}

	public function delete_badge($badge_id){
		$return = $this->Badge_Model->delete($badge_id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'Badge deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/Badges', 'refresh');
	}


}
