<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends MY_Controller {

	
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

		if(isset($_POST['save_changes'])){
			$category_data = $this->input->post(array('name','description', 'status'));

			if(isset($_POST['t_id'])){
				$return = $this->Testimonial_Model->update( $category_data, $this->input->post('t_id'));

				if($return){
					$this->session->set_flashdata('success', 'Testimonial updated successfully.');
					redirect('admin/testimonial', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Error occured!');
				}
			}else{
				$insert_id = $this->Testimonial_Model->insert($category_data);

				if($insert_id){
					$this->session->set_flashdata('success', 'Testimonial created successfully.');
					redirect('admin/testimonial', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Error occured!');
				}
			}
			
		}

		$this->data['testimonials'] = $this->Testimonial_Model->get_all();

		if(isset($_GET['tid'])){
			$this->data['testimonial'] = $this->Testimonial_Model->get($this->input->get('tid'));
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | All Categories';
		$this->data['page_content'] = 'admin/testimonial/index';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	function delete($id){
		$return = $this->Testimonial_Model->delete($id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'Testimonial deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/testimonial', 'refresh');
	}
}
