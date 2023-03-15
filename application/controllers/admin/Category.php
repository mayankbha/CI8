<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	
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
			$category_data = $this->input->post(array('category_title', 'category_status'));
			$category_data['category_user_id'] = $this->data['loggedin_user']->user_id;

			if(isset($_POST['category_id'])){
				$return = $this->Category_Model->update( $category_data, $this->input->post('category_id'));

				if($return){
					$this->session->set_flashdata('success', 'Category updated successfully.');
					redirect('admin/category', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Error occured!');
				}
			}else{
				$insert_id = $this->Category_Model->insert($category_data);

				if($insert_id){
					$this->session->set_flashdata('success', 'Category created successfully.');
					redirect('admin/category', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Error occured!');
				}
			}
			
		}

		$this->data['categories'] = $this->Category_Model->get_all();

		if(isset($_GET['cat'])){
			$this->data['category'] = $this->Category_Model->get($this->input->get('cat'));
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | All Categories';
		$this->data['page_content'] = 'admin/categories/index';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	function delete($user_id){
		$return = $this->Category_Model->delete($user_id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'User deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/user', 'refresh');
	}
}
